# AutoscalerCondition

Low level AutoscalerCondition (auto-generated)
Trigger condition settings

***

* Full name: `\Upsun\Model\AutoscalerCondition`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### threshold

```php
private float $threshold
```

***

### enabled

```php
private ?bool $enabled
```

***

### duration

```php
private ?\Upsun\Model\AutoscalerDuration $duration
```

***

## Methods

### __construct

```php
public __construct(float $threshold, ?bool $enabled = null, ?\Upsun\Model\AutoscalerDuration $duration = null): mixed
```

**Parameters:**

| Parameter    | Type                                 | Description |
|--------------|--------------------------------------|-------------|
| `$threshold` | **float**                            |             |
| `$enabled`   | **?bool**                            |             |
| `$duration`  | **?\Upsun\Model\AutoscalerDuration** |             |

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

### getThreshold

Value at which the condition is satisfied

```php
public getThreshold(): float
```

***

### getDuration

```php
public getDuration(): ?\Upsun\Model\AutoscalerDuration
```

***

### getEnabled

Whether the condition should be used for generating alerts

```php
public getEnabled(): ?bool
```

***
