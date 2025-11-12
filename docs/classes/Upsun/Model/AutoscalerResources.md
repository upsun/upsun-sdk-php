# AutoscalerResources

Low level AutoscalerResources (auto-generated)

Vertical scaling settings

***

* Full name: `\Upsun\Model\AutoscalerResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### cpu

```php
private ?array $cpu
```

***

### memory

```php
private ?array $memory
```

***

## Methods

### __construct

```php
public __construct(?array $cpu = [], ?array $memory = []): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$cpu`    | **?array** |             |
| `$memory` | **?array** |             |

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

Lower/Upper bounds on CPU allocation when scaling

```php
public getCpu(): \Upsun\Model\AutoscalerCPUResources[]|null
```

***

### getMemory

Lower/Upper bounds on Memory allocation when scaling

```php
public getMemory(): \Upsun\Model\AutoscalerMemoryResources[]|null
```

***
