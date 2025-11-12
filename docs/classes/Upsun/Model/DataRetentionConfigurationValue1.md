# DataRetentionConfigurationValue1

Low level DataRetentionConfigurationValue1 (auto-generated)

***

* Full name: `\Upsun\Model\DataRetentionConfigurationValue1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### defaultConfig

```php
private \Upsun\Model\DefaultConfig1 $defaultConfig
```

***

### maxBackups

```php
private ?int $maxBackups
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Model\DefaultConfig1 $defaultConfig, ?int $maxBackups = null): mixed
```

**Parameters:**

| Parameter        | Type                            | Description |
|------------------|---------------------------------|-------------|
| `$defaultConfig` | **\Upsun\Model\DefaultConfig1** |             |
| `$maxBackups`    | **?int**                        |             |

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

### getDefaultConfig

```php
public getDefaultConfig(): \Upsun\Model\DefaultConfig1
```

***

### getMaxBackups

```php
public getMaxBackups(): ?int
```

***
