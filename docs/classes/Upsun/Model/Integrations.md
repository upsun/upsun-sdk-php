# Integrations

Low level Integrations (auto-generated)

***

* Full name: `\Upsun\Model\Integrations`
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

### config

```php
private ?\Upsun\Model\Config $config
```

***

### allowedIntegrations

```php
private ?array $allowedIntegrations
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, ?\Upsun\Model\Config $config = null, ?array $allowedIntegrations = []): mixed
```

**Parameters:**

| Parameter              | Type                     | Description |
|------------------------|--------------------------|-------------|
| `$enabled`             | **bool**                 |             |
| `$config`              | **?\Upsun\Model\Config** |             |
| `$allowedIntegrations` | **?array**               |             |

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

If true, integrations can be used

```php
public getEnabled(): bool
```

***

### getConfig

```php
public getConfig(): ?\Upsun\Model\Config
```

***

### getAllowedIntegrations

```php
public getAllowedIntegrations(): ?array
```

***
