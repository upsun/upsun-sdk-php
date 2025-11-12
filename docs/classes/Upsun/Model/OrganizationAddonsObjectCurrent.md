# OrganizationAddonsObjectCurrent

Low level OrganizationAddonsObjectCurrent (auto-generated)

The list of existing add-ons and their current values.

***

* Full name: `\Upsun\Model\OrganizationAddonsObjectCurrent`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### userManagement

```php
private ?array $userManagement
```

***

### supportLevel

```php
private ?array $supportLevel
```

***

## Methods

### __construct

```php
public __construct(?array $userManagement = [], ?array $supportLevel = []): mixed
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$userManagement` | **?array** |             |
| `$supportLevel`   | **?array** |             |

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
public getUserManagement(): ?array
```

***

### getSupportLevel

```php
public getSupportLevel(): ?array
```

***
