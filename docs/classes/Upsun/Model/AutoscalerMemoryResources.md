# AutoscalerMemoryResources

Low level AutoscalerMemoryResources (auto-generated)
Memory scaling settings

***

* Full name: `\Upsun\Model\AutoscalerMemoryResources`
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

Minimum memory (bytes) when scaling down vertically

```php
public getMin(): ?int
```

***

### getMax

Maximum memory (bytes) when scaling up vertically

```php
public getMax(): ?int
```

***
