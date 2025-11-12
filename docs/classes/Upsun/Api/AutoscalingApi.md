# AutoscalingApi

Low level AutoscalingApi (auto-generated)

***

* Full name: `\Upsun\Api\AutoscalingApi`
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

### getAutoscalerSettings

Retrieves Autoscaler settings

```php
public getAutoscalerSettings(string $projectId, string $environmentId): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter        | Type       | Description                                                          |
|------------------|------------|----------------------------------------------------------------------|
| `$projectId`     | **string** | A string that uniquely identifies the project (required)             |
| `$environmentId` | **string** | A string that uniquely identifies the project environment (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Autoscaling/operation/get-autoscaler-settings

***

### getAutoscalerSettingsWithHttpInfo

```php
private getAutoscalerSettingsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter        | Type       | Description                                                          |
|------------------|------------|----------------------------------------------------------------------|
| `$projectId`     | **string** | A string that uniquely identifies the project (required)             |
| `$environmentId` | **string** | A string that uniquely identifies the project environment (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getAutoscalerSettingsRequest

Create request for operation 'getAutoscalerSettings'

```php
private getAutoscalerSettingsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description                                                          |
|------------------|------------|----------------------------------------------------------------------|
| `$projectId`     | **string** | A string that uniquely identifies the project (required)             |
| `$environmentId` | **string** | A string that uniquely identifies the project environment (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### patchAutoscalerSettings

Modifies Autoscaler settings

```php
public patchAutoscalerSettings(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to modify (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Autoscaling/operation/patch-autoscaler-settings

***

### patchAutoscalerSettingsWithHttpInfo

```php
private patchAutoscalerSettingsWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to modify (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### patchAutoscalerSettingsRequest

Create request for operation 'patchAutoscalerSettings'

```php
private patchAutoscalerSettingsRequest(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to modify (optional)                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### postAutoscalerSettings

Updates Autoscaler settings

```php
public postAutoscalerSettings(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to update (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Autoscaling/operation/post-autoscaler-settings

***

### postAutoscalerSettingsWithHttpInfo

```php
private postAutoscalerSettingsWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to update (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### postAutoscalerSettingsRequest

Create request for operation 'postAutoscalerSettings'

```php
private postAutoscalerSettingsRequest(string $projectId, string $environmentId, \Upsun\Model\AutoscalerSettings|null $autoscalerSettings = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                                      | Description                                                          |
|-----------------------|-------------------------------------------|----------------------------------------------------------------------|
| `$projectId`          | **string**                                | A string that uniquely identifies the project (required)             |
| `$environmentId`      | **string**                                | A string that uniquely identifies the project environment (required) |
| `$autoscalerSettings` | **\Upsun\Model\AutoscalerSettings\|null** | Settings to update (optional)                                        |

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
