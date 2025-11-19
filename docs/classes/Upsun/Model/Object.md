# Object

Low level Object (auto-generated)
The object the reference points to

***

* Full name: `\Upsun\Model\Object`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### sha

```php
private string $sha
```

***

## Methods

### __construct

```php
public __construct(string $type, string $sha): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$type`   | **string** |             |
| `$sha`    | **string** |             |

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

### getType

The type of object pointed to

```php
public getType(): string
```

***

### getSha

```php
public getSha(): string
```

***
