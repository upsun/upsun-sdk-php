# CreateProjectInviteRequest

Low level CreateProjectInviteRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateProjectInviteRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### email

```php
private string $email
```

***

### role

```php
private ?string $role
```

***

### permissions

```php
private ?array $permissions
```

***

### environments

```php
private ?array $environments
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
public __construct(string $email, ?string $role = null, ?array $permissions = [], ?array $environments = [], ?bool $force = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$email`        | **string**  |             |
| `$role`         | **?string** |             |
| `$permissions`  | **?array**  |             |
| `$environments` | **?array**  |             |
| `$force`        | **?bool**   |             |

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

### getRole

```php
public getRole(): ?string
```

***

### getPermissions

```php
public getPermissions(): \Upsun\Model\CreateProjectInviteRequestPermissionsInner[]|null
```

***

### getEnvironments

```php
public getEnvironments(): \Upsun\Model\CreateProjectInviteRequestEnvironmentsInner[]|null
```

***

### getForce

```php
public getForce(): ?bool
```

***
