# TreeItemsInner

Low level TreeItemsInner (auto-generated)

***

* Full name: `\Upsun\Model\TreeItemsInner`
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
private string $mode
```

***

### type

```php
private string $type
```

***

### sha

```php
private ?string $sha
```

***

## Methods

### __construct

```php
public __construct(string $path, string $mode, string $type, ?string $sha): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$path`   | **string**  |             |
| `$mode`   | **string**  |             |
| `$type`   | **string**  |             |
| `$sha`    | **?string** |             |

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
public getMode(): string
```

***

### getType

```php
public getType(): string
```

***

### getSha

```php
public getSha(): ?string
```

***
