<?php

namespace Upsun\Tests\Core;

use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Upsun\Core\OAuthProvider;

/**
 * Test suite for OAuthProvider.
 *
 * @covers \Upsun\Core\OAuthProvider
 */
class OAuthProviderTest extends TestCase
{
    /**
     * @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    private ClientInterface $httpClient;

    private RequestFactoryInterface $requestFactory;

    private OAuthProvider $oauthProvider;

    private string $tokenEndpoint = 'https://auth.upsun.com/oauth2/token';

    private string $refreshEndpoint = 'https://auth.upsun.com/oauth2/token';

    private string $clientId = 'test-client-id';

    private string $clientSecret = 'test-api-token';

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = new Psr17Factory();

        $this->oauthProvider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret,
            $this->refreshEndpoint,
        );
    }

    /**
     * @throws Exception
     */
    public function testExchangeCodeForTokenSuccess()
    {
        $responseBody = json_encode([
            'access_token' => 'test-access-token-123',
            'expires_in' => 3600,
            'token_type' => 'Bearer'
        ]);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $this->assertEquals('POST', $request->getMethod());
                $this->assertEquals($this->tokenEndpoint, (string)$request->getUri());
                $this->assertStringContainsString(
                    'application/x-www-form-urlencoded',
                    $request->getHeaderLine('Content-Type')
                );
                $this->assertStringStartsWith('Basic ', $request->getHeaderLine('Authorization'));

                $body = (string)$request->getBody();
                $this->assertStringContainsString('grant_type=api_token', $body);
                $this->assertStringContainsString('api_token=' . $this->clientSecret, $body);
                $this->assertStringContainsString('client_id=' . $this->clientId, $body);

                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $result = $this->oauthProvider->exchangeCodeForToken();

        $this->assertTrue($result);
    }

