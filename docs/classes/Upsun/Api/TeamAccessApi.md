# TeamAccessApi

Low level TeamAccessApi (auto-generated)

***

* Full name: `\Upsun\Api\TeamAccessApi`
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

### getProjectTeamAccess

Get team access for a project

```php
public getProjectTeamAccess(string $projectId, string $teamId): \Upsun\Model\TeamProjectAccess
```

Retrieves the team's permissions for the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/get-project-team-access

***

### getProjectTeamAccessWithHttpInfo

Get team access for a project with HTTP Info

```php
private getProjectTeamAccessWithHttpInfo(string $projectId, string $teamId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectTeamAccessRequest

Create request for operation 'getProjectTeamAccess'

```php
private getProjectTeamAccessRequest(string $projectId, string $teamId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getTeamProjectAccess

Get project access for a team

```php
public getTeamProjectAccess(string $teamId, string $projectId): \Upsun\Model\TeamProjectAccess
```

Retrieves the team's permissions for the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/get-team-project-access

***

### getTeamProjectAccessWithHttpInfo

Get project access for a team with HTTP Info

```php
private getTeamProjectAccessWithHttpInfo(string $teamId, string $projectId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTeamProjectAccessRequest

Create request for operation 'getTeamProjectAccess'

```php
private getTeamProjectAccessRequest(string $teamId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### grantProjectTeamAccess

Grant team access to a project

```php
public grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
```

Grants one or more team access to a specific project.

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectTeamAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/grant-project-team-access

***

### grantProjectTeamAccessWithHttpInfo

Grant team access to a project with HTTP Info

```php
private grantProjectTeamAccessWithHttpInfo(string $projectId, array $grantProjectTeamAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectTeamAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantProjectTeamAccessRequest

Create request for operation 'grantProjectTeamAccess'

```php
private grantProjectTeamAccessRequest(string $projectId, array $grantProjectTeamAccessRequestInner): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectTeamAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### grantTeamProjectAccess

Grant project access to a team

```php
public grantTeamProjectAccess(string $teamId, array $grantTeamProjectAccessRequestInner): void
```

Adds the team to one or more specified projects.

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$teamId`                             | **string** | The ID of the team. (required) |
| `$grantTeamProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/grant-team-project-access

***

### grantTeamProjectAccessWithHttpInfo

Grant project access to a team with HTTP Info

```php
private grantTeamProjectAccessWithHttpInfo(string $teamId, array $grantTeamProjectAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$teamId`                             | **string** | The ID of the team. (required) |
| `$grantTeamProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantTeamProjectAccessRequest

Create request for operation 'grantTeamProjectAccess'

```php
private grantTeamProjectAccessRequest(string $teamId, array $grantTeamProjectAccessRequestInner): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$teamId`                             | **string** | The ID of the team. (required) |
| `$grantTeamProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectTeamAccess

List team access for a project

```php
public listProjectTeamAccess(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

Returns a list of items representing the project access.

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/list-project-team-access

***

### listProjectTeamAccessWithHttpInfo

List team access for a project with HTTP Info

```php
private listProjectTeamAccessWithHttpInfo(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectTeamAccessRequest

Create request for operation 'listProjectTeamAccess'

```php
private listProjectTeamAccessRequest(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listTeamProjectAccess

List project access for a team

```php
public listTeamProjectAccess(string $teamId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

Returns a list of items representing the team's project access.

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required)                                                                                                                          |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/list-team-project-access

***

### listTeamProjectAccessWithHttpInfo

List project access for a team with HTTP Info

```php
private listTeamProjectAccessWithHttpInfo(string $teamId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required)                                                                                                                          |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTeamProjectAccessRequest

Create request for operation 'listTeamProjectAccess'

```php
private listTeamProjectAccessRequest(string $teamId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required)                                                                                                                          |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in
HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | (optional)                                                                                                                                              |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### removeProjectTeamAccess

Remove team access for a project

```php
public removeProjectTeamAccess(string $projectId, string $teamId): void
```

Removes the team from the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/remove-project-team-access

***

### removeProjectTeamAccessWithHttpInfo

Remove team access for a project with HTTP Info

```php
private removeProjectTeamAccessWithHttpInfo(string $projectId, string $teamId): void
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeProjectTeamAccessRequest

Create request for operation 'removeProjectTeamAccess'

```php
private removeProjectTeamAccessRequest(string $projectId, string $teamId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$teamId`    | **string** | The ID of the team. (required)    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### removeTeamProjectAccess

Remove project access for a team

```php
public removeTeamProjectAccess(string $teamId, string $projectId): void
```

Removes the team from the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Team-Access/operation/remove-team-project-access

***

### removeTeamProjectAccessWithHttpInfo

Remove project access for a team with HTTP Info

```php
private removeTeamProjectAccessWithHttpInfo(string $teamId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeTeamProjectAccessRequest

Create request for operation 'removeTeamProjectAccess'

```php
private removeTeamProjectAccessRequest(string $teamId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$teamId`    | **string** | The ID of the team. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

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
