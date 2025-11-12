# ResourcesLimits

Low level ResourcesLimits (auto-generated)

Resources limits

***

* Full name: `\Upsun\Model\ResourcesLimits`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### containerProfiles

```php
private bool $containerProfiles
```

***

### production

```php
private \Upsun\Model\ProductionResources $production
```

***

### development

```php
private \Upsun\Model\DevelopmentResources $development
```

***

## Methods

### __construct

```php
public __construct(bool $containerProfiles, \Upsun\Model\ProductionResources $production, \Upsun\Model\DevelopmentResources $development): mixed
```

**Parameters:**

| Parameter            | Type                                  | Description |
|----------------------|---------------------------------------|-------------|
| `$containerProfiles` | **bool**                              |             |
| `$production`        | **\Upsun\Model\ProductionResources**  |             |
| `$development`       | **\Upsun\Model\DevelopmentResources** |             |

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

### getContainerProfiles

Enable support for customizable container profiles.

```php
public getContainerProfiles(): bool
```

***

### getProduction

Resources for production environments

```php
public getProduction(): \Upsun\Model\ProductionResources
```

***

### getDevelopment

Resources for development environments

```php
public getDevelopment(): \Upsun\Model\DevelopmentResources
```

***
