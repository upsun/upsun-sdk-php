# BuildResources2

Low level BuildResources2 (auto-generated)

***

* Full name: `\Upsun\Model\BuildResources2`
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

## Methods

### __construct

```php
public __construct(?float $cpu = null, ?int $memory = null): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$cpu`    | **?float** |             |
| `$memory` | **?int**   |             |

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
