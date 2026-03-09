# EnvironmentVariablesApi

Low level EnvironmentVariablesApi (auto-generated)

***

* Full name: `\Upsun\Api\EnvironmentVariablesApi`
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

### createProjectsEnvironmentsVariables

Add an environment variable

```php
public createProjectsEnvironmentsVariables(string $projectId, string $environmentId, \Upsun\Model\EnvironmentVariableCreateInput $environmentVariableCreateInput): \Upsun\Model\AcceptedResponse
```

Add a variable to an environment. The `value` can be either a string or a JSON object (default: string), as
specified by the `is_json` boolean flag. Additionally, the inheritability of an environment variable can be
determined through the `is_inheritable` flag (default: true). See the [Environment
Variables](https://docs.upsun.com/anchors/variables/set/environment/create/) section in our documentation for
more information.

**Parameters:**

| Parameter                         | Type                                            | Description |
|-----------------------------------|-------------------------------------------------|-------------|
| `$projectId`                      | **string**                                      |             |
| `$environmentId`                  | **string**                                      |             |
| `$environmentVariableCreateInput` | **\Upsun\Model\EnvironmentVariableCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Variables/operation/create-projects-environments-variables

***

### createProjectsEnvironmentsVariablesWithHttpInfo

Add an environment variable with HTTP Info

```php
private createProjectsEnvironmentsVariablesWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentVariableCreateInput $environmentVariableCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                         | Type                                            | Description |
|-----------------------------------|-------------------------------------------------|-------------|
| `$projectId`                      | **string**                                      |             |
| `$environmentId`                  | **string**                                      |             |
| `$environmentVariableCreateInput` | **\Upsun\Model\EnvironmentVariableCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsEnvironmentsVariablesRequest

Create request for operation 'createProjectsEnvironmentsVariables'

```php
private createProjectsEnvironmentsVariablesRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentVariableCreateInput $environmentVariableCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                         | Type                                            | Description |
|-----------------------------------|-------------------------------------------------|-------------|
| `$projectId`                      | **string**                                      |             |
| `$environmentId`                  | **string**                                      |             |
| `$environmentVariableCreateInput` | **\Upsun\Model\EnvironmentVariableCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsEnvironmentsVariables

Delete an environment variable

```php
public deleteProjectsEnvironmentsVariables(string $projectId, string $environmentId, string $variableId): \Upsun\Model\AcceptedResponse
```

Delete a single user-defined environment variable.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Variables/operation/delete-projects-environments-variables

***

### deleteProjectsEnvironmentsVariablesWithHttpInfo

Delete an environment variable with HTTP Info

```php
private deleteProjectsEnvironmentsVariablesWithHttpInfo(string $projectId, string $environmentId, string $variableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsEnvironmentsVariablesRequest

Create request for operation 'deleteProjectsEnvironmentsVariables'

```php
private deleteProjectsEnvironmentsVariablesRequest(string $projectId, string $environmentId, string $variableId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsEnvironmentsVariables

Get an environment variable

```php
public getProjectsEnvironmentsVariables(string $projectId, string $environmentId, string $variableId): \Upsun\Model\EnvironmentVariable
```

Retrieve a single user-defined environment variable.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Variables/operation/get-projects-environments-variables

***

### getProjectsEnvironmentsVariablesWithHttpInfo

Get an environment variable with HTTP Info

```php
private getProjectsEnvironmentsVariablesWithHttpInfo(string $projectId, string $environmentId, string $variableId): \Upsun\Model\EnvironmentVariable
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsEnvironmentsVariablesRequest

Create request for operation 'getProjectsEnvironmentsVariables'

```php
private getProjectsEnvironmentsVariablesRequest(string $projectId, string $environmentId, string $variableId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironmentsVariables

Get list of environment variables

```php
public listProjectsEnvironmentsVariables(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
```

Retrieve a list of objects representing the user-defined variables within an environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Variables/operation/list-projects-environments-variables

***

### listProjectsEnvironmentsVariablesWithHttpInfo

Get list of environment variables with HTTP Info

```php
private listProjectsEnvironmentsVariablesWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
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

### listProjectsEnvironmentsVariablesRequest

Create request for operation 'listProjectsEnvironmentsVariables'

```php
private listProjectsEnvironmentsVariablesRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsEnvironmentsVariables

Update an environment variable

```php
public updateProjectsEnvironmentsVariables(string $projectId, string $environmentId, string $variableId, \Upsun\Model\EnvironmentVariablePatch $environmentVariablePatch): \Upsun\Model\AcceptedResponse
```

Update a single user-defined environment variable. The `value` can be either a string or a JSON object (default:
string), as specified by the `is_json` boolean flag. Additionally, the inheritability of an environment variable
can be determined through the `is_inheritable` flag (default: true). See the
[Variables](https://docs.upsun.com/anchors/variables/) section in our documentation for more information.

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$variableId`               | **string**                                |             |
| `$environmentVariablePatch` | **\Upsun\Model\EnvironmentVariablePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Variables/operation/update-projects-environments-variables

***

### updateProjectsEnvironmentsVariablesWithHttpInfo

Update an environment variable with HTTP Info

```php
private updateProjectsEnvironmentsVariablesWithHttpInfo(string $projectId, string $environmentId, string $variableId, \Upsun\Model\EnvironmentVariablePatch $environmentVariablePatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$variableId`               | **string**                                |             |
| `$environmentVariablePatch` | **\Upsun\Model\EnvironmentVariablePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsEnvironmentsVariablesRequest

Create request for operation 'updateProjectsEnvironmentsVariables'

```php
private updateProjectsEnvironmentsVariablesRequest(string $projectId, string $environmentId, string $variableId, \Upsun\Model\EnvironmentVariablePatch $environmentVariablePatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$variableId`               | **string**                                |             |
| `$environmentVariablePatch` | **\Upsun\Model\EnvironmentVariablePatch** | (required)  |

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
