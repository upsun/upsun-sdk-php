# PHP SDK — Alignment with Node.js SDK

## Context

The PHP SDK (`upsun-sdk-php`) must be aligned with the Node.js SDK (`upsun-sdk-node`) on three
points that were recently fixed in Node.js. The changes are **backward-compatible** and must not
break any existing consumer of the SDK.

---

## CRITICAL RULE — Generated files vs. templates

Before touching any PHP file, determine whether it is generated or custom:

| File | Status | How to edit |
|---|---|---|
| `src/Api/AbstractApi.php` | **Generated** — listed in `.openapi-generator/FILES` | Edit `templates/php/abstract_api.mustache`, then regenerate |
| `src/Core/OAuthProvider.php` | **Generated** — listed in `.openapi-generator/FILES` | Edit `templates/php/oauth_provider.mustache`, then regenerate |
| `src/UpsunClient.php` | **Custom** — NOT in `.openapi-generator/FILES` | Edit directly |
| `src/UpsunConfig.php` | **Custom** — NOT in `.openapi-generator/FILES` | Edit directly |

**Regeneration command:**
```bash
npx openapi-generator-cli generate -c templates/config.yaml
```

**Template → generated file mapping** (from `templates/config.yaml`):
```
templates/php/abstract_api.mustache   → src/Api/AbstractApi.php
templates/php/oauth_provider.mustache → src/Core/OAuthProvider.php
```

After every change to a mustache template, run the generator and verify the generated output
matches the template intent exactly.

---

## Change 1 — Bearer-only mode (`setBearerToken`)

### Goal

Allow a consumer to bypass OAuth2 entirely and inject a static bearer token, exactly as in
Node.js:

```typescript
// Node.js — src/upsun.ts
setBearerToken(token: string): void {
    this.accessToken = token;
}

public async getToken(name?: string, scopes?: string[]): Promise<string> {
    if (this.auth) {
        return await this.auth.getAuthorization();   // OAuth2 path
    } else if (this.accessToken) {
        return `${this.accessToken}`;                // Bearer path
    } else {
        throw new Error('No authentication method available...');
    }
}
```

### Files to change

#### `src/UpsunClient.php` (custom — edit directly)

1. Add a nullable `?string $bearerToken` property (default `null`).
2. Add a `setBearerToken(string $token): void` public method that sets it.
3. Make the `$auth` property nullable (`?OAuthProvider`) — only instantiated when `$upsunConfig->apiToken` is not the default empty value.
4. Update `getToken()` (currently returns `$this->upsunConfig->apiToken`) to implement the three-way logic:

```php
public function getToken(): string
{
    if ($this->auth !== null) {
        return $this->auth->getAuthorization(); // OAuth2 path
    }

    if ($this->bearerToken !== null) {
        return 'Bearer ' . $this->bearerToken; // Bearer-only path
    }

    throw new \RuntimeException(
        'No authentication method available. Provide an API key or call setBearerToken().'
    );
}
```

5. Pass `$this->auth` (which may now be `null`) down to all API class constructors. The
   `AbstractApi` and each concrete API must accept `?OAuthProvider`.

#### `src/Api/AbstractApi.php` + `templates/php/abstract_api.mustache` (generated — edit template)

- Accept `?OAuthProvider $oauthProvider` in the constructor.
- In `getAuthorizationHeader()`, delegate to `$this->oauthProvider->getAuthorization()` only when
  `$oauthProvider !== null`, otherwise call `$this->upsunClient->getToken()`.

  Simpler alternative (avoids circular dependency): inject a `callable $tokenProvider` instead of
  `OAuthProvider` directly, so the auth strategy is resolved at call time:

```php
// In AbstractApi constructor, replace OAuthProvider with a callable
public function __construct(
    private readonly \Closure $tokenProvider,  // () => string
    ...
)

// In getAuthorizationHeader()
protected function getAuthorizationHeader(): string
{
    return ($this->tokenProvider)();
}
```

  In `UpsunClient.php`, pass the closure when building task params:
```php
$tokenProvider = fn(): string => $this->getToken();
$taskParams = [$tokenProvider, $this->apiClient, $requestFactory, $this->apiConfig];
```

- **Also update `templates/php/abstract_api.mustache`** with the same change before regenerating.

---

## Change 2 — Thundering-herd protection with PHP Fibers

### Goal

The current guard in `OAuthProvider::ensureValidToken()` is a simple boolean:

```php
if ($this->acquiringToken) {
    return; // ← caller returns with NO valid token — bug in concurrent Fiber contexts
}
```

This is safe for FPM (mono-thread per request) but incorrect when multiple `Fiber`s within the
same PHP process call `ensureValidToken()` concurrently: the second Fiber returns immediately
with `$accessToken = null`.

The Node.js equivalent shares a single in-flight `Promise`:
```typescript
if (!this.pendingToken) {
    this.pendingToken = this.doAcquireToken().finally(() => { this.pendingToken = null; });
}
await this.pendingToken; // ALL concurrent callers wait for the same result
```

