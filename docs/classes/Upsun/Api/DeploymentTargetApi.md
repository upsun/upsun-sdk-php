# DeploymentTargetApi

Low level DeploymentTargetApi (auto-generated)

***

* Full name: `\Upsun\Api\DeploymentTargetApi`
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

### createProjectsDeployments

Create a project deployment target

```php
public createProjectsDeployments(string $projectId, \Upsun\Model\DeploymentTargetCreateInput $deploymentTargetCreateInput): \Upsun\Model\AcceptedResponse
```

Set the deployment target information for a project.

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$deploymentTargetCreateInput` | **\Upsun\Model\DeploymentTargetCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment-Target/operation/create-projects-deployments

***

### createProjectsDeploymentsWithHttpInfo

Create a project deployment target with HTTP Info

```php
private createProjectsDeploymentsWithHttpInfo(string $projectId, \Upsun\Model\DeploymentTargetCreateInput $deploymentTargetCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$deploymentTargetCreateInput` | **\Upsun\Model\DeploymentTargetCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsDeploymentsRequest

Create request for operation 'createProjectsDeployments'

```php
private createProjectsDeploymentsRequest(string $projectId, \Upsun\Model\DeploymentTargetCreateInput $deploymentTargetCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$deploymentTargetCreateInput` | **\Upsun\Model\DeploymentTargetCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsDeployments

Delete a single project deployment target

```php
public deleteProjectsDeployments(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\AcceptedResponse
```

Delete a single deployment target configuration associated with a specific project.

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment-Target/operation/delete-projects-deployments

***

### deleteProjectsDeploymentsWithHttpInfo

Delete a single project deployment target with HTTP Info

```php
private deleteProjectsDeploymentsWithHttpInfo(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsDeploymentsRequest

Create request for operation 'deleteProjectsDeployments'

```php
private deleteProjectsDeploymentsRequest(string $projectId, string $deploymentTargetConfigurationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsDeployments

Get a single project deployment target

```php
public getProjectsDeployments(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\DeploymentTarget
```

Get a single deployment target configuration of a project.

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment-Target/operation/get-projects-deployments

***

### getProjectsDeploymentsWithHttpInfo

Get a single project deployment target with HTTP Info

```php
private getProjectsDeploymentsWithHttpInfo(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\DeploymentTarget
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsDeploymentsRequest

Create request for operation 'getProjectsDeployments'

```php
private getProjectsDeploymentsRequest(string $projectId, string $deploymentTargetConfigurationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsDeployments

Get project deployment target info

```php
public listProjectsDeployments(string $projectId): \Upsun\Model\DeploymentTarget[]
```

The deployment target information for the project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment-Target/operation/list-projects-deployments

***

### listProjectsDeploymentsWithHttpInfo

Get project deployment target info with HTTP Info

```php
private listProjectsDeploymentsWithHttpInfo(string $projectId): \Upsun\Model\DeploymentTarget[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsDeploymentsRequest

Create request for operation 'listProjectsDeployments'

```php
private listProjectsDeploymentsRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsDeployments

Update a project deployment

```php
public updateProjectsDeployments(string $projectId, string $deploymentTargetConfigurationId, \Upsun\Model\DeploymentTargetPatch $deploymentTargetPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type                                   | Description |
|------------------------------------|----------------------------------------|-------------|
| `$projectId`                       | **string**                             |             |
| `$deploymentTargetConfigurationId` | **string**                             |             |
| `$deploymentTargetPatch`           | **\Upsun\Model\DeploymentTargetPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Deployment-Target/operation/update-projects-deployments

***

### updateProjectsDeploymentsWithHttpInfo

Update a project deployment with HTTP Info

```php
private updateProjectsDeploymentsWithHttpInfo(string $projectId, string $deploymentTargetConfigurationId, \Upsun\Model\DeploymentTargetPatch $deploymentTargetPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type                                   | Description |
|------------------------------------|----------------------------------------|-------------|
| `$projectId`                       | **string**                             |             |
| `$deploymentTargetConfigurationId` | **string**                             |             |
| `$deploymentTargetPatch`           | **\Upsun\Model\DeploymentTargetPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsDeploymentsRequest

Create request for operation 'updateProjectsDeployments'

```php
private updateProjectsDeploymentsRequest(string $projectId, string $deploymentTargetConfigurationId, \Upsun\Model\DeploymentTargetPatch $deploymentTargetPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                          | Type                                   | Description |
|------------------------------------|----------------------------------------|-------------|
| `$projectId`                       | **string**                             |             |
| `$deploymentTargetConfigurationId` | **string**                             |             |
| `$deploymentTargetPatch`           | **\Upsun\Model\DeploymentTargetPatch** | (required)  |

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
