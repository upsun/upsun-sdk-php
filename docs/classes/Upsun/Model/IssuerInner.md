# IssuerInner

Low level IssuerInner (auto-generated)

***

* Full name: `\Upsun\Model\IssuerInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### oid

```php
private string $oid
```

***

### value

```php
private string $value
```

***

### alias

```php
private ?string $alias
```

***

## Methods

### __construct

```php
public __construct(string $oid, string $value, ?string $alias): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$oid`    | **string**  |             |
| `$value`  | **string**  |             |
| `$alias`  | **?string** |             |

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

### getOid

```php
public getOid(): string
```

***

### getAlias

```php
public getAlias(): ?string
```

***

### getValue

```php
public getValue(): string
```

***
