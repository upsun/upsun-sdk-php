# OrganizationsTask

OrganizationsTask class.

***

* Full name: `\Upsun\Core\Tasks\OrganizationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant             | Visibility | Type | Value            |
|----------------------|------------|------|------------------|
| `DEFAULT_UPSUN_PLAN` | private    |      | 'upsun/flexible' |

## Properties

### api

```php
private \Upsun\Api\OrganizationsApi $api
```

***

### projectsApi

```php
private \Upsun\Api\OrganizationProjectsApi $projectsApi
```

***

### membersApi

```php
private \Upsun\Api\OrganizationMembersApi $membersApi
```

***

### subscriptionsApi

```php
private \Upsun\Api\SubscriptionsApi $subscriptionsApi
```

***

### invoicesApi

```php
private \Upsun\Api\InvoicesApi $invoicesApi
```

***

### mfaApi

```php
private \Upsun\Api\MfaApi $mfaApi
```

***

### ordersApi

```php
private \Upsun\Api\OrdersApi $ordersApi
```

***

### profilesApi

```php
private \Upsun\Api\ProfilesApi $profilesApi
```

***

### recordsApi

```php
private \Upsun\Api\RecordsApi $recordsApi
```

***

### vouchersApi

```php
private \Upsun\Api\VouchersApi $vouchersApi
```

***

### addOnsApi

```php
private \Upsun\Api\AddOnsApi $addOnsApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\OrganizationsApi $api, \Upsun\Api\OrganizationProjectsApi $projectsApi, \Upsun\Api\OrganizationMembersApi $membersApi, \Upsun\Api\SubscriptionsApi $subscriptionsApi, \Upsun\Api\InvoicesApi $invoicesApi, \Upsun\Api\MfaApi $mfaApi, \Upsun\Api\OrdersApi $ordersApi, \Upsun\Api\ProfilesApi $profilesApi, \Upsun\Api\RecordsApi $recordsApi, \Upsun\Api\VouchersApi $vouchersApi, \Upsun\Api\AddOnsApi $addOnsApi): mixed
```

**Parameters:**

| Parameter           | Type                                   | Description |
|---------------------|----------------------------------------|-------------|
| `$client`           | **\Upsun\UpsunClient**                 |             |
| `$api`              | **\Upsun\Api\OrganizationsApi**        |             |
| `$projectsApi`      | **\Upsun\Api\OrganizationProjectsApi** |             |
| `$membersApi`       | **\Upsun\Api\OrganizationMembersApi**  |             |
| `$subscriptionsApi` | **\Upsun\Api\SubscriptionsApi**        |             |
| `$invoicesApi`      | **\Upsun\Api\InvoicesApi**             |             |
| `$mfaApi`           | **\Upsun\Api\MfaApi**                  |             |
| `$ordersApi`        | **\Upsun\Api\OrdersApi**               |             |
| `$profilesApi`      | **\Upsun\Api\ProfilesApi**             |             |
| `$recordsApi`       | **\Upsun\Api\RecordsApi**              |             |
| `$vouchersApi`      | **\Upsun\Api\VouchersApi**             |             |
| `$addOnsApi`        | **\Upsun\Api\AddOnsApi**               |             |

***

### create

Creates organization

```php
public create(string $label, ?string $type = null, ?string $ownerId = null, ?string $name = null, ?string $country = null): \Upsun\Model\Organization
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$label`   | **string**  |             |
| `$type`    | **?string** |             |
| `$ownerId` | **?string** |             |
| `$name`    | **?string** |             |
| `$country` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### delete

Deletes organization

```php
public delete(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets organization

```php
public get(string $organizationId): \Upsun\Model\Organization
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

Lists organizations

```php
public list(?array $filterId = null, ?array $filterOwnerId = null, ?array $filterType = null, ?array $filterName = null, ?array $filterLabel = null, ?array $filterVendor = null, ?array $filterCapabilities = null, ?array $filterStatus = null, ?array $filterUpdatedAt = null, ?int $pageSize = 100, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListOrgs200Response
```

**Parameters:**

| Parameter             | Type        | Description |
|-----------------------|-------------|-------------|
| `$filterId`           | **?array**  |             |
| `$filterOwnerId`      | **?array**  |             |
| `$filterType`         | **?array**  |             |
| `$filterName`         | **?array**  |             |
| `$filterLabel`        | **?array**  |             |
| `$filterVendor`       | **?array**  |             |
| `$filterCapabilities` | **?array**  |             |
| `$filterStatus`       | **?array**  |             |
| `$filterUpdatedAt`    | **?array**  |             |
| `$pageSize`           | **?int**    |             |
| `$pageBefore`         | **?string** |             |
| `$pageAfter`          | **?string** |             |
| `$sort`               | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserOrgs

Lists user organizations

```php
public listUserOrgs(string $userId, ?array $filterId = null, ?array $filterType = null, ?array $filterVendor = null, ?array $filterStatus = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListUserOrgs200Response
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$userId`          | **string**  |             |
| `$filterId`        | **?array**  |             |
| `$filterType`      | **?array**  |             |
| `$filterVendor`    | **?array**  |             |
| `$filterStatus`    | **?array**  |             |
| `$filterUpdatedAt` | **?array**  |             |
| `$pageSize`        | **?int**    |             |
| `$pageBefore`      | **?string** |             |
| `$pageAfter`       | **?string** |             |
| `$sort`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listCurrentUserOrgs

Lists current user organizations

```php
public listCurrentUserOrgs(?array $filterId = null, ?array $filterVendor = null, ?array $filterStatus = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListUserOrgs200Response
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$filterId`        | **?array**  |             |
| `$filterVendor`    | **?array**  |             |
| `$filterStatus`    | **?array**  |             |
| `$filterUpdatedAt` | **?array**  |             |
| `$pageSize`        | **?int**    |             |
| `$pageBefore`      | **?string** |             |
| `$pageAfter`       | **?string** |             |
| `$sort`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates an organization

```php
public update(string $organizationId, ?string $name = null, ?string $label = null, ?string $country = null): \Upsun\Model\Organization
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$name`           | **?string** |             |
| `$label`          | **?string** |             |
| `$country`        | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTeams

Gets Teams of the current organization (for current user)

```php
public listTeams(?string $organizationId, ?string $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$organizationId`  | **?string** |             |
| `$filterUpdatedAt` | **?string** |             |
| `$pageSize`        | **?int**    |             |
| `$pageBefore`      | **?string** |             |
| `$pageAfter`       | **?string** |             |
| `$sort`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProject

Gets a project of a specific organization

```php
public getProject(string $organizationId, string $projectId): \Upsun\Model\OrganizationProject
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$projectId`      | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjects

Lists projects from an organization

```php
public listProjects(string $organizationId, ?array $filterId = null, ?array $filterTitle = null, ?array $filterStatus = null, ?array $filterUpdatedAt = null, ?array $filterCreatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListOrgProjects200Response
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$organizationId`  | **string**  |             |
| `$filterId`        | **?array**  |             |
| `$filterTitle`     | **?array**  |             |
| `$filterStatus`    | **?array**  |             |
| `$filterUpdatedAt` | **?array**  |             |
| `$filterCreatedAt` | **?array**  |             |
| `$pageSize`        | **?int**    |             |
| `$pageBefore`      | **?string** |             |
| `$pageAfter`       | **?string** |             |
| `$sort`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createMember

Creates organization member

```php
public createMember(string $organizationId, string $userId, ("read"|"write"|"admin")[]|null $permissions = []): \Upsun\Model\OrganizationMember
```

**Parameters:**

| Parameter         | Type                                   | Description |
|-------------------|----------------------------------------|-------------|
| `$organizationId` | **string**                             |             |
| `$userId`         | **string**                             |             |
| `$permissions`    | **("read"\|"write"\|"admin")[]\|null** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateMember

Updates organization member

```php
public updateMember(string $organizationId, string $userId, ("read"|"write"|"admin")[]|null $permissions = []): \Upsun\Model\OrganizationMember
```

**Parameters:**

| Parameter         | Type                                   | Description |
|-------------------|----------------------------------------|-------------|
| `$organizationId` | **string**                             |             |
| `$userId`         | **string**                             |             |
| `$permissions`    | **("read"\|"write"\|"admin")[]\|null** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getMember

Gets organization member

```php
public getMember(string $organizationId, string $userId): \Upsun\Model\OrganizationMember
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$userId`         | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listMembers

Lists members of an organization

```php
public listMembers(string $organizationId, ?array $filterPermissions = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListOrgMembers200Response
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$organizationId`    | **string**  |             |
| `$filterPermissions` | **?array**  |             |
| `$pageSize`          | **?int**    |             |
| `$pageBefore`        | **?string** |             |
| `$pageAfter`         | **?string** |             |
| `$sort`              | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteMember

Delete an organization member

```php
public deleteMember(string $organizationId, string $userId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$userId`         | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### canCreateProject

Checks if the user is able to create a new project in the organization.

```php
public canCreateProject(string $organizationId): \Upsun\Model\CanCreateNewOrgSubscription200Response
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProject

Creates a project

```php
public createProject(string $organizationId, string $projectRegion, ?string $plan = null, ?string $title = null, ?string $optionsUrl = null, ?string $defaultBranch = null, ?int $environments = null, ?int $storage = null): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$projectRegion`  | **string**  |             |
| `$plan`           | **?string** |             |
| `$title`          | **?string** |             |
| `$optionsUrl`     | **?string** |             |
| `$defaultBranch`  | **?string** |             |
| `$environments`   | **?int**    |             |
| `$storage`        | **?int**    |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### deleteProject

Deletes a project

```php
public deleteProject(string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### estimateNewProject

Estimates the price of a new project

```php
public estimateNewProject(string $organizationId, ?int $environments = 3, ?int $storage = 500, ?int $userLicenses = 1, ?string $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$environments`   | **?int**    |             |
| `$storage`        | **?int**    |             |
| `$userLicenses`   | **?int**    |             |
| `$format`         | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### estimateProject

Estimates the price of a project

```php
public estimateProject(string $organizationId, string $projectId, ?int $environments = 3, ?int $storage = 500, ?int $userLicenses = 1, ?string $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$projectId`      | **string**  |             |
| `$environments`   | **?int**    |             |
| `$storage`        | **?int**    |             |
| `$userLicenses`   | **?int**    |             |
| `$format`         | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectUsage

Gets current usage for a project

```php
public getProjectUsage(string $organizationId, string $projectId, ?string $usageGroups = null, ?bool $includeNotCharged = null): \Upsun\Model\SubscriptionCurrentUsageObject
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$organizationId`    | **string**  |             |
| `$projectId`         | **string**  |             |
| `$usageGroups`       | **?string** |             |
| `$includeNotCharged` | **?bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProject

Updates a project

```php
public updateProject(string $projectId, ?string $title = null, ?string $defaultBranch = null, ?string $description = null, ?string $defaultDomain = null, ?array $attributes = [], ?string $timezone = null, ?string $region = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$title`         | **?string** |             |
| `$defaultBranch` | **?string** |             |
| `$description`   | **?string** |             |
| `$defaultDomain` | **?string** |             |
| `$attributes`    | **?array**  |             |
| `$timezone`      | **?string** |             |
| `$region`        | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### disableMfaEnforcement

Disables organization MFA enforcement

```php
public disableMfaEnforcement(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### enableMfaEnforcement

Enables organization MFA enforcement

```php
public enableMfaEnforcement(string $organizationId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getMfaEnforcement

Gets organization MFA settings

```php
public getMfaEnforcement(string $organizationId): \Upsun\Model\OrganizationMFAEnforcement
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### sendMfaReminders

Sends MFA reminders to organization members

```php
public sendMfaReminders(string $organizationId, ?array $userIds = null): \Upsun\Model\SendOrgMfaReminders200ResponseValue[]
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$userIds`        | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getInvoice

Gets invoice

```php
public getInvoice(string $invoiceId, string $organizationId): \Upsun\Model\Invoice
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$invoiceId`      | **string** |             |
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listInvoices

Lists invoices

```php
public listInvoices(string $organizationId, ?string $filterStatus = null, ?string $filterType = null, ?string $filterOrderId = null, ?int $page = null): \Upsun\Model\ListOrgInvoices200Response
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$filterStatus`   | **?string** |             |
| `$filterType`     | **?string** |             |
| `$filterOrderId`  | **?string** |             |
| `$page`           | **?int**    |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createAuthorizationCredentials

Creates confirmation credentials for 3D-Secure

```php
public createAuthorizationCredentials(string $organizationId, string $orderId): \Upsun\Model\CreateAuthorizationCredentials200Response
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$orderId`        | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### downloadInvoice

Downloads an invoice.

```php
public downloadInvoice(string $token): string
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$token`  | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrder

Gets order

```php
public getOrder(string $organizationId, string $orderId, ?string $mode = null): \Upsun\Model\Order
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$orderId`        | **string**  |             |
| `$mode`           | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrders

Lists orders

```php
public listOrders(string $organizationId, ?string $filterStatus = null, ?int $filterTotal = null, ?int $page = null, ?string $mode = null): \Upsun\Model\ListOrgOrders200Response
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$filterStatus`   | **?string** |             |
| `$filterTotal`    | **?int**    |             |
| `$page`           | **?int**    |             |
| `$mode`           | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getAddress

Gets address

```php
public getAddress(string $organizationId): \Upsun\Model\Address
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProfile

Gets profile

```php
public getProfile(string $organizationId): \Upsun\Model\Profile
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateAddress

Updates address

```php
public updateAddress(string $organizationId, ?string $country = null, ?string $nameLine = null, ?string $premise = null, ?string $subPremise = null, ?string $thoroughfare = null, ?string $administrativeArea = null, ?string $subAdministrativeArea = null, ?string $locality = null, ?string $dependentLocality = null, ?string $postalCode = null): \Upsun\Model\Address
```

**Parameters:**

| Parameter                | Type        | Description |
|--------------------------|-------------|-------------|
| `$organizationId`        | **string**  |             |
| `$country`               | **?string** |             |
| `$nameLine`              | **?string** |             |
| `$premise`               | **?string** |             |
| `$subPremise`            | **?string** |             |
| `$thoroughfare`          | **?string** |             |
| `$administrativeArea`    | **?string** |             |
| `$subAdministrativeArea` | **?string** |             |
| `$locality`              | **?string** |             |
| `$dependentLocality`     | **?string** |             |
| `$postalCode`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProfile

Updates profile

```php
public updateProfile(string $organizationId, ?string $defaultCatalog = null, ?string $projectOptionsUrl = null, ?string $securityContact = null, ?string $companyName = null, ?string $vatNumber = null, ?string $billingContact = null): \Upsun\Model\Profile
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$organizationId`    | **string**  |             |
| `$defaultCatalog`    | **?string** |             |
| `$projectOptionsUrl` | **?string** |             |
| `$securityContact`   | **?string** |             |
| `$companyName`       | **?string** |             |
| `$vatNumber`         | **?string** |             |
| `$billingContact`    | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listRecords

Lists plan records

```php
public listRecords(string $organizationId, ?string $filterProjectId = null, ?string $filterPlan = null, ?\DateTime $filterStatus = null, ?\DateTime $filterStart = null, ?\DateTime $filterEnd = null, ?\DateTime $filterStartedAt = null, ?\DateTime $filterEndedAt = null, ?int $page = null): \Upsun\Model\ListOrgPlanRecords200Response
```

**Parameters:**

| Parameter          | Type           | Description |
|--------------------|----------------|-------------|
| `$organizationId`  | **string**     |             |
| `$filterProjectId` | **?string**    |             |
| `$filterPlan`      | **?string**    |             |
| `$filterStatus`    | **?\DateTime** |             |
| `$filterStart`     | **?\DateTime** |             |
| `$filterEnd`       | **?\DateTime** |             |
| `$filterStartedAt` | **?\DateTime** |             |
| `$filterEndedAt`   | **?\DateTime** |             |
| `$page`            | **?int**       |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUsageRecords

Lists usage records

```php
public listUsageRecords(string $organizationId, ?string $filterProjectId = null, ?string $filterUsageGroup = null, ?\DateTime $filterStart = null, ?\DateTime $filterStartedAt = null, ?int $page = null): \Upsun\Model\ListOrgUsageRecords200Response
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$organizationId`   | **string**     |             |
| `$filterProjectId`  | **?string**    |             |
| `$filterUsageGroup` | **?string**    |             |
| `$filterStart`      | **?\DateTime** |             |
| `$filterStartedAt`  | **?\DateTime** |             |
| `$page`             | **?int**       |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### applyVoucher

Applies voucher

```php
public applyVoucher(string $organizationId, string $code): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$code`           | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listVouchers

Lists vouchers

```php
public listVouchers(string $organizationId): \Upsun\Model\Vouchers
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getAddons

Get Organization Addons

```php
public getAddons(string $organizationId): \Upsun\Model\OrganizationAddonsObject
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateAddons

Updates Organization Addons

```php
public updateAddons(string $organizationId, ?string $userManagement = null, ?string $supportLevel = null): \Upsun\Model\OrganizationAddonsObject
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$userManagement` | **?string** |             |
| `$supportLevel`   | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client): mixed
```

**Parameters:**

| Parameter | Type                   | Description |
|-----------|------------------------|-------------|
| `$client` | **\Upsun\UpsunClient** |             |

***

### normalizeFilter

```php
protected normalizeFilter(array|string|int|\DateTime|null $value): array
```

**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **array\|string\|int\|\DateTime\|null** |             |

***

### extractSubscriptionId

Get SubscriptionId of a Project Licence Uri

```php
protected extractSubscriptionId(string $projectLicenceUri): string
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectLicenceUri` | **string** |             |

***
