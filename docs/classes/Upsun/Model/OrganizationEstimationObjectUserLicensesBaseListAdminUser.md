# OrganizationEstimationObjectUserLicensesBaseListAdminUser

Low level OrganizationEstimationObjectUserLicensesBaseListAdminUser (auto-generated)

An estimation of admin users cost.

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### count

```php
private ?int $count
```

***

### total

```php
private ?string $total
```

***

## Methods

### __construct

```php
public __construct(?int $count = null, ?string $total = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$count`  | **?int**    |             |
| `$total`  | **?string** |             |

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

### getCount

The number of admin user licenses.

```php
public getCount(): ?int
```

***

### getTotal

The total price for admin user licenses.

```php
public getTotal(): ?string
```

***
