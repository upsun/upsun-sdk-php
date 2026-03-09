# DiscountDiscount

Low level DiscountDiscount (auto-generated)
Discount value per relevant time periods.

***

* Full name: `\Upsun\Model\DiscountDiscount`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### commitmentPeriod

```php
private ?\Upsun\Model\CurrencyAmountNullable $commitmentPeriod
```

***

### contractTotal

```php
private ?\Upsun\Model\CurrencyAmountNullable $contractTotal
```

***

### monthly

```php
private ?\Upsun\Model\CurrencyAmount $monthly
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\CurrencyAmountNullable $commitmentPeriod = null, ?\Upsun\Model\CurrencyAmountNullable $contractTotal = null, ?\Upsun\Model\CurrencyAmount $monthly = null): mixed
```

**Parameters:**

| Parameter           | Type                                     | Description |
|---------------------|------------------------------------------|-------------|
| `$commitmentPeriod` | **?\Upsun\Model\CurrencyAmountNullable** |             |
| `$contractTotal`    | **?\Upsun\Model\CurrencyAmountNullable** |             |
| `$monthly`          | **?\Upsun\Model\CurrencyAmount**         |             |

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
public getCommitmentPeriod(): ?\Upsun\Model\CurrencyAmountNullable
```

***

### getContractTotal

Currency amount with detailed components.

```php
public getContractTotal(): ?\Upsun\Model\CurrencyAmountNullable
```

***
