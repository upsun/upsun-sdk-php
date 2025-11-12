# UsageAlertConfigThreshold

Low level UsageAlertConfigThreshold (auto-generated)

Data regarding threshold spend.

***

* Full name: `\Upsun\Model\UsageAlertConfigThreshold`
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

### unit

```php
private ?string $unit
```

***

## Methods

### __construct

```php
public __construct(?string $formatted = null, ?float $amount = null, ?string $unit = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$formatted` | **?string** |             |
| `$amount`    | **?float**  |             |
| `$unit`      | **?string** |             |

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

Formatted threshold value.

```php
public getFormatted(): ?string
```

***

### getAmount

Threshold value.

```php
public getAmount(): ?float
```

***

### getUnit

Threshold unit.

```php
public getUnit(): ?string
```

***
