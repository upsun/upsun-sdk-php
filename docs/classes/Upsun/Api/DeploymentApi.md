# DeploymentApi

Low level DeploymentApi (auto-generated)

***

* Full name: `\Upsun\Api\DeploymentApi`
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

### getProjectsEnvironmentsDeployments

Get a single environment deployment

```php
public getProjectsEnvironmentsDeployments(string $projectId, string $environmentId, string $deploymentId): \Upsun\Model\Deployment
```

Retrieve a single deployment configuration with an id of `current`. This may be subject to change in the future.
Only `current` can be queried.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment/operation/get-projects-environments-deployments

***

### getProjectsEnvironmentsDeploymentsWithHttpInfo

Get a single environment deployment with HTTP Info

```php
private getProjectsEnvironmentsDeploymentsWithHttpInfo(string $projectId, string $environmentId, string $deploymentId): \Upsun\Model\Deployment
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsEnvironmentsDeploymentsRequest

Create request for operation 'getProjectsEnvironmentsDeployments'

```php
private getProjectsEnvironmentsDeploymentsRequest(string $projectId, string $environmentId, string $deploymentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironmentsDeployments

Get an environment's deployment information

```php
public listProjectsEnvironmentsDeployments(string $projectId, string $environmentId): \Upsun\Model\Deployment[]
```

Retrieve the read-only configuration of an environment's deployment. The returned information is everything
required to recreate a project's current deployment. More specifically, the objects returned by this endpoint
contain the configuration derived from the repository's YAML configuration file: `.upsun/config.yaml`.
Additionally, any values deriving from environment variables, the domains attached to a project, project access
settings, etc. are included here. This endpoint currently returns a list containing a single deployment
configuration with an `id` of `current`. This may be subject to change in the future.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment/operation/list-projects-environments-deployments

***

### listProjectsEnvironmentsDeploymentsWithHttpInfo

Get an environment's deployment information with HTTP Info

```php
private listProjectsEnvironmentsDeploymentsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\Deployment[]
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

### listProjectsEnvironmentsDeploymentsRequest

Create request for operation 'listProjectsEnvironmentsDeployments'

```php
private listProjectsEnvironmentsDeploymentsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsEnvironmentsDeploymentsNext

Update the next deployment

```php
public updateProjectsEnvironmentsDeploymentsNext(string $projectId, string $environmentId, \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest $updateProjectsEnvironmentsDeploymentsNextRequest): \Upsun\Model\AcceptedResponse
```

Update resources for either webapps, services, or workers in the next deployment.

**Parameters:**

| Parameter                                           | Type                                                              | Description |
|-----------------------------------------------------|-------------------------------------------------------------------|-------------|
| `$projectId`                                        | **string**                                                        |             |
| `$environmentId`                                    | **string**                                                        |             |
| `$updateProjectsEnvironmentsDeploymentsNextRequest` | **\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment/operation/update-projects-environments-deployments-next

***

### updateProjectsEnvironmentsDeploymentsNextWithHttpInfo

Update the next deployment with HTTP Info

```php
private updateProjectsEnvironmentsDeploymentsNextWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest $updateProjectsEnvironmentsDeploymentsNextRequest): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                                           | Type                                                              | Description |
|-----------------------------------------------------|-------------------------------------------------------------------|-------------|
| `$projectId`                                        | **string**                                                        |             |
| `$environmentId`                                    | **string**                                                        |             |
| `$updateProjectsEnvironmentsDeploymentsNextRequest` | **\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsEnvironmentsDeploymentsNextRequest

Create request for operation 'updateProjectsEnvironmentsDeploymentsNext'

```php
private updateProjectsEnvironmentsDeploymentsNextRequest(string $projectId, string $environmentId, \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest $updateProjectsEnvironmentsDeploymentsNextRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                                           | Type                                                              | Description |
|-----------------------------------------------------|-------------------------------------------------------------------|-------------|
| `$projectId`                                        | **string**                                                        |             |
| `$environmentId`                                    | **string**                                                        |             |
| `$updateProjectsEnvironmentsDeploymentsNextRequest` | **\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest** |             |

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
