# RouterResources

Low level RouterResources (auto-generated)

Router resource settings for flex plan

***

* Full name: `\Upsun\Model\RouterResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### baselineCpu

```php
private float $baselineCpu
```

***

### baselineMemory

```php
private int $baselineMemory
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
public __construct(float $baselineCpu, int $baselineMemory, float $maxCpu, int $maxMemory): mixed
```

**Parameters:**

| Parameter         | Type      | Description |
|-------------------|-----------|-------------|
| `$baselineCpu`    | **float** |             |
| `$baselineMemory` | **int**   |             |
| `$maxCpu`         | **float** |             |
| `$maxMemory`      | **int**   |             |

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

### getBaselineCpu

Router baseline CPU for flex plan

```php
public getBaselineCpu(): float
```

***

### getBaselineMemory

Router baseline memory (MB) for flex plan

```php
public getBaselineMemory(): int
```

***

### getMaxCpu

Router max CPU for flex plan

```php
public getMaxCpu(): float
```

***

### getMaxMemory

Router max memory (MB) for flex plan

```php
public getMaxMemory(): int
```

***
