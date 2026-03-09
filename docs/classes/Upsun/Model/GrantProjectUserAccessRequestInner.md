# GrantProjectUserAccessRequestInner

Low level GrantProjectUserAccessRequestInner (auto-generated)

***

* Full name: `\Upsun\Model\GrantProjectUserAccessRequestInner`
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
private string $userId
```

***

### permissions

```php
private array $permissions
```

***

### autoAddMember

```php
private ?bool $autoAddMember
```

***

## Methods

### __construct

```php
public __construct(string $userId, array $permissions, ?bool $autoAddMember = null): mixed
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$userId`        | **string** |             |
| `$permissions`   | **array**  |             |
| `$autoAddMember` | **?bool**  |             |

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

```php
public getUserId(): string
```

***

### getPermissions

```php
public getPermissions(): array
```

***

### getAutoAddMember

```php
public getAutoAddMember(): ?bool
```

***
