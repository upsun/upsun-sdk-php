# UserAccessApi

Low level UserAccessApi (auto-generated)

***

* Full name: `\Upsun\Api\UserAccessApi`
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

### getProjectUserAccess

Get user access for a project

```php
public getProjectUserAccess(string $projectId, string $userId): \Upsun\Model\UserProjectAccess
```

Retrieves the user's permissions for the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/get-project-user-access

***

### getProjectUserAccessWithHttpInfo

Get user access for a project with HTTP Info

```php
private getProjectUserAccessWithHttpInfo(string $projectId, string $userId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectUserAccessRequest

Create request for operation 'getProjectUserAccess'

```php
private getProjectUserAccessRequest(string $projectId, string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getUserProjectAccess

Get project access for a user

```php
public getUserProjectAccess(string $userId, string $projectId): \Upsun\Model\UserProjectAccess
```

Retrieves the user's permissions for the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/get-user-project-access

***

### getUserProjectAccessWithHttpInfo

Get project access for a user with HTTP Info

```php
private getUserProjectAccessWithHttpInfo(string $userId, string $projectId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getUserProjectAccessRequest

Create request for operation 'getUserProjectAccess'

```php
private getUserProjectAccessRequest(string $userId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### grantProjectUserAccess

Grant user access to a project

```php
public grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
```

Grants one or more users access to a specific project.

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectUserAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/grant-project-user-access

***

### grantProjectUserAccessWithHttpInfo

Grant user access to a project with HTTP Info

```php
private grantProjectUserAccessWithHttpInfo(string $projectId, array $grantProjectUserAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectUserAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantProjectUserAccessRequest

Create request for operation 'grantProjectUserAccess'

```php
private grantProjectUserAccessRequest(string $projectId, array $grantProjectUserAccessRequestInner): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                             | Type       | Description                       |
|---------------------------------------|------------|-----------------------------------|
| `$projectId`                          | **string** | The ID of the project. (required) |
| `$grantProjectUserAccessRequestInner` | **array**  |                                   |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### grantUserProjectAccess

Grant project access to a user

```php
public grantUserProjectAccess(string $userId, array $grantUserProjectAccessRequestInner): void
```

Adds the user to one or more specified projects.

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$userId`                             | **string** | The ID of the user. (required) |
| `$grantUserProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/grant-user-project-access

***

### grantUserProjectAccessWithHttpInfo

Grant project access to a user with HTTP Info

```php
private grantUserProjectAccessWithHttpInfo(string $userId, array $grantUserProjectAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$userId`                             | **string** | The ID of the user. (required) |
| `$grantUserProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantUserProjectAccessRequest

Create request for operation 'grantUserProjectAccess'

```php
private grantUserProjectAccessRequest(string $userId, array $grantUserProjectAccessRequestInner): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                             | Type       | Description                    |
|---------------------------------------|------------|--------------------------------|
| `$userId`                             | **string** | The ID of the user. (required) |
| `$grantUserProjectAccessRequestInner` | **array**  |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectUserAccess

List user access for a project

```php
public listProjectUserAccess(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

Returns a list of items representing the project access.

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`. (optional)               |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/list-project-user-access

***

### listProjectUserAccessWithHttpInfo

List user access for a project with HTTP Info

```php
private listProjectUserAccessWithHttpInfo(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`. (optional)               |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectUserAccessRequest

Create request for operation 'listProjectUserAccess'

```php
private listProjectUserAccessRequest(string $projectId, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type             | Description                                                                                                                                             |
|---------------|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`  | **string**       | The ID of the project. (required)                                                                                                                       |
| `$pageSize`   | **int\|null**    | Determines the number of items to show. (optional)                                                                                                      |
| `$pageBefore` | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$pageAfter`  | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional) |
| `$sort`       | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`. (optional)               |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listUserProjectAccess

List project access for a user

```php
public listUserProjectAccess(string $userId, string|null $filterOrganizationId = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

Returns a list of items representing the user's project access.

**Parameters:**

| Parameter               | Type             | Description                                                                                                                                                |
|-------------------------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`               | **string**       | The ID of the user. (required)                                                                                                                             |
| `$filterOrganizationId` | **string\|null** | Allows filtering by `organization_id`. (optional)                                                                                                          |
| `$pageSize`             | **int\|null**    | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`           | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`            | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`                 | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/list-user-project-access

***

### listUserProjectAccessWithHttpInfo

List project access for a user with HTTP Info

```php
private listUserProjectAccessWithHttpInfo(string $userId, string|null $filterOrganizationId = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

**Parameters:**

| Parameter               | Type             | Description                                                                                                                                                |
|-------------------------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`               | **string**       | The ID of the user. (required)                                                                                                                             |
| `$filterOrganizationId` | **string\|null** | Allows filtering by `organization_id`. (optional)                                                                                                          |
| `$pageSize`             | **int\|null**    | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`           | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`            | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`                 | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserProjectAccessRequest

Create request for operation 'listUserProjectAccess'

```php
private listUserProjectAccessRequest(string $userId, string|null $filterOrganizationId = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type             | Description                                                                                                                                                |
|-------------------------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`               | **string**       | The ID of the user. (required)                                                                                                                             |
| `$filterOrganizationId` | **string\|null** | Allows filtering by `organization_id`. (optional)                                                                                                          |
| `$pageSize`             | **int\|null**    | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`           | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`            | **string\|null** | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`                 | **string\|null** | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`. (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### removeProjectUserAccess

Remove user access for a project

```php
public removeProjectUserAccess(string $projectId, string $userId): void
```

Removes the user from the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/remove-project-user-access

***

### removeProjectUserAccessWithHttpInfo

Remove user access for a project with HTTP Info

```php
private removeProjectUserAccessWithHttpInfo(string $projectId, string $userId): void
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeProjectUserAccessRequest

Create request for operation 'removeProjectUserAccess'

```php
private removeProjectUserAccessRequest(string $projectId, string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$projectId` | **string** | The ID of the project. (required) |
| `$userId`    | **string** | The ID of the user. (required)    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### removeUserProjectAccess

Remove project access for a user

```php
public removeUserProjectAccess(string $userId, string $projectId): void
```

Removes the user from the current project.

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/remove-user-project-access

***

### removeUserProjectAccessWithHttpInfo

Remove project access for a user with HTTP Info

```php
private removeUserProjectAccessWithHttpInfo(string $userId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeUserProjectAccessRequest

Create request for operation 'removeUserProjectAccess'

```php
private removeUserProjectAccessRequest(string $userId, string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$userId`    | **string** | The ID of the user. (required)    |
| `$projectId` | **string** | The ID of the project. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectUserAccess

Update user access for a project

```php
public updateProjectUserAccess(string $projectId, string $userId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): void
```

Updates the user's permissions for the current project.

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/update-project-user-access

***

### updateProjectUserAccessWithHttpInfo

Update user access for a project with HTTP Info

```php
private updateProjectUserAccessWithHttpInfo(string $projectId, string $userId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): void
```

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectUserAccessRequest

Create request for operation 'updateProjectUserAccess'

```php
private updateProjectUserAccessRequest(string $projectId, string $userId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateUserProjectAccess

Update project access for a user

```php
public updateUserProjectAccess(string $userId, string $projectId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): void
```

Updates the user's permissions for the current project.

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/User-Access/operation/update-user-project-access

***

### updateUserProjectAccessWithHttpInfo

Update project access for a user with HTTP Info

```php
private updateUserProjectAccessWithHttpInfo(string $userId, string $projectId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): void
```

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateUserProjectAccessRequest

Create request for operation 'updateUserProjectAccess'

```php
private updateUserProjectAccessRequest(string $userId, string $projectId, ?\Upsun\Model\UpdateProjectUserAccessRequest $updateProjectUserAccessRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                         | Type                                             | Description                       |
|-----------------------------------|--------------------------------------------------|-----------------------------------|
| `$userId`                         | **string**                                       | The ID of the user. (required)    |
| `$projectId`                      | **string**                                       | The ID of the project. (required) |
| `$updateProjectUserAccessRequest` | **?\Upsun\Model\UpdateProjectUserAccessRequest** |                                   |

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
