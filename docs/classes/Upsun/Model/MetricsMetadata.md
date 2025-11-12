# MetricsMetadata

Low level MetricsMetadata (auto-generated)

***

* Full name: `\Upsun\Model\MetricsMetadata`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### from

```php
private ?mixed $from
```

***

### to

```php
private ?mixed $to
```

***

### interval

```php
private ?mixed $interval
```

***

### units

```php
private ?mixed $units
```

***

## Methods

### __construct

```php
public __construct(?mixed $from = null, ?mixed $to = null, ?mixed $interval = null, ?mixed $units = null): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$from`     | **?mixed** |             |
| `$to`       | **?mixed** |             |
| `$interval` | **?mixed** |             |
| `$units`    | **?mixed** |             |

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

### getFrom

The value used to calculate the lower bound of the temporal query. Inclusive.

```php
public getFrom(): ?mixed
```

***

### getTo

The truncated value used to calculate the upper bound of the temporal query. Exclusive.

```php
public getTo(): ?mixed
```

***

### getInterval

The interval used to group the metric values.

```php
public getInterval(): ?mixed
```

***

### getUnits

The units associated with the provided values.

```php
public getUnits(): ?mixed
```

***
