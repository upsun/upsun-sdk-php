# OrganizationProjectsApi

Low level OrganizationProjectsApi (auto-generated)

***

* Full name: `\Upsun\Api\OrganizationProjectsApi`
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

### createOrgProject

Create project

```php
public createOrgProject(string $organizationId, \Upsun\Model\CreateOrgProjectRequest $createOrgProjectRequest): \Upsun\Model\OrganizationProject
```

Creates a new project in the specified organization.

**Parameters:**

| Parameter                  | Type                                     | Description                            |
|----------------------------|------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                               | The ID of the organization. (required) |
| `$createOrgProjectRequest` | **\Upsun\Model\CreateOrgProjectRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/create-org-project

***

### createOrgProjectWithHttpInfo

Create project with HTTP Info

```php
private createOrgProjectWithHttpInfo(string $organizationId, \Upsun\Model\CreateOrgProjectRequest $createOrgProjectRequest): \Upsun\Model\OrganizationProject
```

**Parameters:**

| Parameter                  | Type                                     | Description                            |
|----------------------------|------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                               | The ID of the organization. (required) |
| `$createOrgProjectRequest` | **\Upsun\Model\CreateOrgProjectRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createOrgProjectRequest

Create request for operation 'createOrgProject'

```php
private createOrgProjectRequest(string $organizationId, \Upsun\Model\CreateOrgProjectRequest $createOrgProjectRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                  | Type                                     | Description                            |
|----------------------------|------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                               | The ID of the organization. (required) |
| `$createOrgProjectRequest` | **\Upsun\Model\CreateOrgProjectRequest** |                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteOrgProject

Delete project

```php
public deleteOrgProject(string $organizationId, string $projectId): void
```

Deletes the specified project.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/delete-org-project

***

### deleteOrgProjectWithHttpInfo

Delete project with HTTP Info

```php
private deleteOrgProjectWithHttpInfo(string $organizationId, string $projectId): void
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteOrgProjectRequest

Create request for operation 'deleteOrgProject'

```php
private deleteOrgProjectRequest(string $organizationId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgProject

Get project

```php
public getOrgProject(string $organizationId, string $projectId): \Upsun\Model\OrganizationProject
```

Retrieves the specified project.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/get-org-project

***

### getOrgProjectWithHttpInfo

Get project with HTTP Info

```php
private getOrgProjectWithHttpInfo(string $organizationId, string $projectId): \Upsun\Model\OrganizationProject
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgProjectRequest

Create request for operation 'getOrgProject'

```php
private getOrgProjectRequest(string $organizationId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$projectId`      | **string** | The ID of the project. (required)      |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgProjects

List projects

```php
public listOrgProjects(string $organizationId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterTitle = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, \Upsun\Model\DateTimeFilter|null $filterCreatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgProjects200Response
```

Retrieves a list of projects for the specified organization.

**Parameters:**

| Parameter          | Type                                  | Description                            |
|--------------------|---------------------------------------|----------------------------------------|
| `$organizationId`  | **string**                            | The ID of the organization. (required) |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterTitle`     | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$filterCreatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$pageSize`        | **int\|null**                         | (optional)                             |
| `$pageBefore`      | **string\|null**                      | (optional)                             |
| `$pageAfter`       | **string\|null**                      | (optional)                             |
| `$sort`            | **string\|null**                      | (optional)                             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/list-org-projects

***

### listOrgProjectsWithHttpInfo

List projects with HTTP Info

```php
private listOrgProjectsWithHttpInfo(string $organizationId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterTitle = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, \Upsun\Model\DateTimeFilter|null $filterCreatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgProjects200Response
```

**Parameters:**

| Parameter          | Type                                  | Description                            |
|--------------------|---------------------------------------|----------------------------------------|
| `$organizationId`  | **string**                            | The ID of the organization. (required) |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterTitle`     | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$filterCreatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$pageSize`        | **int\|null**                         | (optional)                             |
| `$pageBefore`      | **string\|null**                      | (optional)                             |
| `$pageAfter`       | **string\|null**                      | (optional)                             |
| `$sort`            | **string\|null**                      | (optional)                             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgProjectsRequest

Create request for operation 'listOrgProjects'

```php
private listOrgProjectsRequest(string $organizationId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterTitle = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, \Upsun\Model\DateTimeFilter|null $filterCreatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter          | Type                                  | Description                            |
|--------------------|---------------------------------------|----------------------------------------|
| `$organizationId`  | **string**                            | The ID of the organization. (required) |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterTitle`     | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | (optional)                             |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$filterCreatedAt` | **\Upsun\Model\DateTimeFilter\|null** | (optional)                             |
| `$pageSize`        | **int\|null**                         | (optional)                             |
| `$pageBefore`      | **string\|null**                      | (optional)                             |
| `$pageAfter`       | **string\|null**                      | (optional)                             |
| `$sort`            | **string\|null**                      | (optional)                             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### queryProjectCarbon

Query project carbon emissions metrics

```php
public queryProjectCarbon(string $organizationId, string $projectId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Upsun\Model\ProjectCarbon
```

Queries the carbon emission data for the specified project using the supplied parameters.

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$projectId`      | **string**                            | The ID of the project. (required)                                                                          |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the
query. Exclusive. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/query-project-carbon

***

### queryProjectCarbonWithHttpInfo

Query project carbon emissions metrics with HTTP Info

```php
private queryProjectCarbonWithHttpInfo(string $organizationId, string $projectId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Upsun\Model\ProjectCarbon
```

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$projectId`      | **string**                            | The ID of the project. (required)                                                                          |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the
query. Exclusive. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### queryProjectCarbonRequest

Create request for operation 'queryProjectCarbon'

```php
private queryProjectCarbonRequest(string $organizationId, string $projectId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$projectId`      | **string**                            | The ID of the project. (required)                                                                          |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the
query. Exclusive. (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrgProject

Update project

```php
public updateOrgProject(string $organizationId, string $projectId, ?\Upsun\Model\UpdateOrgProjectRequest $updateOrgProjectRequest = null): \Upsun\Model\OrganizationProject
```

Updates the specified project.

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$projectId`               | **string**                                | The ID of the project. (required)      |
| `$updateOrgProjectRequest` | **?\Upsun\Model\UpdateOrgProjectRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Projects/operation/update-org-project

***

### updateOrgProjectWithHttpInfo

Update project with HTTP Info

```php
private updateOrgProjectWithHttpInfo(string $organizationId, string $projectId, ?\Upsun\Model\UpdateOrgProjectRequest $updateOrgProjectRequest = null): \Upsun\Model\OrganizationProject
```

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$projectId`               | **string**                                | The ID of the project. (required)      |
| `$updateOrgProjectRequest` | **?\Upsun\Model\UpdateOrgProjectRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgProjectRequest

Create request for operation 'updateOrgProject'

```php
private updateOrgProjectRequest(string $organizationId, string $projectId, ?\Upsun\Model\UpdateOrgProjectRequest $updateOrgProjectRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                  | Type                                      | Description                            |
|----------------------------|-------------------------------------------|----------------------------------------|
| `$organizationId`          | **string**                                | The ID of the organization. (required) |
| `$projectId`               | **string**                                | The ID of the project. (required)      |
| `$updateOrgProjectRequest` | **?\Upsun\Model\UpdateOrgProjectRequest** |                                        |

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
