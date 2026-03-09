# UserProfilesApi

Low level UserProfilesApi (auto-generated)

***

* Full name: `\Upsun\Api\UserProfilesApi`
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

### createProfilePicture

Create a user profile picture

```php
public createProfilePicture(string $uuid, \SplFileObject|null $file = null): \Upsun\Model\CreateProfilePicture200Response
```

**Parameters:**

| Parameter | Type                     | Description |
|-----------|--------------------------|-------------|
| `$uuid`   | **string**               | (required)  |
| `$file`   | **\SplFileObject\|null** | (optional)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/create-profile-picture

***

### createProfilePictureWithHttpInfo

Create a user profile picture with HTTP Info

```php
private createProfilePictureWithHttpInfo(string $uuid, \SplFileObject|null $file = null): \Upsun\Model\CreateProfilePicture200Response
```

**Parameters:**

| Parameter | Type                     | Description |
|-----------|--------------------------|-------------|
| `$uuid`   | **string**               | (required)  |
| `$file`   | **\SplFileObject\|null** | (optional)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProfilePictureRequest

Create request for operation 'createProfilePicture'

```php
private createProfilePictureRequest(string $uuid, \SplFileObject|null $file = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type                     | Description |
|-----------|--------------------------|-------------|
| `$uuid`   | **string**               | (required)  |
| `$file`   | **\SplFileObject\|null** | (optional)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProfilePicture

Delete a user profile picture

```php
public deleteProfilePicture(string $uuid): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$uuid`   | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/delete-profile-picture

***

### deleteProfilePictureWithHttpInfo

Delete a user profile picture with HTTP Info

```php
private deleteProfilePictureWithHttpInfo(string $uuid): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$uuid`   | **string** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProfilePictureRequest

Create request for operation 'deleteProfilePicture'

```php
private deleteProfilePictureRequest(string $uuid): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$uuid`   | **string** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getAddress

Get a user address

```php
public getAddress(string $userId): \Upsun\Model\GetAddress200Response
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/get-address

***

### getAddressWithHttpInfo

Get a user address with HTTP Info

```php
private getAddressWithHttpInfo(string $userId): \Upsun\Model\GetAddress200Response
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getAddressRequest

Create request for operation 'getAddress'

```php
private getAddressRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProfile

Get a single user profile

```php
public getProfile(string $userId): \Upsun\Model\Profile
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/get-profile

***

### getProfileWithHttpInfo

Get a single user profile with HTTP Info

```php
private getProfileWithHttpInfo(string $userId): \Upsun\Model\Profile
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProfileRequest

Create request for operation 'getProfile'

```php
private getProfileRequest(string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                     |
|-----------|------------|---------------------------------|
| `$userId` | **string** | The UUID of the user (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProfiles

List user profiles

```php
public listProfiles(): \Upsun\Model\ListProfiles200Response
```

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/list-profiles

***

### listProfilesWithHttpInfo

List user profiles with HTTP Info

```php
private listProfilesWithHttpInfo(): \Upsun\Model\ListProfiles200Response
```

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProfilesRequest

Create request for operation 'listProfiles'

```php
private listProfilesRequest(): \Psr\Http\Message\RequestInterface
```

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateAddress

Update a user address

```php
public updateAddress(string $userId, ?\Upsun\Model\Address $address = null): \Upsun\Model\GetAddress200Response
```

Update a user address, supplying one or more key/value pairs to to change.

**Parameters:**

| Parameter  | Type                      | Description                     |
|------------|---------------------------|---------------------------------|
| `$userId`  | **string**                | The UUID of the user (required) |
| `$address` | **?\Upsun\Model\Address** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/update-address

***

### updateAddressWithHttpInfo

Update a user address with HTTP Info

```php
private updateAddressWithHttpInfo(string $userId, ?\Upsun\Model\Address $address = null): \Upsun\Model\GetAddress200Response
```

**Parameters:**

| Parameter  | Type                      | Description                     |
|------------|---------------------------|---------------------------------|
| `$userId`  | **string**                | The UUID of the user (required) |
| `$address` | **?\Upsun\Model\Address** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateAddressRequest

Create request for operation 'updateAddress'

```php
private updateAddressRequest(string $userId, ?\Upsun\Model\Address $address = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                      | Description                     |
|------------|---------------------------|---------------------------------|
| `$userId`  | **string**                | The UUID of the user (required) |
| `$address` | **?\Upsun\Model\Address** |                                 |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProfile

Update a user profile

```php
public updateProfile(string $userId, ?\Upsun\Model\UpdateProfileRequest $updateProfileRequest = null): \Upsun\Model\Profile
```

Update a user profile, supplying one or more key/value pairs to to change.

**Parameters:**

| Parameter               | Type                                   | Description                     |
|-------------------------|----------------------------------------|---------------------------------|
| `$userId`               | **string**                             | The UUID of the user (required) |
| `$updateProfileRequest` | **?\Upsun\Model\UpdateProfileRequest** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Profiles/operation/update-profile

***

### updateProfileWithHttpInfo

Update a user profile with HTTP Info

```php
private updateProfileWithHttpInfo(string $userId, ?\Upsun\Model\UpdateProfileRequest $updateProfileRequest = null): \Upsun\Model\Profile
```

**Parameters:**

| Parameter               | Type                                   | Description                     |
|-------------------------|----------------------------------------|---------------------------------|
| `$userId`               | **string**                             | The UUID of the user (required) |
| `$updateProfileRequest` | **?\Upsun\Model\UpdateProfileRequest** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProfileRequest

Create request for operation 'updateProfile'

```php
private updateProfileRequest(string $userId, ?\Upsun\Model\UpdateProfileRequest $updateProfileRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                                   | Description                     |
|-------------------------|----------------------------------------|---------------------------------|
| `$userId`               | **string**                             | The UUID of the user (required) |
| `$updateProfileRequest` | **?\Upsun\Model\UpdateProfileRequest** |                                 |

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
