# ImageTypeRestrictions

Low level ImageTypeRestrictions (auto-generated)
Restricted and denied image types

***

* Full name: `\Upsun\Model\ImageTypeRestrictions`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### only

```php
private ?array $only
```

***

### exclude

```php
private ?array $exclude
```

***

## Methods

### __construct

```php
public __construct(?array $only = [], ?array $exclude = []): mixed
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$only`    | **?array** |             |
| `$exclude` | **?array** |             |

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

### getOnly

```php
public getOnly(): ?array
```

***

### getExclude

```php
public getExclude(): ?array
```

***
