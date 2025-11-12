# OwnerInfo

Low level OwnerInfo (auto-generated)

Project owner information that can be exposed to collaborators.

***

* Full name: `\Upsun\Model\OwnerInfo`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private ?string $type
```

***

### username

```php
private ?string $username
```

***

### displayName

```php
private ?string $displayName
```

***

## Methods

### __construct

```php
public __construct(?string $type = null, ?string $username = null, ?string $displayName = null): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$type`        | **?string** |             |
| `$username`    | **?string** |             |
| `$displayName` | **?string** |             |

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

### getType

Type of the owner, usually 'user'.

```php
public getType(): ?string
```

***

### getUsername

The username of the owner.

```php
public getUsername(): ?string
```

***

### getDisplayName

The full name of the owner.

```php
public getDisplayName(): ?string
```

***
