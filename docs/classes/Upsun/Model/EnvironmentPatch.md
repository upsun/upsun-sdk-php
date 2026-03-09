# EnvironmentPatch

Low level EnvironmentPatch (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant           | Visibility | Type | Value         |
|--------------------|------------|------|---------------|
| `TYPE_DEVELOPMENT` | public     |      | 'development' |
| `TYPE_PRODUCTION`  | public     |      | 'production'  |
| `TYPE_STAGING`     | public     |      | 'staging'     |

## Properties

### parent

```php
private ?string $parent
```

***

### name

```php
private ?string $name
```

***

### title

```php
private ?string $title
```

***

### attributes

```php
private ?array $attributes
```

***

### type

```php
private ?string $type
```

***

### cloneParentOnCreate

```php
private ?bool $cloneParentOnCreate
```

***

### httpAccess

```php
private ?\Upsun\Model\HttpAccessPermissions2 $httpAccess
```

***

### enableSmtp

```php
private ?bool $enableSmtp
```

***

### restrictRobots

```php
private ?bool $restrictRobots
```

***

## Methods

### __construct

```php
public __construct(?string $parent = null, ?string $name = null, ?string $title = null, ?array $attributes = [], ?string $type = null, ?bool $cloneParentOnCreate = null, ?\Upsun\Model\HttpAccessPermissions2 $httpAccess = null, ?bool $enableSmtp = null, ?bool $restrictRobots = null): mixed
```

**Parameters:**

| Parameter              | Type                                     | Description |
|------------------------|------------------------------------------|-------------|
| `$parent`              | **?string**                              |             |
| `$name`                | **?string**                              |             |
| `$title`               | **?string**                              |             |
| `$attributes`          | **?array**                               |             |
| `$type`                | **?string**                              |             |
| `$cloneParentOnCreate` | **?bool**                                |             |
| `$httpAccess`          | **?\Upsun\Model\HttpAccessPermissions2** |             |
| `$enableSmtp`          | **?bool**                                |             |
| `$restrictRobots`      | **?bool**                                |             |

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

The name of the environment

```php
public getName(): ?string
```

***

### getTitle

The title of the environment

```php
public getTitle(): ?string
```

***

### getAttributes

```php
public getAttributes(): ?array
```

***

### getType

The type of environment (`production`, `staging` or `development`), if not provided, a default will be calculated

```php
public getType(): ?string
```

***

### getParent

The name of the parent environment

```php
public getParent(): ?string
```

***

### getCloneParentOnCreate

Clone data when creating that environment

```php
public getCloneParentOnCreate(): ?bool
```

***

### getHttpAccess

The Http access permissions for this environment

```php
public getHttpAccess(): ?\Upsun\Model\HttpAccessPermissions2
```

***

### getEnableSmtp

Whether to configure SMTP for this environment

```php
public getEnableSmtp(): ?bool
```

***

### getRestrictRobots

Whether to restrict robots for this environment

```php
public getRestrictRobots(): ?bool
```

***
