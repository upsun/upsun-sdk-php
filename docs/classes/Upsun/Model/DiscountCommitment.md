# DiscountCommitment

Low level DiscountCommitment (auto-generated)

The minimum commitment associated with the discount (if applicable).

***

* Full name: `\Upsun\Model\DiscountCommitment`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### months

```php
private ?int $months
```

***

### amount

```php
private ?\Upsun\Model\DiscountCommitmentAmount $amount
```

***

### net

```php
private ?\Upsun\Model\DiscountCommitmentNet $net
```

***

## Methods

### __construct

```php
public __construct(?int $months = null, ?\Upsun\Model\DiscountCommitmentAmount $amount = null, ?\Upsun\Model\DiscountCommitmentNet $net = null): mixed
```

**Parameters:**

| Parameter | Type                                       | Description |
|-----------|--------------------------------------------|-------------|
| `$months` | **?int**                                   |             |
| `$amount` | **?\Upsun\Model\DiscountCommitmentAmount** |             |
| `$net`    | **?\Upsun\Model\DiscountCommitmentNet**    |             |

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

### getMonths

Commitment period length in months.

```php
public getMonths(): ?int
```

***

### getAmount

Commitment amounts.

```php
public getAmount(): ?\Upsun\Model\DiscountCommitmentAmount
```

***

### getNet

Net commitment amounts (discount deducted).

```php
public getNet(): ?\Upsun\Model\DiscountCommitmentNet
```

***
