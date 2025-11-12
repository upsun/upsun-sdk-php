# ProjectVariablesApi

Low level ProjectVariablesApi (auto-generated)

***

* Full name: `\Upsun\Api\ProjectVariablesApi`
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

### createProjectsVariables

Add a project variable

```php
public createProjectsVariables(string $projectId, \Upsun\Model\ProjectVariableCreateInput $projectVariableCreateInput): \Upsun\Model\AcceptedResponse
```

Add a variable to a project. The `value` can be either a string or a JSON object (default: string), as specified
by the `is_json` boolean flag. See the [Variables](https://docs.upsun.com/anchors/variables/set/project/create/)
section in our documentation for more information.

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$projectVariableCreateInput` | **\Upsun\Model\ProjectVariableCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Variables/operation/create-projects-variables

***

### createProjectsVariablesWithHttpInfo

Add a project variable with HTTP Info

```php
private createProjectsVariablesWithHttpInfo(string $projectId, \Upsun\Model\ProjectVariableCreateInput $projectVariableCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$projectVariableCreateInput` | **\Upsun\Model\ProjectVariableCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsVariablesRequest

Create request for operation 'createProjectsVariables'

```php
private createProjectsVariablesRequest(string $projectId, \Upsun\Model\ProjectVariableCreateInput $projectVariableCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$projectVariableCreateInput` | **\Upsun\Model\ProjectVariableCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsVariables

Delete a project variable

```php
public deleteProjectsVariables(string $projectId, string $projectVariableId): \Upsun\Model\AcceptedResponse
```

Delete a single user-defined project variable.

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Variables/operation/delete-projects-variables

***

### deleteProjectsVariablesWithHttpInfo

Delete a project variable with HTTP Info

```php
private deleteProjectsVariablesWithHttpInfo(string $projectId, string $projectVariableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsVariablesRequest

Create request for operation 'deleteProjectsVariables'

```php
private deleteProjectsVariablesRequest(string $projectId, string $projectVariableId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsVariables

Get a project variable

```php
public getProjectsVariables(string $projectId, string $projectVariableId): \Upsun\Model\ProjectVariable
```

Retrieve a single user-defined project variable.

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Variables/operation/get-projects-variables

***

### getProjectsVariablesWithHttpInfo

Get a project variable with HTTP Info

```php
private getProjectsVariablesWithHttpInfo(string $projectId, string $projectVariableId): \Upsun\Model\ProjectVariable
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsVariablesRequest

Create request for operation 'getProjectsVariables'

```php
private getProjectsVariablesRequest(string $projectId, string $projectVariableId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsVariables

Get list of project variables

```php
public listProjectsVariables(string $projectId): \Upsun\Model\ProjectVariable[]
```

Retrieve a list of objects representing the user-defined variables within a project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Variables/operation/list-projects-variables

***

### listProjectsVariablesWithHttpInfo

Get list of project variables with HTTP Info

```php
private listProjectsVariablesWithHttpInfo(string $projectId): \Upsun\Model\ProjectVariable[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsVariablesRequest

Create request for operation 'listProjectsVariables'

```php
private listProjectsVariablesRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsVariables

Update a project variable

```php
public updateProjectsVariables(string $projectId, string $projectVariableId, \Upsun\Model\ProjectVariablePatch $projectVariablePatch): \Upsun\Model\AcceptedResponse
```

Update a single user-defined project variable. The `value` can be either a string or a JSON object (default:
string), as specified by the `is_json` boolean flag. See the
[Variables](https://docs.upsun.com/anchors/variables/set/project/create/) section in our documentation for more
information.

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$projectId`            | **string**                            |             |
| `$projectVariableId`    | **string**                            |             |
| `$projectVariablePatch` | **\Upsun\Model\ProjectVariablePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Variables/operation/update-projects-variables

***

### updateProjectsVariablesWithHttpInfo

Update a project variable with HTTP Info

```php
private updateProjectsVariablesWithHttpInfo(string $projectId, string $projectVariableId, \Upsun\Model\ProjectVariablePatch $projectVariablePatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$projectId`            | **string**                            |             |
| `$projectVariableId`    | **string**                            |             |
| `$projectVariablePatch` | **\Upsun\Model\ProjectVariablePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsVariablesRequest

Create request for operation 'updateProjectsVariables'

```php
private updateProjectsVariablesRequest(string $projectId, string $projectVariableId, \Upsun\Model\ProjectVariablePatch $projectVariablePatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$projectId`            | **string**                            |             |
| `$projectVariableId`    | **string**                            |             |
| `$projectVariablePatch` | **\Upsun\Model\ProjectVariablePatch** | (required)  |

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
