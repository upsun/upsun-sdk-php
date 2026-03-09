# SourceCodeConfiguration

Low level SourceCodeConfiguration (auto-generated)

***

* Full name: `\Upsun\Model\SourceCodeConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### operations

```php
private array $operations
```

***

### root

```php
private ?string $root
```

***

## Methods

### __construct

```php
public __construct(array $operations, ?string $root): mixed
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$operations` | **array**   |             |
| `$root`       | **?string** |             |

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

### getRoot

```php
public getRoot(): ?string
```

***

### getOperations

```php
public getOperations(): \Upsun\Model\SourceOperationsValue[]
```

***
