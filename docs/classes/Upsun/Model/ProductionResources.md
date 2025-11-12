# ProductionResources

Low level ProductionResources (auto-generated)

Resources for production environments

***

* Full name: `\Upsun\Model\ProductionResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### legacyDevelopment

```php
private bool $legacyDevelopment
```

***

### maxCpu

```php
private ?float $maxCpu
```

***

### maxMemory

```php
private ?int $maxMemory
```

***

### maxEnvironments

```php
private ?int $maxEnvironments
```

***

## Methods

### __construct

```php
public __construct(bool $legacyDevelopment, ?float $maxCpu, ?int $maxMemory, ?int $maxEnvironments): mixed
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$legacyDevelopment` | **bool**   |             |
| `$maxCpu`            | **?float** |             |
| `$maxMemory`         | **?int**   |             |
| `$maxEnvironments`   | **?int**   |             |

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

### getLegacyDevelopment

Enable legacy development sizing for this environment type.

```php
public getLegacyDevelopment(): bool
```

***

### getMaxCpu

Maximum number of allocated CPU units.

```php
public getMaxCpu(): ?float
```

***

### getMaxMemory

Maximum amount of allocated RAM.

```php
public getMaxMemory(): ?int
```

***

### getMaxEnvironments

Maximum number of environments

```php
public getMaxEnvironments(): ?int
```

***
