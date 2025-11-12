# OrganizationEstimationObject

Low level OrganizationEstimationObject (auto-generated)

An estimation of all organization spend.

***

* Full name: `\Upsun\Model\OrganizationEstimationObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### total

```php
private ?string $total
```

***

### subTotal

```php
private ?string $subTotal
```

***

### vouchers

```php
private ?string $vouchers
```

***

### userLicenses

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicenses $userLicenses
```

***

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

### subscriptions

```php
private ?\Upsun\Model\OrganizationEstimationObjectSubscriptions $subscriptions
```

***

## Methods

### __construct

```php
public __construct(?string $total = null, ?string $subTotal = null, ?string $vouchers = null, ?\Upsun\Model\OrganizationEstimationObjectUserLicenses $userLicenses = null, ?string $userManagement = null, ?string $supportLevel = null, ?\Upsun\Model\OrganizationEstimationObjectSubscriptions $subscriptions = null): mixed
```

**Parameters:**

| Parameter         | Type                                                        | Description |
|-------------------|-------------------------------------------------------------|-------------|
| `$total`          | **?string**                                                 |             |
| `$subTotal`       | **?string**                                                 |             |
| `$vouchers`       | **?string**                                                 |             |
| `$userLicenses`   | **?\Upsun\Model\OrganizationEstimationObjectUserLicenses**  |             |
| `$userManagement` | **?string**                                                 |             |
| `$supportLevel`   | **?string**                                                 |             |
| `$subscriptions`  | **?\Upsun\Model\OrganizationEstimationObjectSubscriptions** |             |

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

### getTotal

The total estimated price for the organization.

```php
public getTotal(): ?string
```

***

### getSubTotal

The sub total for all projects and sellables.

```php
public getSubTotal(): ?string
```

***

### getVouchers

The total amount of vouchers.

```php
public getVouchers(): ?string
```

***

### getUserLicenses

An estimation of user licenses cost.

```php
public getUserLicenses(): ?\Upsun\Model\OrganizationEstimationObjectUserLicenses
```

***

### getUserManagement

An estimation of the advanced user management sellable cost.

```php
public getUserManagement(): ?string
```

***

### getSupportLevel

The total monthly price for premium support.

```php
public getSupportLevel(): ?string
```

***

### getSubscriptions

An estimation of subscriptions cost.

```php
public getSubscriptions(): ?\Upsun\Model\OrganizationEstimationObjectSubscriptions
```

***
