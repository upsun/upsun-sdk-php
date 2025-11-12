# UsageGroupCurrentUsageProperties

Low level UsageGroupCurrentUsageProperties (auto-generated)

Current usage info for a usage group.

***

* Full name: `\Upsun\Model\UsageGroupCurrentUsageProperties`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### title

```php
private ?string $title
```

***

### type

```php
private ?bool $type
```

***

### currentUsage

```php
private ?float $currentUsage
```

***

### currentUsageFormatted

```php
private ?string $currentUsageFormatted
```

***

### notCharged

```php
private ?bool $notCharged
```

***

### freeQuantity

```php
private ?float $freeQuantity
```

***

### freeQuantityFormatted

```php
private ?string $freeQuantityFormatted
```

***

### dailyAverage

```php
private ?float $dailyAverage
```

***

### dailyAverageFormatted

```php
private ?string $dailyAverageFormatted
```

***

## Methods

### __construct

```php
public __construct(?string $title = null, ?bool $type = null, ?float $currentUsage = null, ?string $currentUsageFormatted = null, ?bool $notCharged = null, ?float $freeQuantity = null, ?string $freeQuantityFormatted = null, ?float $dailyAverage = null, ?string $dailyAverageFormatted = null): mixed
```

**Parameters:**

| Parameter                | Type        | Description |
|--------------------------|-------------|-------------|
| `$title`                 | **?string** |             |
| `$type`                  | **?bool**   |             |
| `$currentUsage`          | **?float**  |             |
| `$currentUsageFormatted` | **?string** |             |
| `$notCharged`            | **?bool**   |             |
| `$freeQuantity`          | **?float**  |             |
| `$freeQuantityFormatted` | **?string** |             |
| `$dailyAverage`          | **?float**  |             |
| `$dailyAverageFormatted` | **?string** |             |

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

### getTitle

The title of the usage group.

```php
public getTitle(): ?string
```

***

### getType

The usage group type.

```php
public getType(): ?bool
```

***

### getCurrentUsage

The value of current usage for the group.

```php
public getCurrentUsage(): ?float
```

***

### getCurrentUsageFormatted

The formatted value of current usage for the group.

```php
public getCurrentUsageFormatted(): ?string
```

***

### getNotCharged

Whether the group is not charged for the subscription.

```php
public getNotCharged(): ?bool
```

***

### getFreeQuantity

The amount of free usage for the group.

```php
public getFreeQuantity(): ?float
```

***

### getFreeQuantityFormatted

The formatted amount of free usage for the group.

```php
public getFreeQuantityFormatted(): ?string
```

***

### getDailyAverage

The daily average usage calculated for the group.

```php
public getDailyAverage(): ?float
```

***

### getDailyAverageFormatted

The formatted daily average usage calculated for the group.

```php
public getDailyAverageFormatted(): ?string
```

***
