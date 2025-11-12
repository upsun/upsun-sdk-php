# AutoscalerInstances

Low level AutoscalerInstances (auto-generated)

Horizontal scaling settings

***

* Full name: `\Upsun\Model\AutoscalerInstances`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### min

```php
private ?int $min
```

***

### max

```php
private ?int $max
```

***

## Methods

### __construct

```php
public __construct(?int $min = null, ?int $max = null): mixed
```

**Parameters:**

| Parameter | Type     | Description |
|-----------|----------|-------------|
| `$min`    | **?int** |             |
| `$max`    | **?int** |             |

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

### getMin

Minimum number of instances when scaling down horizontally

```php
public getMin(): ?int
```

***

### getMax

Maximum number of instances when scaling up horizontally

```php
public getMax(): ?int
```

***
