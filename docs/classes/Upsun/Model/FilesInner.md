# FilesInner

Low level FilesInner (auto-generated)

***

* Full name: `\Upsun\Model\FilesInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### path

```php
private string $path
```

***

### mode

```php
private int $mode
```

***

### contents

```php
private string $contents
```

***

## Methods

### __construct

```php
public __construct(string $path, int $mode, string $contents): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$path`     | **string** |             |
| `$mode`     | **int**    |             |
| `$contents` | **string** |             |

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

### getPath

```php
public getPath(): string
```

***

### getMode

```php
public getMode(): int
```

***

### getContents

```php
public getContents(): string
```

***
