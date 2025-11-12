# PreServiceResourcesOverridesValue

Low level PreServiceResourcesOverridesValue (auto-generated)

***

* Full name: `\Upsun\Model\PreServiceResourcesOverridesValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### cpu

```php
private ?float $cpu
```

***

### memory

```php
private ?int $memory
```

***

### disk

```php
private ?int $disk
```

***

## Methods

### __construct

```php
public __construct(?float $cpu, ?int $memory, ?int $disk): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$cpu`    | **?float** |             |
| `$memory` | **?int**   |             |
| `$disk`   | **?int**   |             |

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

### getCpu

```php
public getCpu(): ?float
```

***

### getMemory

```php
public getMemory(): ?int
```

***

### getDisk

```php
public getDisk(): ?int
```

***
