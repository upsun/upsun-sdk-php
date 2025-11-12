# OrganizationEstimationObjectUserLicensesUserManagement

Low level OrganizationEstimationObjectUserLicensesUserManagement (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagement`
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

### list

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList $list
```

***

## Methods

### __construct

```php
public __construct(?int $count = null, ?string $total = null, ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList $list = null): mixed
```

**Parameters:**

| Parameter | Type                                                                         | Description |
|-----------|------------------------------------------------------------------------------|-------------|
| `$count`  | **?int**                                                                     |             |
| `$total`  | **?string**                                                                  |             |
| `$list`   | **?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList** |             |

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

The number of user_management licenses.

```php
public getCount(): ?int
```

***

### getTotal

The total price for user_management licenses.

```php
public getTotal(): ?string
```

***

### getList

```php
public getList(): ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList
```

***