### PHP Fiber implementation

Replace the boolean guard with a `?Fiber` reference that all concurrent callers can join:

```php
/** @var \Fiber<void,void,void,void>|null */
private ?\Fiber $acquiringFiber = null;

public function ensureValidToken(): void
{
    $buffer = 120;

    if ($this->accessToken && time() <= ($this->tokenExpiry - $buffer)) {
        return; // token still valid — fast path
    }

    if ($this->acquiringFiber !== null && !$this->acquiringFiber->isTerminated()) {
        // Another Fiber is already acquiring — suspend until it completes,
        // then check if the token is now valid (it should be).
        while (!$this->acquiringFiber->isTerminated()) {
            \Fiber::getCurrent()?->suspend();
        }
        // After the acquiring Fiber finishes, the token is valid.
        return;
    }

    // This Fiber takes ownership of the acquisition.
    $this->acquiringFiber = \Fiber::getCurrent();
    try {
        $this->doAcquireToken();
    } finally {
        $this->acquiringFiber = null;
    }
}
```

> **Note for the agent**: `\Fiber::getCurrent()` returns `null` when called outside a Fiber
> (e.g., standard FPM synchronous code). Add a null-guard so the method still works in sync
> contexts:
>
> ```php
> $currentFiber = \Fiber::getCurrent();
> $this->acquiringFiber = $currentFiber; // may be null in sync FPM context
> ```
>
> When `$acquiringFiber` is `null` (sync context), no other Fiber can join — which is correct
> because FPM is inherently single-threaded per request.

### Files to change

- **`templates/php/oauth_provider.mustache`** — replace `private bool $acquiringToken` + the
  boolean guard with the `?Fiber` implementation above.
- **`src/Core/OAuthProvider.php`** — regenerated output of the template; verify after generation.
- Remove the `private bool $acquiringToken = false;` property.

---

## Change 3 — 401 retry guard in async/Fiber mode

### Goal

In Node.js, the middleware uses a `__upsunRetry` flag on the request `init` object to prevent
double-retry:

```typescript
if (retryInit.__upsunRetry) return response; // guard: no double-retry
retryInit.__upsunRetry = true;
```

The current PHP implementation in `AbstractApi::sendAuthenticatedRequest()` has no such guard:

```php
if ($response->getStatusCode() === 401) {
    $this->oauthProvider->forceRefresh();
    $request = $this->createAuthenticatedRequest(...);
    $response = $this->httpClient->sendRequest($request);
    // ← if the second response is also 401, we silently fall through to ApiException
    // ← in Fiber mode with concurrent requests, two Fibers could both trigger forceRefresh()
}
```

In synchronous FPM this is harmless (only one request in flight). In Fiber async mode, two
concurrent 401s could each call `forceRefresh()` back-to-back, causing two token re-acquisitions.

### PHP implementation

Add an instance-level retry guard (per-request correlation via a local flag):

```php
protected function sendAuthenticatedRequest(
    string $method,
    string $uri,
    array $headers = [],
    string|StreamInterface|null $body = null,
    bool $_retried = false,   // ← internal guard, not part of public API
): ResponseInterface {
    try {
        $this->refreshToken();
        $request = $this->createAuthenticatedRequest($method, $uri, $headers, $body);
        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() === 401 && !$_retried) {
            // RFC 6750 §3.1 — retry once with a fresh token.
            // The $_retried=true guard prevents infinite loops in Fiber contexts.
            $this->oauthProvider->forceRefresh();
            return $this->sendAuthenticatedRequest($method, $uri, $headers, $body, true);
        }

        if ($response->getStatusCode() >= 400) {
            throw new ApiException(...);
        }

        return $response;
    } catch (...) { ... }
}
```

> The recursive self-call with `$_retried = true` mirrors the `__upsunRetry` flag in Node.js
> without modifying the PSR-7 request object.

### Files to change

- **`templates/php/abstract_api.mustache`** — update `sendAuthenticatedRequest()` signature and
  body as above.
- **`src/Api/AbstractApi.php`** — regenerated; verify after generation.

---

## Validation checklist

After all changes:

- [ ] `composer run spec:generate` runs without error
- [ ] `src/Api/AbstractApi.php` matches `templates/php/abstract_api.mustache` (no drift)
- [ ] `src/Core/OAuthProvider.php` matches `templates/php/oauth_provider.mustache` (no drift)
- [ ] `composer run lint:phpcs` passes
- [ ] `composer run test` — all existing unit tests pass
- [ ] New unit tests added for:
  - `setBearerToken()` — bearer path returns `Bearer <token>` without calling `OAuthProvider`
  - `getToken()` throws when neither API key nor bearer is set
  - `ensureValidToken()` — two concurrent Fiber callers only trigger one HTTP request
  - `sendAuthenticatedRequest()` — 401 retry guard prevents double `forceRefresh()` in Fiber mode
- [ ] PHP 8.1+ minimum (Fiber requires 8.1)
