# EnvironmentVariablesInner

Low level EnvironmentVariablesInner (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentVariablesInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private string $name
```

***

### isSensitive

```php
private bool $isSensitive
```

***

### isJson

```php
private bool $isJson
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

### value

```php
private ?string $value
```

***

## Methods

### __construct

```php
public __construct(string $name, bool $isSensitive, bool $isJson, bool $visibleBuild, bool $visibleRuntime, ?string $value = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$name`           | **string**  |             |
| `$isSensitive`    | **bool**    |             |
| `$isJson`         | **bool**    |             |
| `$visibleBuild`   | **bool**    |             |
| `$visibleRuntime` | **bool**    |             |
| `$value`          | **?string** |             |

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

### getName

```php
public getName(): string
```

***

### getIsSensitive

```php
public getIsSensitive(): bool
```

***

### getIsJson

```php
public getIsJson(): bool
```

***

### getVisibleBuild

```php
public getVisibleBuild(): bool
```

***

### getVisibleRuntime

```php
public getVisibleRuntime(): bool
```

***

### getValue

```php
public getValue(): ?string
```

***
