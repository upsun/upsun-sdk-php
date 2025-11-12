# OrganizationsApi

Low level OrganizationsApi (auto-generated)

***

* Full name: `\Upsun\Api\OrganizationsApi`
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

### createOrg

Create organization

```php
public createOrg(\Upsun\Model\CreateOrgRequest $createOrgRequest): \Upsun\Model\Organization
```

Creates a new organization.

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$createOrgRequest` | **\Upsun\Model\CreateOrgRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/create-org

***

### createOrgWithHttpInfo

Create organization with HTTP Info

```php
private createOrgWithHttpInfo(\Upsun\Model\CreateOrgRequest $createOrgRequest): \Upsun\Model\Organization
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$createOrgRequest` | **\Upsun\Model\CreateOrgRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createOrgRequest

Create request for operation 'createOrg'

```php
private createOrgRequest(\Upsun\Model\CreateOrgRequest $createOrgRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$createOrgRequest` | **\Upsun\Model\CreateOrgRequest** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteOrg

Delete organization

```php
public deleteOrg(string $organizationId): void
```

Deletes the specified organization.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/delete-org

***

### deleteOrgWithHttpInfo

Delete organization with HTTP Info

```php
private deleteOrgWithHttpInfo(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteOrgRequest

Create request for operation 'deleteOrg'

```php
private deleteOrgRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrg

Get organization

```php
public getOrg(string $organizationId): \Upsun\Model\Organization
```

Retrieves the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/get-org

***

### getOrgWithHttpInfo

Get organization with HTTP Info

```php
private getOrgWithHttpInfo(string $organizationId): \Upsun\Model\Organization
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgRequest

Create request for operation 'getOrg'

```php
private getOrgRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgs

List organizations

```php
public listOrgs(\Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterOwnerId = null, \Upsun\Model\StringFilter|null $filterName = null, \Upsun\Model\StringFilter|null $filterLabel = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\ArrayFilter|null $filterCapabilities = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgs200Response
```

Non-admin users will only see organizations they are members of.

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterId`           | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterOwnerId`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `owner_id` using one or more operators. (optional)                                                                                     |
| `$filterName`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `name` using one or more operators. (optional)                                                                                         |
| `$filterLabel`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `label` using one or more operators. (optional)                                                                                        |
| `$filterVendor`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterCapabilities` | **\Upsun\Model\ArrayFilter\|null**    | Allows filtering by `capabilites` using one or more operators. (optional)                                                                                  |
| `$filterStatus`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/list-orgs

***

### listOrgsWithHttpInfo

List organizations with HTTP Info

```php
private listOrgsWithHttpInfo(\Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterOwnerId = null, \Upsun\Model\StringFilter|null $filterName = null, \Upsun\Model\StringFilter|null $filterLabel = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\ArrayFilter|null $filterCapabilities = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgs200Response
```

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterId`           | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterOwnerId`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `owner_id` using one or more operators. (optional)                                                                                     |
| `$filterName`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `name` using one or more operators. (optional)                                                                                         |
| `$filterLabel`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `label` using one or more operators. (optional)                                                                                        |
| `$filterVendor`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterCapabilities` | **\Upsun\Model\ArrayFilter\|null**    | Allows filtering by `capabilites` using one or more operators. (optional)                                                                                  |
| `$filterStatus`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgsRequest

Create request for operation 'listOrgs'

```php
private listOrgsRequest(\Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterOwnerId = null, \Upsun\Model\StringFilter|null $filterName = null, \Upsun\Model\StringFilter|null $filterLabel = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\ArrayFilter|null $filterCapabilities = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$filterId`           | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterOwnerId`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `owner_id` using one or more operators. (optional)                                                                                     |
| `$filterName`         | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `name` using one or more operators. (optional)                                                                                         |
| `$filterLabel`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `label` using one or more operators. (optional)                                                                                        |
| `$filterVendor`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterCapabilities` | **\Upsun\Model\ArrayFilter\|null**    | Allows filtering by `capabilites` using one or more operators. (optional)                                                                                  |
| `$filterStatus`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listUserOrgs

User organizations

```php
public listUserOrgs(string $userId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListUserOrgs200Response
```

Retrieves organizations that the specified user is a member of.

**Parameters:**

| Parameter          | Type                                  | Description                                                                                                                                                |
|--------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`          | **string**                            | The ID of the user. (required)                                                                                                                             |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterVendor`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`        | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`      | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`       | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`            | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/list-user-orgs

***

### listUserOrgsWithHttpInfo

User organizations with HTTP Info

```php
private listUserOrgsWithHttpInfo(string $userId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListUserOrgs200Response
```

**Parameters:**

| Parameter          | Type                                  | Description                                                                                                                                                |
|--------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`          | **string**                            | The ID of the user. (required)                                                                                                                             |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterVendor`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`        | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`      | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`       | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`            | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserOrgsRequest

Create request for operation 'listUserOrgs'

```php
private listUserOrgsRequest(string $userId, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\StringFilter|null $filterType = null, \Upsun\Model\StringFilter|null $filterVendor = null, \Upsun\Model\StringFilter|null $filterStatus = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter          | Type                                  | Description                                                                                                                                                |
|--------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$userId`          | **string**                            | The ID of the user. (required)                                                                                                                             |
| `$filterId`        | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `id` using one or more operators. (optional)                                                                                           |
| `$filterType`      | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `type` using one or more operators. (optional)                                                                                         |
| `$filterVendor`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `vendor` using one or more operators. (optional)                                                                                       |
| `$filterStatus`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`. (optional)                     |
| `$filterUpdatedAt` | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                   |
| `$pageSize`        | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                         |
| `$pageBefore`      | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$pageAfter`       | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)    |
| `$sort`            | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrg

Update organization

```php
public updateOrg(string $organizationId, ?\Upsun\Model\UpdateOrgRequest $updateOrgRequest = null): \Upsun\Model\Organization
```

Updates the specified organization.

**Parameters:**

| Parameter           | Type                               | Description                            |
|---------------------|------------------------------------|----------------------------------------|
| `$organizationId`   | **string**                         | The ID of the organization. (required) |
| `$updateOrgRequest` | **?\Upsun\Model\UpdateOrgRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organizations/operation/update-org

***

### updateOrgWithHttpInfo

Update organization with HTTP Info

```php
private updateOrgWithHttpInfo(string $organizationId, ?\Upsun\Model\UpdateOrgRequest $updateOrgRequest = null): \Upsun\Model\Organization
```

**Parameters:**

| Parameter           | Type                               | Description                            |
|---------------------|------------------------------------|----------------------------------------|
| `$organizationId`   | **string**                         | The ID of the organization. (required) |
| `$updateOrgRequest` | **?\Upsun\Model\UpdateOrgRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgRequest

Create request for operation 'updateOrg'

```php
private updateOrgRequest(string $organizationId, ?\Upsun\Model\UpdateOrgRequest $updateOrgRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type                               | Description                            |
|---------------------|------------------------------------|----------------------------------------|
| `$organizationId`   | **string**                         | The ID of the organization. (required) |
| `$updateOrgRequest` | **?\Upsun\Model\UpdateOrgRequest** |                                        |

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
