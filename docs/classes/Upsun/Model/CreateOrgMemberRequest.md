# CreateOrgMemberRequest

Low level CreateOrgMemberRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateOrgMemberRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                      | Visibility | Type | Value             |
|-------------------------------|------------|------|-------------------|
| `PERMISSIONS_ADMIN`           | public     |      | 'admin'           |
| `PERMISSIONS_BILLING`         | public     |      | 'billing'         |
| `PERMISSIONS_MEMBERS`         | public     |      | 'members'         |
| `PERMISSIONS_PLANS`           | public     |      | 'plans'           |
| `PERMISSIONS_PROJECTS_CREATE` | public     |      | 'projects:create' |
| `PERMISSIONS_PROJECTS_LIST`   | public     |      | 'projects:list'   |

## Properties

### userId

```php
private string $userId
```

***

### permissions

```php
private ?array $permissions
```

***

## Methods

### __construct

```php
public __construct(string $userId, ?array $permissions = []): mixed
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$userId`      | **string** |             |
| `$permissions` | **?array** |             |

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
public getPermissions(): ?array
```

***
