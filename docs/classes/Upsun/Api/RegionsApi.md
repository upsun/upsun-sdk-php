# RegionsApi

Low level RegionsApi (auto-generated)

***

* Full name: `\Upsun\Api\RegionsApi`
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

### getRegion

Get region

```php
public getRegion(string $regionId): \Upsun\Model\Region
```

Retrieves the specified region.

**Parameters:**

| Parameter   | Type       | Description                      |
|-------------|------------|----------------------------------|
| `$regionId` | **string** | The ID of the region. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Regions/operation/get-region

***

### getRegionWithHttpInfo

Get region with HTTP Info

```php
private getRegionWithHttpInfo(string $regionId): \Upsun\Model\Region
```

**Parameters:**

| Parameter   | Type       | Description                      |
|-------------|------------|----------------------------------|
| `$regionId` | **string** | The ID of the region. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getRegionRequest

Create request for operation 'getRegion'

```php
private getRegionRequest(string $regionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter   | Type       | Description                      |
|-------------|------------|----------------------------------|
| `$regionId` | **string** | The ID of the region. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listRegions

List regions

```php
public listRegions(\Upsun\Model\StringFilter|null $filterAvailable = null, \Upsun\Model\StringFilter|null $filterPrivate = null, \Upsun\Model\StringFilter|null $filterZone = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListRegions200Response
```

Retrieves a list of available regions.

**Parameters:**

| Parameter          | Type                                | Description                                                                                                                                             |
|--------------------|-------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterAvailable` | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterPrivate`   | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterZone`      | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$pageSize`        | **int\|null**                       | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore`      | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`       | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`            | **string\|null**                    | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Regions/operation/list-regions

***

### listRegionsWithHttpInfo

List regions with HTTP Info

```php
private listRegionsWithHttpInfo(\Upsun\Model\StringFilter|null $filterAvailable = null, \Upsun\Model\StringFilter|null $filterPrivate = null, \Upsun\Model\StringFilter|null $filterZone = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListRegions200Response
```

**Parameters:**

| Parameter          | Type                                | Description                                                                                                                                             |
|--------------------|-------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterAvailable` | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterPrivate`   | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterZone`      | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$pageSize`        | **int\|null**                       | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore`      | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`       | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`            | **string\|null**                    | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listRegionsRequest

Create request for operation 'listRegions'

```php
private listRegionsRequest(\Upsun\Model\StringFilter|null $filterAvailable = null, \Upsun\Model\StringFilter|null $filterPrivate = null, \Upsun\Model\StringFilter|null $filterZone = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter          | Type                                | Description                                                                                                                                             |
|--------------------|-------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterAvailable` | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterPrivate`   | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$filterZone`      | **\Upsun\Model\StringFilter\|null** | (optional)                                                                                                                                              |
| `$pageSize`        | **int\|null**                       | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore`      | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`       | **string\|null**                    | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`            | **string\|null**                    | (optional)                                                                                                                                              |

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
