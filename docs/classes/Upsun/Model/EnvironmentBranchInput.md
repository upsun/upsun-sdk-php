# EnvironmentBranchInput

Low level EnvironmentBranchInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentBranchInput`
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
| `TYPE_STAGING`     | public     |      | 'staging'     |

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

### cloneParent

```php
private bool $cloneParent
```

***

### type

```php
private string $type
```

***

### resources

```php
private ?\Upsun\Model\Resources3 $resources
```

***

## Methods

### __construct

```php
public __construct(string $title, string $name, bool $cloneParent, string $type, ?\Upsun\Model\Resources3 $resources): mixed
```

**Parameters:**

| Parameter      | Type                         | Description |
|----------------|------------------------------|-------------|
| `$title`       | **string**                   |             |
| `$name`        | **string**                   |             |
| `$cloneParent` | **bool**                     |             |
| `$type`        | **string**                   |             |
| `$resources`   | **?\Upsun\Model\Resources3** |             |

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

### getCloneParent

Clone data from the parent environment

```php
public getCloneParent(): bool
```

***

### getType

The type of environment (`staging` or `development`)

```php
public getType(): string
```

***

### getResources

```php
public getResources(): ?\Upsun\Model\Resources3
```

***
