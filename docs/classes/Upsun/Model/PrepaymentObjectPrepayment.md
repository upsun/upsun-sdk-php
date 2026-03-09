# PrepaymentObjectPrepayment

Low level PrepaymentObjectPrepayment (auto-generated)
Prepayment information for an organization.

***

* Full name: `\Upsun\Model\PrepaymentObjectPrepayment`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### lastUpdatedAt

```php
private ?string $lastUpdatedAt
```

***

### fallback

```php
private ?string $fallback
```

***

### organizationId

```php
private ?string $organizationId
```

***

### balance

```php
private ?\Upsun\Model\PrepaymentObjectPrepaymentBalance $balance
```

***

### sufficient

```php
private ?bool $sufficient
```

***

## Methods

### __construct

```php
public __construct(?string $lastUpdatedAt = null, ?string $fallback = null, ?string $organizationId = null, ?\Upsun\Model\PrepaymentObjectPrepaymentBalance $balance = null, ?bool $sufficient = null): mixed
```

**Parameters:**

| Parameter         | Type                                                | Description |
|-------------------|-----------------------------------------------------|-------------|
| `$lastUpdatedAt`  | **?string**                                         |             |
| `$fallback`       | **?string**                                         |             |
| `$organizationId` | **?string**                                         |             |
| `$balance`        | **?\Upsun\Model\PrepaymentObjectPrepaymentBalance** |             |
| `$sufficient`     | **?bool**                                           |             |

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

### getOrganizationId

Organization ID

```php
public getOrganizationId(): ?string
```

***

### getBalance

The prepayment balance in complex format.

```php
public getBalance(): ?\Upsun\Model\PrepaymentObjectPrepaymentBalance
```

***

### getLastUpdatedAt

The date the prepayment balance was last updated.

```php
public getLastUpdatedAt(): ?string
```

***

### getSufficient

Whether the prepayment balance is enough to cover the upcoming order.

```php
public getSufficient(): ?bool
```

***

### getFallback

The fallback payment method, if any, to be used in case prepayment balance is not enough to cover an order.

```php
public getFallback(): ?string
```

***
