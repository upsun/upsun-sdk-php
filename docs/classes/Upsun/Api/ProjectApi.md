# ProjectApi

Low level ProjectApi (auto-generated)

***

* Full name: `\Upsun\Api\ProjectApi`
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

### actionProjectsClearBuildCache

Clear project build cache

```php
public actionProjectsClearBuildCache(string $projectId): \Upsun\Model\AcceptedResponse
```

On rare occasions, a project's build cache can become corrupted. This endpoint will entirely flush the project's
build cache. More information on [clearing the build cache can be found in our user
documentation.](https://docs.upsun.com/anchors/troubleshoot/clear-build-cache/)

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project/operation/action-projects-clear-build-cache

***

### actionProjectsClearBuildCacheWithHttpInfo

Clear project build cache with HTTP Info

```php
private actionProjectsClearBuildCacheWithHttpInfo(string $projectId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### actionProjectsClearBuildCacheRequest

Create request for operation 'actionProjectsClearBuildCache'

```php
private actionProjectsClearBuildCacheRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjects

Get a project

```php
public getProjects(string $projectId): \Upsun\Model\Project
```

Retrieve the details of a single project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project/operation/get-projects

***

### getProjectsWithHttpInfo

Get a project with HTTP Info

```php
private getProjectsWithHttpInfo(string $projectId): \Upsun\Model\Project
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsRequest

Create request for operation 'getProjects'

```php
private getProjectsRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsCapabilities

Get a project's capabilities

```php
public getProjectsCapabilities(string $projectId): \Upsun\Model\ProjectCapabilities
```

Get a list of capabilities on a project, as defined by the billing system. For instance, one special capability
that could be defined on a project is large development environments.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project/operation/get-projects-capabilities

***

### getProjectsCapabilitiesWithHttpInfo

Get a project's capabilities with HTTP Info

```php
private getProjectsCapabilitiesWithHttpInfo(string $projectId): \Upsun\Model\ProjectCapabilities
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsCapabilitiesRequest

Create request for operation 'getProjectsCapabilities'

```php
private getProjectsCapabilitiesRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjects

Update a project

```php
public updateProjects(string $projectId, \Upsun\Model\ProjectPatch $projectPatch): \Upsun\Model\AcceptedResponse
```

Update the details of an existing project.

**Parameters:**

| Parameter       | Type                          | Description |
|-----------------|-------------------------------|-------------|
| `$projectId`    | **string**                    |             |
| `$projectPatch` | **\Upsun\Model\ProjectPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project/operation/update-projects

***

### updateProjectsWithHttpInfo

Update a project with HTTP Info

```php
private updateProjectsWithHttpInfo(string $projectId, \Upsun\Model\ProjectPatch $projectPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter       | Type                          | Description |
|-----------------|-------------------------------|-------------|
| `$projectId`    | **string**                    |             |
| `$projectPatch` | **\Upsun\Model\ProjectPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsRequest

Create request for operation 'updateProjects'

```php
private updateProjectsRequest(string $projectId, \Upsun\Model\ProjectPatch $projectPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter       | Type                          | Description |
|-----------------|-------------------------------|-------------|
| `$projectId`    | **string**                    |             |
| `$projectPatch` | **\Upsun\Model\ProjectPatch** | (required)  |

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
