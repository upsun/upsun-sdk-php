# EnvironmentVariable

Low level EnvironmentVariable (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentVariable`
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

### project

```php
private string $project
```

***

### environment

```php
private string $environment
```

***

### inherited

```php
private bool $inherited
```

***

### isEnabled

```php
private bool $isEnabled
```

***

### isInheritable

```php
private bool $isInheritable
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
public __construct(string $id, string $name, array $attributes, bool $isJson, bool $isSensitive, bool $visibleBuild, bool $visibleRuntime, array $applicationScope, string $project, string $environment, bool $inherited, bool $isEnabled, bool $isInheritable, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $value = null): mixed
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
| `$project`          | **string**     |             |
| `$environment`      | **string**     |             |
| `$inherited`        | **bool**       |             |
| `$isEnabled`        | **bool**       |             |
| `$isInheritable`    | **bool**       |             |
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

The identifier of EnvironmentVariable

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

### getProject

The name of the project

```php
public getProject(): string
```

***

### getEnvironment

The name of the environment

```php
public getEnvironment(): string
```

***

### getInherited

The variable is inherited from a parent environment

```php
public getInherited(): bool
```

***

### getIsEnabled

The variable is enabled on this environment

```php
public getIsEnabled(): bool
```

***

### getIsInheritable

The variable is inheritable to child environments

```php
public getIsInheritable(): bool
```

***

### getValue

Value of the variable

```php
public getValue(): ?string
```

***
