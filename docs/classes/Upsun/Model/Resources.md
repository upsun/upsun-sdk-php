# Resources

Low level Resources (auto-generated)

***

* Full name: `\Upsun\Model\Resources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### baseMemory

```php
private ?int $baseMemory
```

***

### memoryRatio

```php
private ?int $memoryRatio
```

***

### profileSize

```php
private ?string $profileSize
```

***

### minimum

```php
private ?\Upsun\Model\MinimumResources $minimum
```

***

### default

```php
private ?\Upsun\Model\DefaultResources $default
```

***

### disk

```php
private ?\Upsun\Model\DiskResources $disk
```

***

## Methods

### __construct

```php
public __construct(?int $baseMemory, ?int $memoryRatio, ?string $profileSize, ?\Upsun\Model\MinimumResources $minimum, ?\Upsun\Model\DefaultResources $default, ?\Upsun\Model\DiskResources $disk): mixed
```

**Parameters:**

| Parameter      | Type                               | Description |
|----------------|------------------------------------|-------------|
| `$baseMemory`  | **?int**                           |             |
| `$memoryRatio` | **?int**                           |             |
| `$profileSize` | **?string**                        |             |
| `$minimum`     | **?\Upsun\Model\MinimumResources** |             |
| `$default`     | **?\Upsun\Model\DefaultResources** |             |
| `$disk`        | **?\Upsun\Model\DiskResources**    |             |

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

### getBaseMemory

```php
public getBaseMemory(): ?int
```

***

### getMemoryRatio

```php
public getMemoryRatio(): ?int
```

***

### getProfileSize

```php
public getProfileSize(): ?string
```

***

### getMinimum

```php
public getMinimum(): ?\Upsun\Model\MinimumResources
```

***

### getDefault

```php
public getDefault(): ?\Upsun\Model\DefaultResources
```

***

### getDisk

```php
public getDisk(): ?\Upsun\Model\DiskResources
```

***
