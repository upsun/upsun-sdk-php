# CurrencyAmountNullable

Low level CurrencyAmountNullable (auto-generated)

Currency amount with detailed components.

***

* Full name: `\Upsun\Model\CurrencyAmountNullable`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### formatted

```php
private ?string $formatted
```

***

### amount

```php
private ?float $amount
```

***

### currencyCode

```php
private ?string $currencyCode
```

***

### currencySymbol

```php
private ?string $currencySymbol
```

***

## Methods

### __construct

```php
public __construct(?string $formatted = null, ?float $amount = null, ?string $currencyCode = null, ?string $currencySymbol = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$formatted`      | **?string** |             |
| `$amount`         | **?float**  |             |
| `$currencyCode`   | **?string** |             |
| `$currencySymbol` | **?string** |             |

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

### getFormatted

Formatted currency value.

```php
public getFormatted(): ?string
```

***

### getAmount

Plain amount.

```php
public getAmount(): ?float
```

***

### getCurrencyCode

Currency code.

```php
public getCurrencyCode(): ?string
```

***

### getCurrencySymbol

Currency symbol.

```php
public getCurrencySymbol(): ?string
```

***
