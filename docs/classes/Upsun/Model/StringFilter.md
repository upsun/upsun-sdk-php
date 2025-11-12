# StringFilter

Low level StringFilter (auto-generated)

***

* Full name: `\Upsun\Model\StringFilter`
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

### in

```php
private ?string $in
```

***

### nin

```php
private ?string $nin
```

***

### between

```php
private ?string $between
```

***

### contains

```php
private ?string $contains
```

***

### starts

```php
private ?string $starts
```

***

### ends

```php
private ?string $ends
```

***

## Methods

### __construct

```php
public __construct(?string $eq = null, ?string $ne = null, ?string $in = null, ?string $nin = null, ?string $between = null, ?string $contains = null, ?string $starts = null, ?string $ends = null): mixed
```

**Parameters:**

| Parameter   | Type        | Description |
|-------------|-------------|-------------|
| `$eq`       | **?string** |             |
| `$ne`       | **?string** |             |
| `$in`       | **?string** |             |
| `$nin`      | **?string** |             |
| `$between`  | **?string** |             |
| `$contains` | **?string** |             |
| `$starts`   | **?string** |             |
| `$ends`     | **?string** |             |

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

### getIn

In (comma-separated list)

```php
public getIn(): ?string
```

***

### getNin

Not in (comma-separated list)

```php
public getNin(): ?string
```

***

### getBetween

Between (comma-separated list)

```php
public getBetween(): ?string
```

***

### getContains

Contains

```php
public getContains(): ?string
```

***

### getStarts

Starts with

```php
public getStarts(): ?string
```

***

### getEnds

Ends with

```php
public getEnds(): ?string
```

***
