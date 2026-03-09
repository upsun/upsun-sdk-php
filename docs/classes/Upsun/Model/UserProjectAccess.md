# UserProjectAccess

Low level UserProjectAccess (auto-generated)

***

* Full name: `\Upsun\Model\UserProjectAccess`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                              | Visibility | Type | Value                     |
|---------------------------------------|------------|------|---------------------------|
| `PERMISSIONS_ADMIN`                   | public     |      | 'admin'                   |
| `PERMISSIONS_VIEWER`                  | public     |      | 'viewer'                  |
| `PERMISSIONS_DEVELOPMENT_ADMIN`       | public     |      | 'development:admin'       |
| `PERMISSIONS_DEVELOPMENT_CONTRIBUTOR` | public     |      | 'development:contributor' |
| `PERMISSIONS_DEVELOPMENT_VIEWER`      | public     |      | 'development:viewer'      |
| `PERMISSIONS_STAGING_ADMIN`           | public     |      | 'staging:admin'           |
| `PERMISSIONS_STAGING_CONTRIBUTOR`     | public     |      | 'staging:contributor'     |
| `PERMISSIONS_STAGING_VIEWER`          | public     |      | 'staging:viewer'          |
| `PERMISSIONS_PRODUCTION_ADMIN`        | public     |      | 'production:admin'        |
| `PERMISSIONS_PRODUCTION_CONTRIBUTOR`  | public     |      | 'production:contributor'  |
| `PERMISSIONS_PRODUCTION_VIEWER`       | public     |      | 'production:viewer'       |

## Properties

### userId

```php
private ?string $userId
```

***

### organizationId

```php
private ?string $organizationId
```

***

### projectId

```php
private ?string $projectId
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### permissions

```php
private ?array $permissions
```

***

### grantedAt

```php
private ?\DateTime $grantedAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### links

```php
private ?\Upsun\Model\TeamProjectAccessLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $userId = null, ?string $organizationId = null, ?string $projectId = null, ?string $projectTitle = null, ?array $permissions = [], ?\DateTime $grantedAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\TeamProjectAccessLinks $links = null): mixed
```

**Parameters:**

| Parameter         | Type                                     | Description |
|-------------------|------------------------------------------|-------------|
| `$userId`         | **?string**                              |             |
| `$organizationId` | **?string**                              |             |
| `$projectId`      | **?string**                              |             |
| `$projectTitle`   | **?string**                              |             |
| `$permissions`    | **?array**                               |             |
| `$grantedAt`      | **?\DateTime**                           |             |
| `$updatedAt`      | **?\DateTime**                           |             |
| `$links`          | **?\Upsun\Model\TeamProjectAccessLinks** |             |

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getUserId

The ID of the user.

```php
public getUserId(): ?string
```

***

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
```

***

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getProjectTitle

The title of the project.

```php
public getProjectTitle(): ?string
```

***

### getPermissions

```php
public getPermissions(): ?array
```

***

### getGrantedAt

The date and time when the access was granted.

```php
public getGrantedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the resource was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\TeamProjectAccessLinks
```

***
