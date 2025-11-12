# BuildResources

Low level BuildResources (auto-generated)

***

* Full name: `\Upsun\Model\BuildResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private bool $enabled
```

***

### maxCpu

```php
private float $maxCpu
```

***

### maxMemory

```php
private int $maxMemory
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, float $maxCpu, int $maxMemory): mixed
```

**Parameters:**

| Parameter    | Type      | Description |
|--------------|-----------|-------------|
| `$enabled`   | **bool**  |             |
| `$maxCpu`    | **float** |             |
| `$maxMemory` | **int**   |             |

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

### getEnabled

If true, build resources can be modified.

```php
public getEnabled(): bool
```

***

### getMaxCpu

```php
public getMaxCpu(): float
```

***

### getMaxMemory

```php
public getMaxMemory(): int
```

***
