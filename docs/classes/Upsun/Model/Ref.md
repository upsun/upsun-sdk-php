# Ref

Low level Ref (auto-generated)

***

* Full name: `\Upsun\Model\Ref`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### ref

```php
private string $ref
```

***

### object

```php
private object $object
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
public __construct(string $id, string $ref, object $object, string $sha): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$id`     | **string** |             |
| `$ref`    | **string** |             |
| `$object` | **object** |             |
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

### getId

The identifier of Ref

```php
public getId(): string
```

***

### getRef

The name of the reference

```php
public getRef(): string
```

***

### getObject

The object the reference points to

```php
public getObject(): object
```

***

### getSha

The commit sha of the ref

```php
public getSha(): string
```

***
