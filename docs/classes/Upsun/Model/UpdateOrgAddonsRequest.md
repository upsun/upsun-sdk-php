# UpdateOrgAddonsRequest

Low level UpdateOrgAddonsRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateOrgAddonsRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                   | Visibility | Type | Value      |
|----------------------------|------------|------|------------|
| `USER_MANAGEMENT_STANDARD` | public     |      | 'standard' |
| `USER_MANAGEMENT_ENHANCED` | public     |      | 'enhanced' |
| `SUPPORT_LEVEL_BASIC`      | public     |      | 'basic'    |
| `SUPPORT_LEVEL_PREMIUM`    | public     |      | 'premium'  |

## Properties

### userManagement

```php
private ?string $userManagement
```

***

### supportLevel

```php
private ?string $supportLevel
```

***

## Methods

### __construct

```php
public __construct(?string $userManagement = null, ?string $supportLevel = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$userManagement` | **?string** |             |
| `$supportLevel`   | **?string** |             |

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

### getUserManagement

```php
public getUserManagement(): ?string
```

***

### getSupportLevel

```php
public getSupportLevel(): ?string
```

***
