# RuntimeOperations

Low level RuntimeOperations (auto-generated)

***

* Full name: `\Upsun\Model\RuntimeOperations`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private bool $enabled
```

***

## Methods

### __construct

```php
public __construct(bool $enabled): mixed
```

**Parameters:**

| Parameter  | Type     | Description |
|------------|----------|-------------|
| `$enabled` | **bool** |             |

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

### getEnabled

If true, runtime operations can be triggered.

```php
public getEnabled(): bool
```

***
