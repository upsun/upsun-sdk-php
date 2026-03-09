# EnvironmentVariablePatch

Low level EnvironmentVariablePatch (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentVariablePatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private ?string $name
```

***

### attributes

```php
private ?array $attributes
```

***

### value

```php
private ?string $value
```

***

### isJson

```php
private ?bool $isJson
```

***

### isSensitive

```php
private ?bool $isSensitive
```

***

### visibleBuild

```php
private ?bool $visibleBuild
```

***

### visibleRuntime

```php
private ?bool $visibleRuntime
```

***

### applicationScope

```php
private ?array $applicationScope
```

***

### isEnabled

```php
private ?bool $isEnabled
```

***

### isInheritable

```php
private ?bool $isInheritable
```

***

## Methods

### __construct

```php
public __construct(?string $name = null, ?array $attributes = [], ?string $value = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = [], ?bool $isEnabled = null, ?bool $isInheritable = null): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$name`             | **?string** |             |
| `$attributes`       | **?array**  |             |
| `$value`            | **?string** |             |
| `$isJson`           | **?bool**   |             |
| `$isSensitive`      | **?bool**   |             |
| `$visibleBuild`     | **?bool**   |             |
| `$visibleRuntime`   | **?bool**   |             |
| `$applicationScope` | **?array**  |             |
| `$isEnabled`        | **?bool**   |             |
| `$isInheritable`    | **?bool**   |             |

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

Name of the variable

```php
public getName(): ?string
```

***

### getAttributes

```php
public getAttributes(): ?array
```

***

### getValue

Value of the variable

```php
public getValue(): ?string
```

***

### getIsJson

The variable is a JSON string

```php
public getIsJson(): ?bool
```

***

### getIsSensitive

The variable is sensitive

```php
public getIsSensitive(): ?bool
```

***

### getVisibleBuild

The variable is visible during build

```php
public getVisibleBuild(): ?bool
```

***

### getVisibleRuntime

The variable is visible at runtime

```php
public getVisibleRuntime(): ?bool
```

***

### getApplicationScope

```php
public getApplicationScope(): ?array
```

***

### getIsEnabled

The variable is enabled on this environment

```php
public getIsEnabled(): ?bool
```

***

### getIsInheritable

The variable is inheritable to child environments

```php
public getIsInheritable(): ?bool
```

***
