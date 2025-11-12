# ProfilesApi

Low level ProfilesApi (auto-generated)

***

* Full name: `\Upsun\Api\ProfilesApi`
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

### getOrgAddress

Get address

```php
public getOrgAddress(string $organizationId): \Upsun\Model\Address
```

Retrieves the address for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Profiles/operation/get-org-address

***

### getOrgAddressWithHttpInfo

Get address with HTTP Info

```php
private getOrgAddressWithHttpInfo(string $organizationId): \Upsun\Model\Address
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgAddressRequest

Create request for operation 'getOrgAddress'

```php
private getOrgAddressRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgProfile

Get profile

```php
public getOrgProfile(string $organizationId): \Upsun\Model\Profile
```

Retrieves the profile for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Profiles/operation/get-org-profile

***

### getOrgProfileWithHttpInfo

Get profile with HTTP Info

```php
private getOrgProfileWithHttpInfo(string $organizationId): \Upsun\Model\Profile
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgProfileRequest

Create request for operation 'getOrgProfile'

```php
private getOrgProfileRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrgAddress

Update address

```php
public updateOrgAddress(string $organizationId, ?\Upsun\Model\Address $address = null): \Upsun\Model\Address
```

Updates the address for the specified organization.

**Parameters:**

| Parameter         | Type                      | Description                            |
|-------------------|---------------------------|----------------------------------------|
| `$organizationId` | **string**                | The ID of the organization. (required) |
| `$address`        | **?\Upsun\Model\Address** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Profiles/operation/update-org-address

***

### updateOrgAddressWithHttpInfo

Update address with HTTP Info

```php
private updateOrgAddressWithHttpInfo(string $organizationId, ?\Upsun\Model\Address $address = null): \Upsun\Model\Address
```

**Parameters:**

| Parameter         | Type                      | Description                            |
|-------------------|---------------------------|----------------------------------------|
| `$organizationId` | **string**                | The ID of the organization. (required) |
| `$address`        | **?\Upsun\Model\Address** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgAddressRequest

Create request for operation 'updateOrgAddress'

```php
private updateOrgAddressRequest(string $organizationId, ?\Upsun\Model\Address $address = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type                      | Description                            |
|-------------------|---------------------------|----------------------------------------|
| `$organizationId` | **string**                | The ID of the organization. (required) |
| `$address`        | **?\Upsun\Model\Address** |                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrgProfile

Update profile

```php
public updateOrgProfile(string $organizationId, ?\Upsun\Model\UpdateOrgProfileRequest $updateOrgProfileRequest = null): \Upsun\Model\Profile
```

Updates the profile for the specified organization.

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$updateOrgProfileRequest` | **?\Upsun\Model\UpdateOrgProfileRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Profiles/operation/update-org-profile

***

### updateOrgProfileWithHttpInfo

Update profile with HTTP Info

```php
private updateOrgProfileWithHttpInfo(string $organizationId, ?\Upsun\Model\UpdateOrgProfileRequest $updateOrgProfileRequest = null): \Upsun\Model\Profile
```

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$updateOrgProfileRequest` | **?\Upsun\Model\UpdateOrgProfileRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgProfileRequest

Create request for operation 'updateOrgProfile'

```php
private updateOrgProfileRequest(string $organizationId, ?\Upsun\Model\UpdateOrgProfileRequest $updateOrgProfileRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$updateOrgProfileRequest` | **?\Upsun\Model\UpdateOrgProfileRequest** |                                        |

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
