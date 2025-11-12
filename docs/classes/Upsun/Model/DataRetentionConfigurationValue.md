# DataRetentionConfigurationValue

Low level DataRetentionConfigurationValue (auto-generated)

***

* Full name: `\Upsun\Model\DataRetentionConfigurationValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### maxBackups

```php
private int $maxBackups
```

***

### defaultConfig

```php
private \Upsun\Model\DefaultConfig $defaultConfig
```

***

## Methods

### __construct

```php
public __construct(int $maxBackups, \Upsun\Model\DefaultConfig $defaultConfig): mixed
```

**Parameters:**

| Parameter        | Type                           | Description |
|------------------|--------------------------------|-------------|
| `$maxBackups`    | **int**                        |             |
| `$defaultConfig` | **\Upsun\Model\DefaultConfig** |             |

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

### getMaxBackups

```php
public getMaxBackups(): int
```

***

### getDefaultConfig

```php
public getDefaultConfig(): \Upsun\Model\DefaultConfig
```

***
