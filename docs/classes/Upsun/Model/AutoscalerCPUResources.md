# AutoscalerCPUResources

Low level AutoscalerCPUResources (auto-generated)
CPU scaling settings

***

* Full name: `\Upsun\Model\AutoscalerCPUResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### min

```php
private ?float $min
```

***

### max

```php
private ?float $max
```

***

## Methods

### __construct

```php
public __construct(?float $min = null, ?float $max = null): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$min`    | **?float** |             |
| `$max`    | **?float** |             |

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

Minimum CPUs when scaling down vertically

```php
public getMin(): ?float
```

***

### getMax

Maximum CPUs when scaling up vertically

```php
public getMax(): ?float
```

***
