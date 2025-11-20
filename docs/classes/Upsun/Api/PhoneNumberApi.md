# PhoneNumberApi

Low level PhoneNumberApi (auto-generated)

***

* Full name: `\Upsun\Api\PhoneNumberApi`
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

### confirmPhoneNumber

Confirm phone number

```php
public confirmPhoneNumber(string $sid, string $userId, ?\Upsun\Model\ConfirmPhoneNumberRequest $confirmPhoneNumberRequest = null): void
```

Confirms phone number using a verification code.

**Parameters:**

| Parameter                    | Type                                        | Description                    |
|------------------------------|---------------------------------------------|--------------------------------|
| `$sid`                       | **string**                                  | (required)                     |
| `$userId`                    | **string**                                  | The ID of the user. (required) |
| `$confirmPhoneNumberRequest` | **?\Upsun\Model\ConfirmPhoneNumberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/PhoneNumber/operation/confirm-phone-number

***

### confirmPhoneNumberWithHttpInfo

Confirm phone number with HTTP Info

```php
private confirmPhoneNumberWithHttpInfo(string $sid, string $userId, ?\Upsun\Model\ConfirmPhoneNumberRequest $confirmPhoneNumberRequest = null): void
```

**Parameters:**

| Parameter                    | Type                                        | Description                    |
|------------------------------|---------------------------------------------|--------------------------------|
| `$sid`                       | **string**                                  | (required)                     |
| `$userId`                    | **string**                                  | The ID of the user. (required) |
| `$confirmPhoneNumberRequest` | **?\Upsun\Model\ConfirmPhoneNumberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### confirmPhoneNumberRequest

Create request for operation 'confirmPhoneNumber'

```php
private confirmPhoneNumberRequest(string $sid, string $userId, ?\Upsun\Model\ConfirmPhoneNumberRequest $confirmPhoneNumberRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                    | Type                                        | Description                    |
|------------------------------|---------------------------------------------|--------------------------------|
| `$sid`                       | **string**                                  | (required)                     |
| `$userId`                    | **string**                                  | The ID of the user. (required) |
| `$confirmPhoneNumberRequest` | **?\Upsun\Model\ConfirmPhoneNumberRequest** |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### verifyPhoneNumber

Verify phone number

```php
public verifyPhoneNumber(string $userId, ?\Upsun\Model\VerifyPhoneNumberRequest $verifyPhoneNumberRequest = null): \Upsun\Model\VerifyPhoneNumber200Response
```

Starts a phone number verification session.

**Parameters:**

| Parameter                   | Type                                       | Description                    |
|-----------------------------|--------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                 | The ID of the user. (required) |
| `$verifyPhoneNumberRequest` | **?\Upsun\Model\VerifyPhoneNumberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/PhoneNumber/operation/verify-phone-number

***

### verifyPhoneNumberWithHttpInfo

Verify phone number with HTTP Info

```php
private verifyPhoneNumberWithHttpInfo(string $userId, ?\Upsun\Model\VerifyPhoneNumberRequest $verifyPhoneNumberRequest = null): \Upsun\Model\VerifyPhoneNumber200Response
```

**Parameters:**

| Parameter                   | Type                                       | Description                    |
|-----------------------------|--------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                 | The ID of the user. (required) |
| `$verifyPhoneNumberRequest` | **?\Upsun\Model\VerifyPhoneNumberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### verifyPhoneNumberRequest

Create request for operation 'verifyPhoneNumber'

```php
private verifyPhoneNumberRequest(string $userId, ?\Upsun\Model\VerifyPhoneNumberRequest $verifyPhoneNumberRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                   | Type                                       | Description                    |
|-----------------------------|--------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                 | The ID of the user. (required) |
| `$verifyPhoneNumberRequest` | **?\Upsun\Model\VerifyPhoneNumberRequest** |                                |

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
