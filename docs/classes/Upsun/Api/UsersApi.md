# UsersApi

Low level UsersApi (auto-generated)

***

* Full name: `\Upsun\Api\UsersApi`
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

### getCurrentUser

Get the current user

```php
public getCurrentUser(): \Upsun\Model\User
```

Retrieves the current user, determined from the used access token.

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-current-user

***

### getCurrentUserWithHttpInfo

Get the current user with HTTP Info

```php
private getCurrentUserWithHttpInfo(): \Upsun\Model\User
```

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserRequest

Create request for operation 'getCurrentUser'

```php
private getCurrentUserRequest(): \Psr\Http\Message\RequestInterface
```

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getCurrentUserDeprecated

Get current logged-in user info

```php
public getCurrentUserDeprecated(): \Upsun\Model\CurrentUser
```

Retrieve information about the currently logged-in user (the user associated with the access token).

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-current-user-deprecated

***

### getCurrentUserDeprecatedWithHttpInfo

Get current logged-in user info with HTTP Info

```php
private getCurrentUserDeprecatedWithHttpInfo(): \Upsun\Model\CurrentUser
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserDeprecatedRequest

Create request for operation 'getCurrentUserDeprecated'

```php
private getCurrentUserDeprecatedRequest(): \Psr\Http\Message\RequestInterface
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getCurrentUserVerificationStatus

Check if phone verification is required

```php
public getCurrentUserVerificationStatus(): \Upsun\Model\GetCurrentUserVerificationStatus200Response
```

Find out if the current logged in user requires phone verification to create projects.

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-current-user-verification-status

***

### getCurrentUserVerificationStatusWithHttpInfo

Check if phone verification is required with HTTP Info

```php
private getCurrentUserVerificationStatusWithHttpInfo(): \Upsun\Model\GetCurrentUserVerificationStatus200Response
```

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserVerificationStatusRequest

Create request for operation 'getCurrentUserVerificationStatus'

```php
private getCurrentUserVerificationStatusRequest(): \Psr\Http\Message\RequestInterface
```

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getCurrentUserVerificationStatusFull

Check if verification is required

```php
public getCurrentUserVerificationStatusFull(): \Upsun\Model\GetCurrentUserVerificationStatusFull200Response
```

Find out if the current logged in user requires verification (phone or staff) to create projects.

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-current-user-verification-status-full

***

### getCurrentUserVerificationStatusFullWithHttpInfo

Check if verification is required with HTTP Info

```php
private getCurrentUserVerificationStatusFullWithHttpInfo(): \Upsun\Model\GetCurrentUserVerificationStatusFull200Response
```

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserVerificationStatusFullRequest

Create request for operation 'getCurrentUserVerificationStatusFull'

```php
private getCurrentUserVerificationStatusFullRequest(): \Psr\Http\Message\RequestInterface
```

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getUser

Get a user

```php
public getUser(string $userId): \Upsun\Model\User
```

Retrieves the specified user.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-user

***

### getUserWithHttpInfo

Get a user with HTTP Info

```php
private getUserWithHttpInfo(string $userId): \Upsun\Model\User
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getUserRequest

Create request for operation 'getUser'

```php
private getUserRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getUserByEmailAddress

Get a user by email

```php
public getUserByEmailAddress(string $email): \Upsun\Model\User
```

Retrieves a user matching the specified email address.

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-user-by-email-address

***

### getUserByEmailAddressWithHttpInfo

Get a user by email with HTTP Info

```php
private getUserByEmailAddressWithHttpInfo(string $email): \Upsun\Model\User
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getUserByEmailAddressRequest

Create request for operation 'getUserByEmailAddress'

```php
private getUserByEmailAddressRequest(string $email): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getUserByUsername

Get a user by username

```php
public getUserByUsername(string $username): \Upsun\Model\User
```

Retrieves a user matching the specified username.

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/get-user-by-username

***

### getUserByUsernameWithHttpInfo

Get a user by username with HTTP Info

```php
private getUserByUsernameWithHttpInfo(string $username): \Upsun\Model\User
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getUserByUsernameRequest

Create request for operation 'getUserByUsername'

```php
private getUserByUsernameRequest(string $username): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### resetEmailAddress

Reset email address

```php
public resetEmailAddress(string $userId, \Upsun\Model\ResetEmailAddressRequest|null $resetEmailAddressRequest = null): void
```

Requests a reset of the user's email address. A confirmation email will be sent to the new address when the
request is accepted.

**Parameters:**

| Parameter                   | Type                                            | Description                    |
|-----------------------------|-------------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                      | The ID of the user. (required) |
| `$resetEmailAddressRequest` | **\Upsun\Model\ResetEmailAddressRequest\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/reset-email-address

***

### resetEmailAddressWithHttpInfo

Reset email address with HTTP Info

```php
private resetEmailAddressWithHttpInfo(string $userId, \Upsun\Model\ResetEmailAddressRequest|null $resetEmailAddressRequest = null): void
```

**Parameters:**

| Parameter                   | Type                                            | Description                    |
|-----------------------------|-------------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                      | The ID of the user. (required) |
| `$resetEmailAddressRequest` | **\Upsun\Model\ResetEmailAddressRequest\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### resetEmailAddressRequest

Create request for operation 'resetEmailAddress'

```php
private resetEmailAddressRequest(string $userId, \Upsun\Model\ResetEmailAddressRequest|null $resetEmailAddressRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                   | Type                                            | Description                    |
|-----------------------------|-------------------------------------------------|--------------------------------|
| `$userId`                   | **string**                                      | The ID of the user. (required) |
| `$resetEmailAddressRequest` | **\Upsun\Model\ResetEmailAddressRequest\|null** | (optional)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### resetPassword

Reset user password

```php
public resetPassword(string $userId): void
```

Requests a reset of the user's password. A password reset email will be sent to the user when the request is
accepted.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/reset-password

***

### resetPasswordWithHttpInfo

Reset user password with HTTP Info

```php
private resetPasswordWithHttpInfo(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### resetPasswordRequest

Create request for operation 'resetPassword'

```php
private resetPasswordRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateUser

Update a user

```php
public updateUser(string $userId, ?\Upsun\Model\UpdateUserRequest $updateUserRequest = null): \Upsun\Model\User
```

Updates the specified user.

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$userId`            | **string**                          | The ID of the user. (required) |
| `$updateUserRequest` | **?\Upsun\Model\UpdateUserRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Users/operation/update-user

***

### updateUserWithHttpInfo

Update a user with HTTP Info

```php
private updateUserWithHttpInfo(string $userId, ?\Upsun\Model\UpdateUserRequest $updateUserRequest = null): \Upsun\Model\User
```

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$userId`            | **string**                          | The ID of the user. (required) |
| `$updateUserRequest` | **?\Upsun\Model\UpdateUserRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateUserRequest

Create request for operation 'updateUser'

```php
private updateUserRequest(string $userId, ?\Upsun\Model\UpdateUserRequest $updateUserRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$userId`            | **string**                          | The ID of the user. (required) |
| `$updateUserRequest` | **?\Upsun\Model\UpdateUserRequest** |                                |

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
