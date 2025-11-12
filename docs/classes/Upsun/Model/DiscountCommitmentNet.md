# DiscountCommitmentNet

Low level DiscountCommitmentNet (auto-generated)

Net commitment amounts (discount deducted).

***

* Full name: `\Upsun\Model\DiscountCommitmentNet`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### monthly

```php
private ?\Upsun\Model\CurrencyAmount $monthly
```

***

### commitmentPeriod

```php
private ?\Upsun\Model\CurrencyAmount $commitmentPeriod
```

***

### contractTotal

```php
private ?\Upsun\Model\CurrencyAmount $contractTotal
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\CurrencyAmount $monthly = null, ?\Upsun\Model\CurrencyAmount $commitmentPeriod = null, ?\Upsun\Model\CurrencyAmount $contractTotal = null): mixed
```

**Parameters:**

| Parameter           | Type                             | Description |
|---------------------|----------------------------------|-------------|
| `$monthly`          | **?\Upsun\Model\CurrencyAmount** |             |
| `$commitmentPeriod` | **?\Upsun\Model\CurrencyAmount** |             |
| `$contractTotal`    | **?\Upsun\Model\CurrencyAmount** |             |

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

### getMonthly

Currency amount with detailed components.

```php
public getMonthly(): ?\Upsun\Model\CurrencyAmount
```

***

### getCommitmentPeriod

Currency amount with detailed components.

```php
public getCommitmentPeriod(): ?\Upsun\Model\CurrencyAmount
```

***

### getContractTotal

Currency amount with detailed components.

```php
public getContractTotal(): ?\Upsun\Model\CurrencyAmount
```

***
