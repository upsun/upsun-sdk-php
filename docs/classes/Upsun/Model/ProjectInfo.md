# ProjectInfo

Low level ProjectInfo (auto-generated)

The project information

***

* Full name: `\Upsun\Model\ProjectInfo`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### title

```php
private string $title
```

***

### name

```php
private string $name
```

***

### capabilities

```php
private object $capabilities
```

***

### settings

```php
private object $settings
```

***

### namespace

```php
private ?string $namespace
```

***

### organization

```php
private ?string $organization
```

***

## Methods

### __construct

```php
public __construct(string $title, string $name, object $capabilities, object $settings, ?string $namespace, ?string $organization): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$title`        | **string**  |             |
| `$name`         | **string**  |             |
| `$capabilities` | **object**  |             |
| `$settings`     | **object**  |             |
| `$namespace`    | **?string** |             |
| `$organization` | **?string** |             |

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

### getTitle

```php
public getTitle(): string
```

***

### getName

```php
public getName(): string
```

***

### getNamespace

```php
public getNamespace(): ?string
```

***

### getOrganization

```php
public getOrganization(): ?string
```

***

### getCapabilities

```php
public getCapabilities(): object
```

***

### getSettings

```php
public getSettings(): object
```

***
