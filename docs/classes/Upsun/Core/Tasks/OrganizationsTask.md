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

### organizationsApi

```php
private \Upsun\Api\OrganizationsApi $organizationsApi
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
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\OrganizationsApi $organizationsApi, \Upsun\Api\OrganizationProjectsApi $projectsApi, \Upsun\Api\OrganizationMembersApi $membersApi, \Upsun\Api\SubscriptionsApi $subscriptionsApi, \Upsun\Api\InvoicesApi $invoicesApi, \Upsun\Api\MfaApi $mfaApi, \Upsun\Api\OrdersApi $ordersApi, \Upsun\Api\ProfilesApi $profilesApi, \Upsun\Api\RecordsApi $recordsApi, \Upsun\Api\VouchersApi $vouchersApi, \Upsun\Api\AddOnsApi $addOnsApi): mixed
```

**Parameters:**

| Parameter           | Type                                   | Description |
|---------------------|----------------------------------------|-------------|
| `$client`           | **\Upsun\UpsunClient**                 |             |
| `$organizationsApi` | **\Upsun\Api\OrganizationsApi**        |             |
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

Create organization

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

Delete organization

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### info

Get or update organization info

```php
public info(string $organizationId, ?string $name = null, ?string $label = null, ?string $country = null, ?string $securityContact = null): \Upsun\Model\Organization
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$organizationId`  | **string**  |             |
| `$name`            | **?string** |             |
| `$label`           | **?string** |             |
| `$country`         | **?string** |             |
| `$securityContact` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### get

Get organization

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### update

Update an organization

```php
public update(string $organizationId, ?string $name = null, ?string $label = null, ?string $country = null, ?string $securityContact = null): \Upsun\Model\Organization
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$organizationId`  | **string**  |             |
| `$name`            | **?string** |             |
| `$label`           | **?string** |             |
| `$country`         | **?string** |             |
| `$securityContact` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### list

List organizations

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

### listSubscriptions

List the subscriptions for an organization. This will return a list of all active and past subscriptions associated
with the organization, including details such as the subscription plan, status, and billing information.

```php
public listSubscriptions(string $organizationId): \Upsun\Model\ListOrgSubscriptions200Response
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the organization ID is invalid


***

### createMember

Create an organization member

```php
public createMember(string $organizationId, string $userId, ("read"|"write"|"admin")[]|null $permissions = []): \Upsun\Model\OrganizationMember
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter         | Type                                   | Description |
|-------------------|----------------------------------------|-------------|
| `$organizationId` | **string**                             |             |
| `$userId`         | **string**                             |             |
| `$permissions`    | **("read"\|"write"\|"admin")[]\|null** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### addMember

Add a member to an organization with the specified permissions. This will invite the user to join the
organization,and the user will need to accept the invitation before they become an active member of the
organization. The permissions parameter can be used to specify the level of access the member will have within
the organization.

