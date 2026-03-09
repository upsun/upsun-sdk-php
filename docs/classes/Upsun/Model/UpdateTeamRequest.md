# UpdateTeamRequest

Low level UpdateTeamRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateTeamRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### label

```php
private ?string $label
```

***

### projectPermissions

```php
private ?array $projectPermissions
```

***

## Methods

### __construct

```php
public __construct(?string $label = null, ?array $projectPermissions = []): mixed
```

**Parameters:**

| Parameter             | Type        | Description |
|-----------------------|-------------|-------------|
| `$label`              | **?string** |             |
| `$projectPermissions` | **?array**  |             |

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

### getLabel

```php
public getLabel(): ?string
```

***

### getProjectPermissions

```php
public getProjectPermissions(): ?array
```

***
