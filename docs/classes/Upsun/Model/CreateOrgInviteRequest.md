# CreateOrgInviteRequest

Low level CreateOrgInviteRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateOrgInviteRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                     | Visibility | Type | Value            |
|------------------------------|------------|------|------------------|
| `PERMISSIONS_ADMIN`          | public     |      | 'admin'          |
| `PERMISSIONS_BILLING`        | public     |      | 'billing'        |
| `PERMISSIONS_PLANS`          | public     |      | 'plans'          |
| `PERMISSIONS_MEMBERS`        | public     |      | 'members'        |
| `PERMISSIONS_PROJECT_CREATE` | public     |      | 'project:create' |
| `PERMISSIONS_PROJECTS_LIST`  | public     |      | 'projects:list'  |

## Properties

### email

```php
private string $email
```

***

### permissions

```php
private array $permissions
```

***

### force

```php
private ?bool $force
```

***

## Methods

### __construct

```php
public __construct(string $email, array $permissions, ?bool $force = null): mixed
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$email`       | **string** |             |
| `$permissions` | **array**  |             |
| `$force`       | **?bool**  |             |

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

### getEmail

```php
public getEmail(): string
```

***

### getPermissions

```php
public getPermissions(): array
```

***

### getForce

```php
public getForce(): ?bool
```

***
