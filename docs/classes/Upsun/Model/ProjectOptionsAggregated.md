# ProjectOptionsAggregated

Low level ProjectOptionsAggregated (auto-generated)

***

* Full name: `\Upsun\Model\ProjectOptionsAggregated`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### billing

```php
private ?object $billing
```

***

### defaults

```php
private ?object $defaults
```

***

### enforced

```php
private ?object $enforced
```

***

### initialize

```php
private ?object $initialize
```

***

### plans

```php
private ?array $plans
```

***

### regions

```php
private ?array $regions
```

***

### planTitles

```php
private ?array $planTitles
```

***

### sellables

```php
private ?array $sellables
```

***

### features

```php
private ?\Upsun\Model\AggregatedFeatures $features
```

***

### containerSizes

```php
private ?array $containerSizes
```

***

### debug

```php
private ?object $debug
```

***

## Methods

### __construct

```php
public __construct(?object $billing = null, ?object $defaults = null, ?object $enforced = null, ?object $initialize = null, ?array $plans = [], ?array $regions = [], ?array $planTitles = [], ?array $sellables = [], ?\Upsun\Model\AggregatedFeatures $features = null, ?array $containerSizes = [], ?object $debug = null): mixed
```

**Parameters:**

| Parameter         | Type                                 | Description |
|-------------------|--------------------------------------|-------------|
| `$billing`        | **?object**                          |             |
| `$defaults`       | **?object**                          |             |
| `$enforced`       | **?object**                          |             |
| `$initialize`     | **?object**                          |             |
| `$plans`          | **?array**                           |             |
| `$regions`        | **?array**                           |             |
| `$planTitles`     | **?array**                           |             |
| `$sellables`      | **?array**                           |             |
| `$features`       | **?\Upsun\Model\AggregatedFeatures** |             |
| `$containerSizes` | **?array**                           |             |
| `$debug`          | **?object**                          |             |

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

### getBilling

```php
public getBilling(): ?object
```

***

### getDefaults

```php
public getDefaults(): ?object
```

***

### getEnforced

```php
public getEnforced(): ?object
```

***

### getInitialize

```php
public getInitialize(): ?object
```

***

### getPlans

```php
public getPlans(): ?array
```

***

### getRegions

```php
public getRegions(): ?array
```

***

### getPlanTitles

```php
public getPlanTitles(): ?array
```

***

### getSellables

```php
public getSellables(): ?array
```

***

### getFeatures

```php
public getFeatures(): ?\Upsun\Model\AggregatedFeatures
```

***

### getContainerSizes

```php
public getContainerSizes(): ?array
```

***

### getDebug

Debug configuration.

```php
public getDebug(): ?object
```

***
