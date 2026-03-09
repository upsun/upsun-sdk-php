# ProjectVariable

Low level ProjectVariable (auto-generated)

***

* Full name: `\Upsun\Model\ProjectVariable`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### name

```php
private string $name
```

***

### attributes

```php
private array $attributes
```

***

### isJson

```php
private bool $isJson
```

***

### isSensitive

```php
private bool $isSensitive
```

***

### visibleBuild

```php
private bool $visibleBuild
```

***

### visibleRuntime

```php
private bool $visibleRuntime
```

***

### applicationScope

```php
private array $applicationScope
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### value

```php
private ?string $value
```

***

## Methods

### __construct

```php
public __construct(string $id, string $name, array $attributes, bool $isJson, bool $isSensitive, bool $visibleBuild, bool $visibleRuntime, array $applicationScope, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $value = null): mixed
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$id`               | **string**     |             |
| `$name`             | **string**     |             |
| `$attributes`       | **array**      |             |
| `$isJson`           | **bool**       |             |
| `$isSensitive`      | **bool**       |             |
| `$visibleBuild`     | **bool**       |             |
| `$visibleRuntime`   | **bool**       |             |
| `$applicationScope` | **array**      |             |
| `$createdAt`        | **?\DateTime** |             |
| `$updatedAt`        | **?\DateTime** |             |
| `$value`            | **?string**    |             |

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

### getId

The identifier of ProjectVariable

```php
public getId(): string
```

***

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getName

Name of the variable

```php
public getName(): string
```

***

### getAttributes

```php
public getAttributes(): array
```

***

### getIsJson

The variable is a JSON string

```php
public getIsJson(): bool
```

***

### getIsSensitive

The variable is sensitive

```php
public getIsSensitive(): bool
```

***

### getVisibleBuild

The variable is visible during build

```php
public getVisibleBuild(): bool
```

***

### getVisibleRuntime

The variable is visible at runtime

```php
public getVisibleRuntime(): bool
```

***

### getApplicationScope

```php
public getApplicationScope(): array
```

***

### getValue

Value of the variable

```php
public getValue(): ?string
```

***
