# ProjectSettingsPatch

Low level ProjectSettingsPatch (auto-generated)

***

* Full name: `\Upsun\Model\ProjectSettingsPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### dataRetention

```php
private ?array $dataRetention
```

***

### initialize

```php
private ?object $initialize
```

***

### buildResources

```php
private ?\Upsun\Model\BuildResources2 $buildResources
```

***

## Methods

### __construct

```php
public __construct(?array $dataRetention = [], ?object $initialize = null, ?\Upsun\Model\BuildResources2 $buildResources = null): mixed
```

**Parameters:**

| Parameter         | Type                              | Description |
|-------------------|-----------------------------------|-------------|
| `$dataRetention`  | **?array**                        |             |
| `$initialize`     | **?object**                       |             |
| `$buildResources` | **?\Upsun\Model\BuildResources2** |             |

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

### getInitialize

```php
public getInitialize(): ?object
```

***

### getDataRetention

Data retention configuration

```php
public getDataRetention(): \Upsun\Model\DataRetentionConfigurationValue1[]|null
```

***

### getBuildResources

```php
public getBuildResources(): ?\Upsun\Model\BuildResources2
```

***
