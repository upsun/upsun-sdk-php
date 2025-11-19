# ProjectInvitationsApi

Low level ProjectInvitationsApi (auto-generated)

***

* Full name: `\Upsun\Api\ProjectInvitationsApi`
* Parent class: [`\Upsun\Api\AbstractApi`](./AbstractApi.md)
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### headerSelector

```php
private \Upsun\Api\ApiHeaderSelector $headerSelector
```

***

### config

```php
private \Upsun\Api\APIConfiguration $config
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, ?\Psr\Http\Client\ClientInterface $httpClient = null, ?\Psr\Http\Message\RequestFactoryInterface $requestFactory = null, ?\Upsun\Api\APIConfiguration $config = null, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null, ?\Upsun\Api\ApiHeaderSelector $selector = null): mixed
```

**Parameters:**

| Parameter         | Type                                           | Description |
|-------------------|------------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                  |             |
| `$httpClient`     | **?\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **?\Psr\Http\Message\RequestFactoryInterface** |             |
| `$config`         | **?\Upsun\Api\APIConfiguration**               |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface**  |             |
| `$selector`       | **?\Upsun\Api\ApiHeaderSelector**              |             |

***

### cancelProjectInvite

Cancel a pending invitation to a project

```php
public cancelProjectInvite(string $projectId, string $invitationId): void
```

Cancels the specified invitation.

**Parameters:**

| Parameter       | Type       | Description                          |
|-----------------|------------|--------------------------------------|
| `$projectId`    | **string** | The ID of the project. (required)    |
| `$invitationId` | **string** | The ID of the invitation. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Invitations/operation/cancel-project-invite

***

### cancelProjectInviteWithHttpInfo

Cancel a pending invitation to a project with HTTP Info

```php
private cancelProjectInviteWithHttpInfo(string $projectId, string $invitationId): void
```

**Parameters:**

| Parameter       | Type       | Description                          |
|-----------------|------------|--------------------------------------|
| `$projectId`    | **string** | The ID of the project. (required)    |
| `$invitationId` | **string** | The ID of the invitation. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### cancelProjectInviteRequest

Create request for operation 'cancelProjectInvite'

