# Blob

Low level Blob (auto-generated)

***

* Full name: `\Upsun\Model\Blob`
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

### sha

```php
private string $sha
```

***

### size

```php
private int $size
```

***

### encoding

```php
private string $encoding
```

***

### content

```php
private string $content
```

***

## Methods

### __construct

```php
public __construct(string $id, string $sha, int $size, string $encoding, string $content): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$id`       | **string** |             |
| `$sha`      | **string** |             |
| `$size`     | **int**    |             |
| `$encoding` | **string** |             |
| `$content`  | **string** |             |

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

The identifier of Blob

```php
public getId(): string
```

***

### getSha

The identifier of the tag

```php
public getSha(): string
```

***

### getSize

The size of the blob

```php
public getSize(): int
```

***

### getEncoding

The encoding of the contents

```php
public getEncoding(): string
```

***

### getContent

The contents

```php
public getContent(): string
```

***
