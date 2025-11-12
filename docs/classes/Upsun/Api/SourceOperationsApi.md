# SourceOperationsApi

Low level SourceOperationsApi (auto-generated)

***

* Full name: `\Upsun\Api\SourceOperationsApi`
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

### listProjectsEnvironmentsSourceOperations

List source operations

```php
public listProjectsEnvironmentsSourceOperations(string $projectId, string $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

Lists all the source operations, defined in `.upsun/config.yaml`, that are available in an environment. More
information on source code operations is [available in our user
documentation](https://docs.upsun.com/anchors/app/reference/source/operations/).

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Source-Operations/operation/list-projects-environments-source-operations

***

### listProjectsEnvironmentsSourceOperationsWithHttpInfo

List source operations with HTTP Info

```php
private listProjectsEnvironmentsSourceOperationsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsEnvironmentsSourceOperationsRequest

Create request for operation 'listProjectsEnvironmentsSourceOperations'

```php
private listProjectsEnvironmentsSourceOperationsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### runSourceOperation

Trigger a source operation

```php
public runSourceOperation(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSourceOperationInput $environmentSourceOperationInput): \Upsun\Model\AcceptedResponse
```

This endpoint triggers a source code operation as defined in the `source.operations` key in a project's
`.upsun/config.yaml` configuration. More information on source code operations is [available in our user
documentation](https://docs.upsun.com/anchors/app/reference/source/operations/).

**Parameters:**

| Parameter                          | Type                                             | Description |
|------------------------------------|--------------------------------------------------|-------------|
| `$projectId`                       | **string**                                       |             |
| `$environmentId`                   | **string**                                       |             |
| `$environmentSourceOperationInput` | **\Upsun\Model\EnvironmentSourceOperationInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Source-Operations/operation/run-source-operation

***

### runSourceOperationWithHttpInfo

Trigger a source operation with HTTP Info

```php
private runSourceOperationWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSourceOperationInput $environmentSourceOperationInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type                                             | Description |
|------------------------------------|--------------------------------------------------|-------------|
| `$projectId`                       | **string**                                       |             |
| `$environmentId`                   | **string**                                       |             |
| `$environmentSourceOperationInput` | **\Upsun\Model\EnvironmentSourceOperationInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### runSourceOperationRequest

Create request for operation 'runSourceOperation'

```php
private runSourceOperationRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSourceOperationInput $environmentSourceOperationInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                          | Type                                             | Description |
|------------------------------------|--------------------------------------------------|-------------|
| `$projectId`                       | **string**                                       |             |
| `$environmentId`                   | **string**                                       |             |
| `$environmentSourceOperationInput` | **\Upsun\Model\EnvironmentSourceOperationInput** | (required)  |

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
