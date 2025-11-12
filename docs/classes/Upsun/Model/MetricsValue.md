# MetricsValue

Low level MetricsValue (auto-generated)

***

* Full name: `\Upsun\Model\MetricsValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### value

```php
private ?mixed $value
```

***

### startTime

```php
private ?mixed $startTime
```

***

## Methods

### __construct

```php
public __construct(?mixed $value = null, ?mixed $startTime = null): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$value`     | **?mixed** |             |
| `$startTime` | **?mixed** |             |

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

### getValue

The measured value of the metric for the given time interval.

```php
public getValue(): ?mixed
```

***

### getStartTime

The timestamp at which the time interval began.

```php
public getStartTime(): ?mixed
```

***
