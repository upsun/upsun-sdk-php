# OrderBillingPeriodLabel

Low level OrderBillingPeriodLabel (auto-generated)

Descriptive information about the billing cycle.

***

* Full name: `\Upsun\Model\OrderBillingPeriodLabel`
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

### month

```php
private ?string $month
```

***

### year

```php
private ?string $year
```

***

### nextMonth

```php
private ?string $nextMonth
```

***

## Methods

### __construct

```php
public __construct(?string $formatted = null, ?string $month = null, ?string $year = null, ?string $nextMonth = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$formatted` | **?string** |             |
| `$month`     | **?string** |             |
| `$year`      | **?string** |             |
| `$nextMonth` | **?string** |             |

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

The renderable label for the billing cycle.

```php
public getFormatted(): ?string
```

***

### getMonth

The month of the billing cycle.

```php
public getMonth(): ?string
```

***

### getYear

The year of the billing cycle.

```php
public getYear(): ?string
```

***

### getNextMonth

The name of the next month following this billing cycle.

```php
public getNextMonth(): ?string
```

***
