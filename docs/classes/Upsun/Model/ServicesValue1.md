# ServicesValue1

Low level ServicesValue1 (auto-generated)

***

* Full name: `\Upsun\Model\ServicesValue1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### resources

```php
private ?\Upsun\Model\Resources1 $resources
```

***

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

## Methods

### __construct

```php
public __construct(?\Upsun\Model\Resources1 $resources, ?int $instanceCount, ?int $disk): mixed
```

**Parameters:**

| Parameter        | Type                         | Description |
|------------------|------------------------------|-------------|
| `$resources`     | **?\Upsun\Model\Resources1** |             |
| `$instanceCount` | **?int**                     |             |
| `$disk`          | **?int**                     |             |

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
public getResources(): ?\Upsun\Model\Resources1
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
