# ProjectOptionsEnforced

Low level ProjectOptionsEnforced (auto-generated)
The enforced values applied to the project.

***

* Full name: `\Upsun\Model\ProjectOptionsEnforced`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### settings

```php
private ?object $settings
```

***

### capabilities

```php
private ?object $capabilities
```

***

## Methods

### __construct

```php
public __construct(?object $settings = null, ?object $capabilities = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$settings`     | **?object** |             |
| `$capabilities` | **?object** |             |

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

### getSettings

The project settings.

```php
public getSettings(): ?object
```

***

### getCapabilities

The project capabilities.

```php
public getCapabilities(): ?object
```

***