    public function testExchangeCodeForTokenFailsWithNon200Status()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(401, [], 'Unauthorized'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Token exchange failed with status: 401');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithInvalidJson()
    {
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], 'invalid-json'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid JSON response:');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithoutAccessToken()
    {
        $responseBody = json_encode([
            'token_type' => 'Bearer',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No access token in response');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenFailsWithEmptyAccessToken()
    {
        $responseBody = json_encode([
            'access_token' => '',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No access token in response');

        $this->oauthProvider->exchangeCodeForToken();
    }

    public function testExchangeCodeForTokenHandlesClientException()
    {
        $clientException = new class ('Network error') extends Exception implements ClientExceptionInterface {
        };

        $this->httpClient
            ->method('sendRequest')
            ->willThrowException($clientException);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Token exchange failed: Network error');

        $this->oauthProvider->exchangeCodeForToken();
    }

    /**
     * @throws Exception
     */
    public function testGetAuthorizationReturnsValidToken()
    {
        $responseBody = json_encode([
            'access_token' => 'valid-token-abc',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer valid-token-abc', $authorization);
    }

    /**
     * @throws Exception
     */
    public function testEnsureValidTokenRequestsNewTokenWhenNoneExists()
    {
        $responseBody = json_encode([
            'access_token' => 'new-token-123',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->oauthProvider->ensureValidToken();

        // Verify token is stored by calling getAuthorization without another request
        $this->httpClient
            ->expects($this->never())
            ->method('sendRequest');

        $authorization = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer new-token-123', $authorization);
    }

    /**
     * @throws Exception
     */
    public function testEnsureValidTokenRefreshesExpiredToken()
    {
        // First request: get initial token with short expiry
        $firstResponse = json_encode([
            'access_token' => 'short-lived-token',
            'expires_in' => -100 // Already expired
        ]);

        // Second request: get new token
        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $firstResponse),
                new Response(200, ['Content-Type' => 'application/json'], $secondResponse)
            );

        // Get first token
        $this->oauthProvider->exchangeCodeForToken();

        // This should trigger a refresh because token is expired
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer refreshed-token', $authorization);
    }

    /**
     * @throws Exception
     */
    public function testEnsureValidTokenWithinBufferPeriodRefreshesToken()
    {
        // Token that expires in less than 120 seconds (buffer period)
        $responseBody = json_encode([
            'access_token' => 'expiring-soon-token',
            'expires_in' => 30 // Less than 120 second buffer
        ]);

        $refreshedResponse = json_encode([
            'access_token' => 'fresh-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $responseBody),
                new Response(200, ['Content-Type' => 'application/json'], $refreshedResponse)
            );

        $this->oauthProvider->exchangeCodeForToken();

        // Should refresh because within buffer period
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer fresh-token', $authorization);
    }

    /**
     * @throws Exception
     */
    public function testGetAuthorizationDoesNotRefreshValidToken()
    {
        $responseBody = json_encode([
            'access_token' => 'long-lived-token',
            'expires_in' => 7200 // 2 hours
        ]);

        $this->httpClient
            ->expects($this->once()) // Only once for initial token
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        // First call to get token
        $auth1 = $this->oauthProvider->getAuthorization();

        // Second call should use cached token
        $auth2 = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer long-lived-token', $auth1);
        $this->assertEquals('Bearer long-lived-token', $auth2);
    }

    /**
     * @throws Exception
     */
    public function testConstructorWithDifferentParameters()
    {
        $customProvider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            'https://custom.auth.com/token',
            'custom-client',
            'custom-secret'
        );

        $responseBody = json_encode([
            'access_token' => 'custom-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $this->assertEquals('https://custom.auth.com/token', (string)$request->getUri());
                $body = (string)$request->getBody();
                $this->assertStringContainsString('client_id=custom-client', $body);
                $this->assertStringContainsString('api_token=custom-secret', $body);
                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $result = $customProvider->exchangeCodeForToken();

        $this->assertTrue($result);
    }

    /**
     * FIX 2 — refreshAccessToken() sends Authorization: Basic header.
     *
     * @throws Exception
     */
    public function testRefreshAccessTokenSendsBasicAuthHeader(): void
    {
        // First: exchange api_token to get an access_token + refresh_token
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'refresh-token-abc',
            'expires_in'    => -1, // already expired → will trigger refresh on next call
        ]);

        // Second: refresh call
        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $secondResponse) {
                $body = (string)$request->getBody();
                if (str_contains($body, 'grant_type=refresh_token')) {
                    // Assert Basic auth header present on refresh call (FIX 2)
                    $authHeader = $request->getHeaderLine('Authorization');
                    $this->assertStringStartsWith('Basic ', $authHeader);
                    $this->assertEquals('Basic ' . base64_encode('platform-api-user:'), $authHeader);
                    return new Response(200, ['Content-Type' => 'application/json'], $secondResponse);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer refreshed-token', $auth);
    }

    /**
     * FIX 2 — refreshAccessToken() uses grant_type=refresh_token.
     *
     * @throws Exception
     */
    public function testRefreshAccessTokenUsesGrantTypeRefreshToken(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'my-refresh-token',
            'expires_in'    => -1,
        ]);

        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $secondResponse) {
                $body = (string)$request->getBody();
                if (str_contains($body, 'grant_type=refresh_token')) {
                    $this->assertStringContainsString('refresh_token=my-refresh-token', $body);
                    $this->assertStringContainsString('client_id=' . $this->clientId, $body);
                    return new Response(200, ['Content-Type' => 'application/json'], $secondResponse);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $this->oauthProvider->getAuthorization();
    }

    /**
     * FIX 1 + FIX 3 — Expired token with refresh_token available → refresh_token grant used first.
     *
     * @throws Exception
     */
    public function testEnsureValidTokenPrefersRefreshTokenGrant(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'short-lived-token',
            'refresh_token' => 'stored-refresh-token',
            'expires_in'    => -1, // immediately expired
        ]);

        $refreshResponse = json_encode([
            'access_token' => 'token-via-refresh',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $refreshResponse, &$callCount) {
                $callCount++;
                if ($callCount === 2) {
                    $body = (string)$request->getBody();
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $callCount === 1 ? $firstResponse : $refreshResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer token-via-refresh', $auth);
    }

    /**
     * FIX 1 + FIX 3 — If refresh fails, fallback to api_token grant.
     *
     * @throws Exception
     */
    public function testFallbackToApiTokenIfRefreshFails(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'bad-refresh-token',
            'expires_in'    => -1,
        ]);

        $fallbackResponse = json_encode([
            'access_token' => 'fallback-token',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $fallbackResponse, &$callCount) {
                $callCount++;
                $body = (string)$request->getBody();
                if ($callCount === 1) {
                    // Initial exchange
                    return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
                }
                if ($callCount === 2) {
                    // Refresh attempt — fail with 401
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                    return new Response(401, [], 'Unauthorized');
                }
                // Fallback to api_token
                $this->assertStringContainsString('grant_type=api_token', $body);
                return new Response(200, ['Content-Type' => 'application/json'], $fallbackResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer fallback-token', $auth);
    }

    /**
     * FIX 1 — forceRefresh() triggers acquisition even when cached token appears valid.
     *
     * @throws Exception
     */
    public function testForceRefreshTriggersAcquisitionEvenWithValidToken(): void
    {
        $firstResponse = json_encode([
            'access_token' => 'valid-long-lived-token',
            'expires_in'   => 7200, // 2 hours
        ]);

        $forcedResponse = json_encode([
            'access_token' => 'force-refreshed-token',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $firstResponse),
                new Response(200, ['Content-Type' => 'application/json'], $forcedResponse),
            );

        $this->oauthProvider->getAuthorization(); // prime the cache
        $this->oauthProvider->forceRefresh();     // must bypass cache

        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer force-refreshed-token', $auth);
    }

    /**
     * FIX 1 — forceRefresh() prefers refresh_token grant if one is available.
     *
     * @throws Exception
     */
    public function testForceRefreshPrefersRefreshTokenIfAvailable(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'my-refresh-token',
            'expires_in'    => 7200,
        ]);

        $refreshedResponse = json_encode([
            'access_token' => 'force-refresh-via-refresh-grant',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $refreshedResponse) {
                $body = (string)$request->getBody();
                if (str_contains($body, 'grant_type=refresh_token')) {
                    return new Response(200, ['Content-Type' => 'application/json'], $refreshedResponse);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
            });

        $this->oauthProvider->getAuthorization(); // prime cache with refresh_token stored
        $auth = $this->oauthProvider->forceRefresh(); // must use refresh_token grant

        $authorization = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer force-refresh-via-refresh-grant', $authorization);
    }

    /**
     * FIX 5 — Re-entrance guard: while acquiringToken=true, ensureValidToken() is a no-op.
     *
     * @throws Exception
     */
    public function testReEntranceGuardPreventsDoubleAcquisition(): void
    {
        // Simulate being mid-acquisition by setting the flag via reflection
        $reflection = new \ReflectionClass($this->oauthProvider);
        $prop = $reflection->getProperty('acquiringToken');
        $prop->setAccessible(true);
        $prop->setValue($this->oauthProvider, true);

        // No HTTP call should be triggered since acquisition is already in progress
        $this->httpClient
            ->expects($this->never())
            ->method('sendRequest');

        $this->oauthProvider->ensureValidToken();
    }

    /**
     * FIX 4 — refreshAccessToken() sends request to refreshEndpoint, not tokenEndpoint.
     *
     * @throws Exception
     */
    public function testRefreshEndpointUsedForRefreshTokenGrant(): void
    {
        $distinctRefreshEndpoint = 'https://auth.upsun.com/oauth2/refresh';

        $provider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret,
            $distinctRefreshEndpoint,
        );

        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'refresh-token-xyz',
            'expires_in'    => -1,
        ]);

        $refreshResponse = json_encode([
            'access_token' => 'token-from-refresh-endpoint',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $refreshResponse, $distinctRefreshEndpoint) {
                $body = (string)$request->getBody();
                if (str_contains($body, 'grant_type=refresh_token')) {
                    // Must target the refresh endpoint, not the token endpoint
                    $this->assertEquals($distinctRefreshEndpoint, (string)$request->getUri());
                    return new Response(200, ['Content-Type' => 'application/json'], $refreshResponse);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
            });

        $provider->exchangeCodeForToken();
        $auth = $provider->getAuthorization();
        $this->assertEquals('Bearer token-from-refresh-endpoint', $auth);
    }

    /**
     * FIX 3 — 120 s proactive buffer: expires_in < 120 triggers refresh; >= 121 does not.
     *
     * @throws Exception
     */
    public function testBuffer120SecondsTriggersProactiveRefresh(): void
    {
        // Case A: expires_in=119 → within 120 s buffer → refresh triggered
        $almostExpiredResponse = json_encode([
            'access_token' => 'almost-expired-token',
            'expires_in'   => 119,
        ]);
        $refreshedResponse = json_encode([
            'access_token' => 'buffer-refreshed-token',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $almostExpiredResponse),
                new Response(200, ['Content-Type' => 'application/json'], $refreshedResponse),
            );

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization(); // should detect buffer and refresh
        $this->assertEquals('Bearer buffer-refreshed-token', $auth);

        // Case B: expires_in=121 → outside 120 s buffer → no refresh on same-second call
        $provider2 = new OAuthProvider(
            $this->createMock(ClientInterface::class),
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret,
        );

        $longLivedResponse = json_encode([
            'access_token' => 'long-lived-token',
            'expires_in'   => 121,
        ]);

        /** @var ClientInterface&\PHPUnit\Framework\MockObject\MockObject $client2 */
        $client2 = $this->createMock(ClientInterface::class);
        $client2->expects($this->once()) // only the initial exchange, no re-fetch
            ->method('sendRequest')
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $longLivedResponse));

        $provider2 = new OAuthProvider(
            $client2,
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret,
        );

        $provider2->exchangeCodeForToken();
        $provider2->getAuthorization(); // must NOT trigger a second HTTP call
    }

    /**
     * FIX 2 — refreshAccessToken() throws (and doAcquireToken falls back) when refresh response
     * contains invalid JSON.
     *
     * @throws Exception
     */
    public function testRefreshAccessTokenFallsBackOnInvalidJsonResponse(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'valid-refresh-token',
            'expires_in'    => -1,
        ]);

        $fallbackResponse = json_encode([
            'access_token' => 'api-token-fallback',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $fallbackResponse, &$callCount) {
                $callCount++;
                $body = (string)$request->getBody();
                if ($callCount === 1) {
                    return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
                }
                if ($callCount === 2) {
                    // Refresh request — return invalid JSON
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                    return new Response(200, ['Content-Type' => 'application/json'], 'not-valid-json{{{');
                }
                // Fallback to api_token
                $this->assertStringContainsString('grant_type=api_token', $body);
                return new Response(200, ['Content-Type' => 'application/json'], $fallbackResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer api-token-fallback', $auth);
    }

    /**
     * FIX 2 — refreshAccessToken() throws (and doAcquireToken falls back) when refresh response
     * has no access_token.
     *
     * @throws Exception
     */
    public function testRefreshAccessTokenFallsBackWhenMissingAccessToken(): void
    {
        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'valid-refresh-token',
            'expires_in'    => -1,
        ]);

        $refreshWithoutToken = json_encode([
            'expires_in' => 3600,
        ]);

        $fallbackResponse = json_encode([
            'access_token' => 'api-token-fallback',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $refreshWithoutToken, $fallbackResponse, &$callCount) {
                $callCount++;
                $body = (string)$request->getBody();
                if ($callCount === 1) {
                    return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
                }
                if ($callCount === 2) {
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                    return new Response(200, ['Content-Type' => 'application/json'], $refreshWithoutToken);
                }
                $this->assertStringContainsString('grant_type=api_token', $body);
                return new Response(200, ['Content-Type' => 'application/json'], $fallbackResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer api-token-fallback', $auth);
    }

    /**
     * FIX 2 — refreshAccessToken() wraps ClientExceptionInterface and doAcquireToken falls back.
     *
     * @throws Exception
     */
    public function testRefreshAccessTokenFallsBackOnClientException(): void
    {
        $networkError = new class ('Connection timed out') extends \Exception implements ClientExceptionInterface {
        };

        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'valid-refresh-token',
            'expires_in'    => -1,
        ]);

        $fallbackResponse = json_encode([
            'access_token' => 'api-token-fallback',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $fallbackResponse, $networkError, &$callCount) {
                $callCount++;
                $body = (string)$request->getBody();
                if ($callCount === 1) {
                    return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
                }
                if ($callCount === 2) {
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                    throw $networkError;
                }
                $this->assertStringContainsString('grant_type=api_token', $body);
                return new Response(200, ['Content-Type' => 'application/json'], $fallbackResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer api-token-fallback', $auth);
    }

    /**
     * storeTokenData() — token_type and refresh_token from response are stored.
     * Verified by checking that a subsequent expiry triggers refresh_token grant (not api_token).
     *
     * @throws Exception
     */
    public function testStoreTokenDataPersistsRefreshToken(): void
    {
        $initialResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'persisted-refresh-token',
            'token_type'    => 'Bearer',
            'expires_in'    => -1,
        ]);

        $refreshResponse = json_encode([
            'access_token' => 'refreshed-via-stored-token',
            'expires_in'   => 3600,
        ]);

        $callCount = 0;
        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($initialResponse, $refreshResponse, &$callCount) {
                $callCount++;
                $body = (string)$request->getBody();
                if ($callCount === 2) {
                    // The stored refresh_token must appear in the refresh call body
                    $this->assertStringContainsString('grant_type=refresh_token', $body);
                    $this->assertStringContainsString('refresh_token=persisted-refresh-token', $body);
                }
                return new Response(200, ['Content-Type' => 'application/json'],
                    $callCount === 1 ? $initialResponse : $refreshResponse);
            });

        $this->oauthProvider->exchangeCodeForToken();
        $auth = $this->oauthProvider->getAuthorization();
        $this->assertEquals('Bearer refreshed-via-stored-token', $auth);
    }

    /**
     * FIX 4 — When no refreshEndpoint is provided, tokenEndpoint is used as fallback.
     *
     * @throws Exception
     */
    public function testRefreshEndpointDefaultsToTokenEndpoint(): void
    {
        // Construct a provider WITHOUT a refreshEndpoint
        $provider = new OAuthProvider(
            $this->httpClient,
            $this->requestFactory,
            $this->tokenEndpoint,
            $this->clientId,
            $this->clientSecret,
            // no refreshEndpoint
        );

        $firstResponse = json_encode([
            'access_token'  => 'initial-token',
            'refresh_token' => 'refresh-abc',
            'expires_in'    => -1,
        ]);

        $refreshResponse = json_encode([
            'access_token' => 'token-after-refresh',
            'expires_in'   => 3600,
        ]);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($firstResponse, $refreshResponse) {
                $body = (string)$request->getBody();
                if (str_contains($body, 'grant_type=refresh_token')) {
                    // Should target tokenEndpoint (the default)
                    $this->assertEquals($this->tokenEndpoint, (string)$request->getUri());
                    return new Response(200, ['Content-Type' => 'application/json'], $refreshResponse);
                }
                return new Response(200, ['Content-Type' => 'application/json'], $firstResponse);
            });

        $provider->exchangeCodeForToken();
        $auth = $provider->getAuthorization();
        $this->assertEquals('Bearer token-after-refresh', $auth);
    }

    /**
     * @throws Exception
     */
    public function testAuthorizationHeaderFormat()
    {
        $responseBody = json_encode([
            'access_token' => 'platform-api-user:',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->with($this->callback(function (RequestInterface $request) {
                $authHeader = $request->getHeaderLine('Authorization');
                $this->assertStringStartsWith('Basic ', $authHeader);

                // Verify base64 encoding of 'platform-api-user:'
                $expectedEncoded = base64_encode('platform-api-user:');
                $this->assertEquals('Basic ' . $expectedEncoded, $authHeader);

                return true;
            }))
            ->willReturn(new Response(200, ['Content-Type' => 'application/json'], $responseBody));

        $this->oauthProvider->exchangeCodeForToken();
    }

    /**
     * @throws Exception
     */
    public function testExchangeCodeForTokenWithMissingExpiresIn()
    {
        $firstResponse = json_encode([
            'access_token' => 'token-without-expiry'
        ]);

        $secondResponse = json_encode([
            'access_token' => 'refreshed-token',
            'expires_in' => 3600
        ]);

        $this->httpClient
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(
                new Response(200, ['Content-Type' => 'application/json'], $firstResponse),
                new Response(200, ['Content-Type' => 'application/json'], $secondResponse)
            );

        $result = $this->oauthProvider->exchangeCodeForToken();

        $this->assertTrue($result);

        // Token should be immediately expired (0 seconds + time())
        // Next call should trigger a refresh and get new token
        $authorization = $this->oauthProvider->getAuthorization();

        $this->assertEquals('Bearer refreshed-token', $authorization);
    }
}
