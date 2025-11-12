# AutoscalerTriggers

Low level AutoscalerTriggers (auto-generated)

Scaling triggers settings

***

* Full name: `\Upsun\Model\AutoscalerTriggers`
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

### cpuPressure

```php
private ?array $cpuPressure
```

***

### memoryPressure

```php
private ?array $memoryPressure
```

***

## Methods

### __construct

```php
public __construct(?array $cpu = [], ?array $memory = [], ?array $cpuPressure = [], ?array $memoryPressure = []): mixed
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$cpu`            | **?array** |             |
| `$memory`         | **?array** |             |
| `$cpuPressure`    | **?array** |             |
| `$memoryPressure` | **?array** |             |

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

Settings for scaling based on CPU usage

```php
public getCpu(): \Upsun\Model\AutoscalerCPUTrigger[]|null
```

***

### getMemory

Settings for scaling based on Memory usage

```php
public getMemory(): \Upsun\Model\AutoscalerMemoryTrigger[]|null
```

***

### getCpuPressure

Settings for scaling based on CPU pressure

```php
public getCpuPressure(): \Upsun\Model\AutoscalerCPUPressureTrigger[]|null
```

***

### getMemoryPressure

Settings for scaling based on Memory pressure

```php
public getMemoryPressure(): \Upsun\Model\AutoscalerMemoryPressureTrigger[]|null
```

***
