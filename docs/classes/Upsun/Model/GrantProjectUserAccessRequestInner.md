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
