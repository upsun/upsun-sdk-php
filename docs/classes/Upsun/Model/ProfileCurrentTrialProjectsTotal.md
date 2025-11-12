# ProfileCurrentTrialProjectsTotal

Low level ProfileCurrentTrialProjectsTotal (auto-generated)

***

* Full name: `\Upsun\Model\ProfileCurrentTrialProjectsTotal`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### amount

```php
private ?int $amount
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

### formatted

```php
private ?string $formatted
```

***

## Methods

### __construct

```php
public __construct(?int $amount = null, ?string $currencyCode = null, ?string $currencySymbol = null, ?string $formatted = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$amount`         | **?int**    |             |
| `$currencyCode`   | **?string** |             |
| `$currencySymbol` | **?string** |             |
| `$formatted`      | **?string** |             |

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

Trial project cost

```php
public getAmount(): ?int
```

***

### getCurrencyCode

Currency code

```php
public getCurrencyCode(): ?string
```

***

### getCurrencySymbol

Currency symbol

```php
public getCurrencySymbol(): ?string
```

***

### getFormatted

Trial project cost formatted with currency sign

```php
public getFormatted(): ?string
```

***
