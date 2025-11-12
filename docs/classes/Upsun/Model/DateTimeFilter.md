# DateTimeFilter

Low level DateTimeFilter (auto-generated)

***

* Full name: `\Upsun\Model\DateTimeFilter`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### eq

```php
private ?string $eq
```

***

### ne

```php
private ?string $ne
```

***

### between

```php
private ?string $between
```

***

### gt

```php
private ?string $gt
```

***

### gte

```php
private ?string $gte
```

***

### lt

```php
private ?string $lt
```

***

### lte

```php
private ?string $lte
```

***

## Methods

### __construct

```php
public __construct(?string $eq = null, ?string $ne = null, ?string $between = null, ?string $gt = null, ?string $gte = null, ?string $lt = null, ?string $lte = null): mixed
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$eq`      | **?string** |             |
| `$ne`      | **?string** |             |
| `$between` | **?string** |             |
| `$gt`      | **?string** |             |
| `$gte`     | **?string** |             |
| `$lt`      | **?string** |             |
| `$lte`     | **?string** |             |

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

### getEq

Equal

```php
public getEq(): ?string
```

***

### getNe

Not equal

```php
public getNe(): ?string
```

***

### getBetween

Between (comma-separated list)

```php
public getBetween(): ?string
```

***

### getGt

Greater than

```php
public getGt(): ?string
```

***

### getGte

Greater than or equal

```php
public getGte(): ?string
```

***

### getLt

Less than

```php
public getLt(): ?string
```

***

### getLte

Less than or equal

```php
public getLte(): ?string
```

***