```php
private cancelProjectInviteRequest(string $projectId, string $invitationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter       | Type       | Description                          |
|-----------------|------------|--------------------------------------|
| `$projectId`    | **string** | The ID of the project. (required)    |
| `$invitationId` | **string** | The ID of the invitation. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### createProjectInvite

Invite user to a project by email

```php
public createProjectInvite(string $projectId, ?\Upsun\Model\CreateProjectInviteRequest $createProjectInviteRequest = null): \Upsun\Model\ProjectInvitation
```

Creates an invitation to a project for a user with the specified email address.

**Parameters:**

| Parameter                     | Type                                         | Description                       |
|-------------------------------|----------------------------------------------|-----------------------------------|
| `$projectId`                  | **string**                                   | The ID of the project. (required) |
| `$createProjectInviteRequest` | **?\Upsun\Model\CreateProjectInviteRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Invitations/operation/create-project-invite

***

### createProjectInviteWithHttpInfo

Invite user to a project by email with HTTP Info

```php
private createProjectInviteWithHttpInfo(string $projectId, ?\Upsun\Model\CreateProjectInviteRequest $createProjectInviteRequest = null): \Upsun\Model\ProjectInvitation
```

**Parameters:**

| Parameter                     | Type                                         | Description                       |
|-------------------------------|----------------------------------------------|-----------------------------------|
| `$projectId`                  | **string**                                   | The ID of the project. (required) |
| `$createProjectInviteRequest` | **?\Upsun\Model\CreateProjectInviteRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectInviteRequest

Create request for operation 'createProjectInvite'

```php
private createProjectInviteRequest(string $projectId, ?\Upsun\Model\CreateProjectInviteRequest $createProjectInviteRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                     | Type                                         | Description                       |
|-------------------------------|----------------------------------------------|-----------------------------------|
| `$projectId`                  | **string**                                   | The ID of the project. (required) |
| `$createProjectInviteRequest` | **?\Upsun\Model\CreateProjectInviteRequest** |                                   |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectInvites

List invitations to a project

```php
public listProjectInvites(string $projectId, \Upsun\Model\StringFilter|null $filterState = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ProjectInvitation[]
```

Returns a list of invitations to a project.

**Parameters:**

| Parameter      | Type                                | Description                       |
|----------------|-------------------------------------|-----------------------------------|
| `$projectId`   | **string**                          | The ID of the project. (required) |
| `$filterState` | **\Upsun\Model\StringFilter\|null** | (optional)                        |
| `$pageSize`    | **int\|null**                       | (optional)                        |
| `$pageBefore`  | **string\|null**                    | (optional)                        |
| `$pageAfter`   | **string\|null**                    | (optional)                        |
| `$sort`        | **string\|null**                    | (optional)                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Invitations/operation/list-project-invites

***

### listProjectInvitesWithHttpInfo

List invitations to a project with HTTP Info

```php
private listProjectInvitesWithHttpInfo(string $projectId, \Upsun\Model\StringFilter|null $filterState = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ProjectInvitation[]
```

**Parameters:**

| Parameter      | Type                                | Description                       |
|----------------|-------------------------------------|-----------------------------------|
| `$projectId`   | **string**                          | The ID of the project. (required) |
| `$filterState` | **\Upsun\Model\StringFilter\|null** | (optional)                        |
| `$pageSize`    | **int\|null**                       | (optional)                        |
| `$pageBefore`  | **string\|null**                    | (optional)                        |
| `$pageAfter`   | **string\|null**                    | (optional)                        |
| `$sort`        | **string\|null**                    | (optional)                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectInvitesRequest

Create request for operation 'listProjectInvites'

```php
private listProjectInvitesRequest(string $projectId, \Upsun\Model\StringFilter|null $filterState = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter      | Type                                | Description                       |
|----------------|-------------------------------------|-----------------------------------|
| `$projectId`   | **string**                          | The ID of the project. (required) |
| `$filterState` | **\Upsun\Model\StringFilter\|null** | (optional)                        |
| `$pageSize`    | **int\|null**                       | (optional)                        |
| `$pageBefore`  | **string\|null**                    | (optional)                        |
| `$pageAfter`   | **string\|null**                    | (optional)                        |
| `$sort`        | **string\|null**                    | (optional)                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, \Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $baseUri, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                 |             |
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$baseUri`        | **string**                                    |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface** |             |

***

### getAuthorizationHeader

```php
protected getAuthorizationHeader(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createAuthenticatedRequest

```php
protected createAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### sendAuthenticatedRequest

```php
protected sendAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\ResponseInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### refreshToken

```php
public refreshToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createRequest

Create request

```php
protected createRequest(string $method, string|\Psr\Http\Message\UriInterface $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string\|\Psr\Http\Message\UriInterface**          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

***

### createUri

```php
protected createUri(string $operationHost, string $resourcePath, array $queryParams): \Psr\Http\Message\UriInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$operationHost` | **string** |             |
| `$resourcePath`  | **string** |             |
| `$queryParams`   | **array**  |             |

***

### handleResponseWithDataType

```php
protected handleResponseWithDataType(class-string<\Upsun\Api\T>|string $dataType, \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Upsun\Api\T
```

**Parameters:**

| Parameter   | Type                                    | Description                                                       |
|-------------|-----------------------------------------|-------------------------------------------------------------------|
| `$dataType` | **class-string<\Upsun\Api\T>\|string**  | Fully-qualified class name, or scalar type like "string", "array" |
| `$request`  | **\Psr\Http\Message\RequestInterface**  |                                                                   |
| `$response` | **\Psr\Http\Message\ResponseInterface** |                                                                   |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserializeGenericArray

Deserialize generic types array<key,value>

```php
protected deserializeGenericArray(mixed $content, string $dataType, \Psr\Http\Message\RequestInterface $request): array
```

**Parameters:**

| Parameter   | Type                                   | Description |
|-------------|----------------------------------------|-------------|
| `$content`  | **mixed**                              |             |
| `$dataType` | **string**                             |             |
| `$request`  | **\Psr\Http\Message\RequestInterface** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
