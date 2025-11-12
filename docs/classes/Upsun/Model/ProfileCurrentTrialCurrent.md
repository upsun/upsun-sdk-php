# ProfileCurrentTrialCurrent

Low level ProfileCurrentTrialCurrent (auto-generated)

The total amount spent by the trial user at this point in time.

***

* Full name: `\Upsun\Model\ProfileCurrentTrialCurrent`
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
private ?string $amount
```

***

### currency

```php
private ?string $currency
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
public __construct(?string $formatted = null, ?string $amount = null, ?string $currency = null, ?string $currencySymbol = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$formatted`      | **?string** |             |
| `$amount`         | **?string** |             |
| `$currency`       | **?string** |             |
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

The total amount formatted.

```php
public getFormatted(): ?string
```

***

### getAmount

The total amount.

```php
public getAmount(): ?string
```

***

### getCurrency

The currency.

```php
public getCurrency(): ?string
```

***

### getCurrencySymbol

Currency symbol.

```php
public getCurrencySymbol(): ?string
```

***
