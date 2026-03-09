# UpdateProjectsEnvironmentsDeploymentsNextRequestWorkersValue

Low level UpdateProjectsEnvironmentsDeploymentsNextRequestWorkersValue (auto-generated)

***

* Full name: `\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestWorkersValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### instanceCount

```php
private ?int $instanceCount
```

***

### disk

```php
private ?int $disk
```

***

### resources

```php
private ?\Upsun\Model\ResourceConfig $resources
```

***

## Methods

### __construct

```php
public __construct(?int $instanceCount = null, ?int $disk = null, ?\Upsun\Model\ResourceConfig $resources = null): mixed
```

**Parameters:**

| Parameter        | Type                             | Description |
|------------------|----------------------------------|-------------|
| `$instanceCount` | **?int**                         |             |
| `$disk`          | **?int**                         |             |
| `$resources`     | **?\Upsun\Model\ResourceConfig** |             |

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

### getResources

```php
public getResources(): ?\Upsun\Model\ResourceConfig
```

***

### getInstanceCount

```php
public getInstanceCount(): ?int
```

***

### getDisk

```php
public getDisk(): ?int
```

***
