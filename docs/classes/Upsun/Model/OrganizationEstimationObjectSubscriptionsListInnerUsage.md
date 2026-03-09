# OrganizationEstimationObjectSubscriptionsListInnerUsage

Low level OrganizationEstimationObjectSubscriptionsListInnerUsage (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage`
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
private ?float $memory
```

***

### storage

```php
private ?float $storage
```

***

### environments

```php
private ?int $environments
```

***

## Methods

### __construct

```php
public __construct(?float $cpu = null, ?float $memory = null, ?float $storage = null, ?int $environments = null): mixed
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$cpu`          | **?float** |             |
| `$memory`       | **?float** |             |
| `$storage`      | **?float** |             |
| `$environments` | **?int**   |             |

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
public getMemory(): ?float
```

***

### getStorage

```php
public getStorage(): ?float
```

***

### getEnvironments

```php
public getEnvironments(): ?int
```

***
