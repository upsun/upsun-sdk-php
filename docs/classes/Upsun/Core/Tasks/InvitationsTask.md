# InvitationsTask

InvitationTask class.

***

* Full name: `\Upsun\Core\Tasks\InvitationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### orgInvApi

```php
private \Upsun\Api\OrganizationInvitationsApi $orgInvApi
```

***

### prjInvApi

```php
private \Upsun\Api\ProjectInvitationsApi $prjInvApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\OrganizationInvitationsApi $orgInvApi, \Upsun\Api\ProjectInvitationsApi $prjInvApi): mixed
```

**Parameters:**

| Parameter    | Type                                      | Description |
|--------------|-------------------------------------------|-------------|
| `$client`    | **\Upsun\UpsunClient**                    |             |
| `$orgInvApi` | **\Upsun\Api\OrganizationInvitationsApi** |             |
| `$prjInvApi` | **\Upsun\Api\ProjectInvitationsApi**      |             |

***

### cancelOrgInvite

Cancels a pending invitation to an organization

```php
public cancelOrgInvite(string $organizationId, string $invitationId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$invitationId`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createOrgInvite

Invites user to an organization by email

```php
public createOrgInvite(string $organizationId, string $email, array $permissions, ?bool $force = true): \Upsun\Model\OrganizationInvitation
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$email`          | **string** |             |
| `$permissions`    | **array**  |             |
| `$force`          | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgInvites

Lists invitations to an organization

```php
public listOrgInvites(string $organizationId, ?array $filterState = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\OrganizationInvitation[]
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$filterState`    | **?array**  |             |
| `$pageSize`       | **?int**    |             |
| `$pageBefore`     | **?string** |             |
| `$pageAfter`      | **?string** |             |
| `$sort`           | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### cancelProjectInvite

Cancels a pending invitation to a project

```php
public cancelProjectInvite(string $projectId, string $invitationId): void
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$projectId`    | **string** |             |
| `$invitationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectInvite

Invites user to a project by email

```php
public createProjectInvite(string $projectId, string $email, ?string $role = null, array<int,"read"|"write"|"admin">|null $permissions = null, array<int,array{id: string, name: string}>|null $environments = null, ?bool $force = null): \Upsun\Model\ProjectInvitation
```

**Parameters:**

| Parameter       | Type                                                 | Description |
|-----------------|------------------------------------------------------|-------------|
| `$projectId`    | **string**                                           |             |
| `$email`        | **string**                                           |             |
| `$role`         | **?string**                                          |             |
| `$permissions`  | **array<int,"read"\|"write"\|"admin">\|null**        |             |
| `$environments` | **array<int,array{id: string, name: string}>\|null** |             |
| `$force`        | **?bool**                                            |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectInvites

Lists invitations to a project

```php
public listProjectInvites(string $projectId, ?array $filterState = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ProjectInvitation[]
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$projectId`   | **string**  |             |
| `$filterState` | **?array**  |             |
| `$pageSize`    | **?int**    |             |
| `$pageBefore`  | **?string** |             |
| `$pageAfter`   | **?string** |             |
| `$sort`        | **?string** |             |

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
