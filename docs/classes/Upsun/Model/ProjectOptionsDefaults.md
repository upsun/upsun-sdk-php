# ProjectOptionsDefaults

Low level ProjectOptionsDefaults (auto-generated)

The initial values applied to the project.

***

* Full name: `\Upsun\Model\ProjectOptionsDefaults`
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

### variables

```php
private ?object $variables
```

***

### access

```php
private ?object $access
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
public __construct(?object $settings = null, ?object $variables = null, ?object $access = null, ?object $capabilities = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$settings`     | **?object** |             |
| `$variables`    | **?object** |             |
| `$access`       | **?object** |             |
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

### getVariables

The project variables.

```php
public getVariables(): ?object
```

***

### getAccess

The project access list.

```php
public getAccess(): ?object
```

***

### getCapabilities

The project capabilities.

```php
public getCapabilities(): ?object
```

***
