# ApiTokensApi

Low level ApiTokensApi (auto-generated)

***

* Full name: `\Upsun\Api\ApiTokensApi`
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

### createApiToken

Create an API token

```php
public createApiToken(string $userId, ?\Upsun\Model\CreateApiTokenRequest $createApiTokenRequest = null): \Upsun\Model\ApiToken
```

Creates an API token

**Parameters:**

| Parameter                | Type                                    | Description                    |
|--------------------------|-----------------------------------------|--------------------------------|
| `$userId`                | **string**                              | The ID of the user. (required) |
| `$createApiTokenRequest` | **?\Upsun\Model\CreateApiTokenRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Api-Tokens/operation/create-api-token

***

### createApiTokenWithHttpInfo

Create an API token with HTTP Info

```php
private createApiTokenWithHttpInfo(string $userId, ?\Upsun\Model\CreateApiTokenRequest $createApiTokenRequest = null): \Upsun\Model\ApiToken
```

**Parameters:**

| Parameter                | Type                                    | Description                    |
|--------------------------|-----------------------------------------|--------------------------------|
| `$userId`                | **string**                              | The ID of the user. (required) |
| `$createApiTokenRequest` | **?\Upsun\Model\CreateApiTokenRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createApiTokenRequest

Create request for operation 'createApiToken'

```php
private createApiTokenRequest(string $userId, ?\Upsun\Model\CreateApiTokenRequest $createApiTokenRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                | Type                                    | Description                    |
|--------------------------|-----------------------------------------|--------------------------------|
| `$userId`                | **string**                              | The ID of the user. (required) |
| `$createApiTokenRequest` | **?\Upsun\Model\CreateApiTokenRequest** |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteApiToken

Delete an API token

```php
public deleteApiToken(string $userId, string $tokenId): void
```

Deletes an API token

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Api-Tokens/operation/delete-api-token

***

### deleteApiTokenWithHttpInfo

Delete an API token with HTTP Info

```php
private deleteApiTokenWithHttpInfo(string $userId, string $tokenId): void
```

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteApiTokenRequest

Create request for operation 'deleteApiToken'

```php
private deleteApiTokenRequest(string $userId, string $tokenId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getApiToken

Get an API token

```php
public getApiToken(string $userId, string $tokenId): \Upsun\Model\ApiToken
```

Retrieves the specified API token.

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Api-Tokens/operation/get-api-token

***

### getApiTokenWithHttpInfo

Get an API token with HTTP Info

```php
private getApiTokenWithHttpInfo(string $userId, string $tokenId): \Upsun\Model\ApiToken
```

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getApiTokenRequest

Create request for operation 'getApiToken'

```php
private getApiTokenRequest(string $userId, string $tokenId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type       | Description                    |
|------------|------------|--------------------------------|
| `$userId`  | **string** | The ID of the user. (required) |
| `$tokenId` | **string** | (required)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listApiTokens

List a user's API tokens

```php
public listApiTokens(string $userId): \Upsun\Model\ApiToken[]
```

Retrieves a list of API tokens associated with a single user.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Api-Tokens/operation/list-api-tokens

***

### listApiTokensWithHttpInfo

List a user's API tokens with HTTP Info

```php
private listApiTokensWithHttpInfo(string $userId): \Upsun\Model\ApiToken[]
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listApiTokensRequest

Create request for operation 'listApiTokens'

```php
private listApiTokensRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

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
