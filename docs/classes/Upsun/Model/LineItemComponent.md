# LineItemComponent

Low level LineItemComponent (auto-generated)
A price component for a line item.

***

* Full name: `\Upsun\Model\LineItemComponent`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### amount

```php
private ?float $amount
```

***

### amountFormatted

```php
private ?string $amountFormatted
```

***

### displayTitle

```php
private ?string $displayTitle
```

***

### currency

```php
private ?string $currency
```

***

## Methods

### __construct

```php
public __construct(?float $amount = null, ?string $amountFormatted = null, ?string $displayTitle = null, ?string $currency = null): mixed
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$amount`          | **?float**  |             |
| `$amountFormatted` | **?string** |             |
| `$displayTitle`    | **?string** |             |
| `$currency`        | **?string** |             |

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

### getAmount

The price as a decimal.

```php
public getAmount(): ?float
```

***

### getAmountFormatted

The price formatted with currency.

```php
public getAmountFormatted(): ?string
```

***

### getDisplayTitle

The display title for the component.

```php
public getDisplayTitle(): ?string
```

***

### getCurrency

The currency code for the component.

```php
public getCurrency(): ?string
```

***
