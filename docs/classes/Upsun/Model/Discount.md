# Discount

Low level Discount (auto-generated)
The discount object.

***

* Full name: `\Upsun\Model\Discount`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### commitment

```php
private ?\Upsun\Model\DiscountCommitment $commitment
```

***

### totalMonths

```php
private ?int $totalMonths
```

***

### endAt

```php
private ?\DateTime $endAt
```

***

### id

```php
private ?int $id
```

***

### organizationId

```php
private ?string $organizationId
```

***

### type

```php
private ?string $type
```

***

### typeLabel

```php
private ?string $typeLabel
```

***

### status

```php
private ?string $status
```

***

### discount

```php
private ?\Upsun\Model\DiscountDiscount $discount
```

***

### config

```php
private ?object $config
```

***

### startAt

```php
private ?\DateTime $startAt
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\DiscountCommitment $commitment = null, ?int $totalMonths = null, ?\DateTime $endAt = null, ?int $id = null, ?string $organizationId = null, ?string $type = null, ?string $typeLabel = null, ?string $status = null, ?\Upsun\Model\DiscountDiscount $discount = null, ?object $config = null, ?\DateTime $startAt = null): mixed
```

**Parameters:**

| Parameter         | Type                                 | Description |
|-------------------|--------------------------------------|-------------|
| `$commitment`     | **?\Upsun\Model\DiscountCommitment** |             |
| `$totalMonths`    | **?int**                             |             |
| `$endAt`          | **?\DateTime**                       |             |
| `$id`             | **?int**                             |             |
| `$organizationId` | **?string**                          |             |
| `$type`           | **?string**                          |             |
| `$typeLabel`      | **?string**                          |             |
| `$status`         | **?string**                          |             |
| `$discount`       | **?\Upsun\Model\DiscountDiscount**   |             |
| `$config`         | **?object**                          |             |
| `$startAt`        | **?\DateTime**                       |             |

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

### getId

The ID of the organization discount.

```php
public getId(): ?int
```

***

### getOrganizationId

The ULID of the organization the discount applies to.

```php
public getOrganizationId(): ?string
```

***

### getType

The machine name of the discount type.

```php
public getType(): ?string
```

***

### getTypeLabel

The label of the discount type.

```php
public getTypeLabel(): ?string
```

***

### getStatus

The status of the discount.

```php
public getStatus(): ?string
```

***

### getCommitment

The minimum commitment associated with the discount (if applicable).

```php
public getCommitment(): ?\Upsun\Model\DiscountCommitment
```

***

### getTotalMonths

The contract length in months (if applicable).

```php
public getTotalMonths(): ?int
```

***

### getDiscount

Discount value per relevant time periods.

```php
public getDiscount(): ?\Upsun\Model\DiscountDiscount
```

***

### getConfig

The discount type specific configuration.

```php
public getConfig(): ?object
```

***

### getStartAt

The start time of the discount period.

```php
public getStartAt(): ?\DateTime
```

***

### getEndAt

The end time of the discount period (if applicable).

```php
public getEndAt(): ?\DateTime
```

***
