# GuaranteedResources

Low level GuaranteedResources (auto-generated)

***

* Full name: `\Upsun\Model\GuaranteedResources`
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

### instanceLimit

```php
private int $instanceLimit
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, int $instanceLimit): mixed
```

**Parameters:**

| Parameter        | Type     | Description |
|------------------|----------|-------------|
| `$enabled`       | **bool** |             |
| `$instanceLimit` | **int**  |             |

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

If true, guaranteed resources can be used

```php
public getEnabled(): bool
```

***

### getInstanceLimit

Instance limit for guaranteed resources

```php
public getInstanceLimit(): int
```

***