```php
public addMember(string $organizationId, string $userId, ("read"|"write"|"admin")[]|null $permissions = []): \Upsun\Model\OrganizationMember
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getMember

Get organization member

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listMembers

List members of an organization

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateMember

Update an organization member's permissions. This will modify the member's access level within the organization
based on the specified permissions.

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

### listUserOrgs

List the organizations that a user belongs to, with optional filtering. This will return a list of organizations
that the specified user is a member of, and the filters can be used to narrow down the list based on specific
criteria.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listCurrentUserOrgs

List organization accessible to the current user, with optional filtering.

```php
public listCurrentUserOrgs(?array $filterId = null, ?array $filterVendor = null, ?array $filterStatus = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListUserOrgs200Response
```

This will return a list of organizations that the current user has access to, and the filters can be used to
narrow down the list based on specific criteria.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listTeams

Get Teams of the current organization (for current user)

```php
public listTeams(?string $filterOrganizationId = null, ?string $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$filterOrganizationId` | **?string** |             |
| `$filterUpdatedAt`      | **?string** |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listTeamsByMember

Retrieve teams that the specified user is a member of.

```php
public listTeamsByMember(string $userId, ?array $filterOrganizationId = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$userId`               | **string**  |             |
| `$filterOrganizationId` | **?array**  |             |
| `$filterUpdatedAt`      | **?array**  |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getProject

Get a project

```php
public getProject(string $projectId): \Upsun\Model\Project
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listProjects

List projects from an organization

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### canCreateProject

Check if a new project can be created within the specified organization. This will return information about whether
the organization is eligible to create a new project, based on factors such as the organization's current
subscription status, project limits, and any other relevant criteria defined by the API.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### createProject

Create a project

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### deleteProject

Delete a project

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### estimateNewProject

Estimate the cost of creating a new project within the specified organization, based on parameters such as the
number of environments, storage, and user licenses.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### estimateProject

Estimate the cost of a project within the specified organization, based on parameters such as the
number of environments, storage, and user licenses.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getProjectUsage

Get current usage for a project

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateProject

Update a project

```php
public updateProject(string $projectId, ?string $title = null, ?string $defaultBranch = null, ?string $description = null, ?string $defaultDomain = null, ?array $attributes = [], ?string $timezone = null, ?string $region = null): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### disableMfaEnforcement

Disable organization MFA enforcement

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### enableMfaEnforcement

Enable organization MFA enforcement

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getMfaEnforcement

Get organization MFA settings

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### sendMfaReminders

Send MFA reminders to organization members

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getInvoice

Get invoice

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listInvoices

List invoices

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### downloadInvoice

Download an invoice.

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

### createAuthorizationCredentials

Create confirmation credentials for 3D-Secure

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getOrder

Get an order

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listOrders

List orders

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

Get address

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getProfile

Get profile

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateAddress

Update address

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateProfile

Update profile

```php
public updateProfile(string $organizationId, ?string $defaultCatalog = null, ?string $projectOptionsUrl = null, ?string $companyName = null, ?string $vatNumber = null, ?string $billingContact = null): \Upsun\Model\Profile
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$organizationId`    | **string**  |             |
| `$defaultCatalog`    | **?string** |             |
| `$projectOptionsUrl` | **?string** |             |
| `$companyName`       | **?string** |             |
| `$vatNumber`         | **?string** |             |
| `$billingContact`    | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listRecords

List plan records

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listUsageRecords

List usage records

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### applyVoucher

Apply a voucher code to an organization. This will attempt to apply the specified voucher code to the
organization's account, which may result in discounts, credits, or other benefits being applied to the
organization's subscription.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listVouchers

List vouchers

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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

### checkUserId

```php
protected static checkUserId(string $userId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

***

### checkProjectId

```php
protected static checkProjectId(string $projectId): void
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

***

### checkOrganizationId

```php
protected static checkOrganizationId(string $organizationId): void
```

* This method is **static**.
**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

***

### checkEnvironmentId

```php
protected static checkEnvironmentId(string $environmentId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$environmentId` | **string** |             |

***

### checkActivityId

```php
protected static checkActivityId(string $activityId): void
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$activityId` | **string** |             |

***

### checkApplicationId

```php
protected static checkApplicationId(string $applicationId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$applicationId` | **string** |             |

***

### checkBackupId

```php
protected static checkBackupId(string $backupId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$backupId` | **string** |             |

***

### checkCertificateId

```php
protected static checkCertificateId(string $certificateId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$certificateId` | **string** |             |

***

### checkSubscriptionId

```php
protected static checkSubscriptionId(string $subscriptionId): void
```

* This method is **static**.
**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$subscriptionId` | **string** |             |

***

### checkTeamId

```php
protected static checkTeamId(string $teamId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |

***

### checkDeploymentId

```php
protected static checkDeploymentId(string $deploymentId): void
```

* This method is **static**.
**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$deploymentId` | **string** |             |

***

### checkInvoiceId

```php
protected static checkInvoiceId(string $invoiceId): void
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$invoiceId` | **string** |             |

***

### checkOrderId

```php
protected static checkOrderId(string $orderId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$orderId` | **string** |             |

***

### checkVoucherCode

```php
protected static checkVoucherCode(string $code): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$code`   | **string** |             |

***

### checkProjectRegion

```php
protected static checkProjectRegion(string $region): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$region` | **string** |             |

***

### checkVariableId

```php
protected static checkVariableId(string $variableId): void
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$variableId` | **string** |             |

***

### checkRepositoryBlobId

```php
protected static checkRepositoryBlobId(string $repositoryBlobId): void
```

* This method is **static**.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$repositoryBlobId` | **string** |             |

***

### checkRepositoryCommitId

```php
protected static checkRepositoryCommitId(string $repositoryCommitId): void
```

* This method is **static**.
**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$repositoryCommitId` | **string** |             |

***

### checkRepositoryRefId

```php
protected static checkRepositoryRefId(string $repositoryRefId): void
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$repositoryRefId` | **string** |             |

***

### checkRepositoryTreeId

```php
protected static checkRepositoryTreeId(string $repositoryTreeId): void
```

* This method is **static**.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$repositoryTreeId` | **string** |             |

***

### checkIntegrationId

```php
protected static checkIntegrationId(string $integrationId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$integrationId` | **string** |             |

***

### checkDomainId

```php
protected static checkDomainId(string $domainId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$domainId` | **string** |             |

***

### checkApiTokenId

```php
protected static checkApiTokenId(string $tokenId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$tokenId` | **string** |             |

***

### checkEmail

```php
protected static checkEmail(string $email): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** |             |

***

### checkInviteId

```php
protected static checkInviteId(string $inviteId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$inviteId` | **string** |             |

***

### checkUsername

```php
protected static checkUsername(string $username): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** |             |

***

### checkSshKeyId

```php
protected static checkSshKeyId(int $keyId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$keyId`  | **int** |             |

***

### checkEnvironmentTypeId

```php
protected static checkEnvironmentTypeId(string $environmentTypeId): void
```

* This method is **static**.
**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$environmentTypeId` | **string** |             |

***

### checkRouteId

```php
protected static checkRouteId(string $routeId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$routeId` | **string** |             |

***

### checkInvitationId

```php
protected static checkInvitationId(string $invitationId): void
```

* This method is **static**.
**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$invitationId` | **string** |             |

***

### checkTicketId

```php
protected static checkTicketId(string $ticketId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$ticketId` | **string** |             |

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
