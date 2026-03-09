# MinimumResources

Low level MinimumResources (auto-generated)

***

* Full name: `\Upsun\Model\MinimumResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant              | Visibility | Type | Value        |
|-----------------------|------------|------|--------------|
| `CPU_TYPE_GUARANTEED` | public     |      | 'guaranteed' |
| `CPU_TYPE_SHARED`     | public     |      | 'shared'     |

## Properties

### cpu

```php
private float $cpu
```

***

### memory

```php
private int $memory
```

***

### cpuType

```php
private string $cpuType
```

***

### disk

```php
private ?int $disk
```

***

### profileSize

```php
private ?string $profileSize
```

***

## Methods

### __construct

```php
public __construct(float $cpu, int $memory, string $cpuType, ?int $disk, ?string $profileSize): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$cpu`         | **float**   |             |
| `$memory`      | **int**     |             |
| `$cpuType`     | **string**  |             |
| `$disk`        | **?int**    |             |
| `$profileSize` | **?string** |             |

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
public getCpu(): float
```

***

### getMemory

```php
public getMemory(): int
```

***

### getCpuType

```php
public getCpuType(): string
```

***

### getDisk

```php
public getDisk(): ?int
```

***

### getProfileSize

```php
public getProfileSize(): ?string
```

***
