# DiskResources

Low level DiskResources (auto-generated)

***

* Full name: `\Upsun\Model\DiskResources`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### temporary

```php
private ?int $temporary
```

***

### instance

```php
private ?int $instance
```

***

### storage

```php
private ?int $storage
```

***

## Methods

### __construct

```php
public __construct(?int $temporary, ?int $instance, ?int $storage): mixed
```

**Parameters:**

| Parameter    | Type     | Description |
|--------------|----------|-------------|
| `$temporary` | **?int** |             |
| `$instance`  | **?int** |             |
| `$storage`   | **?int** |             |

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

### getTemporary

```php
public getTemporary(): ?int
```

***

### getInstance

```php
public getInstance(): ?int
```

***

### getStorage

```php
public getStorage(): ?int
```

***
