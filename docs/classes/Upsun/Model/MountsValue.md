# MountsValue

Low level MountsValue (auto-generated)

***

* Full name: `\Upsun\Model\MountsValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant           | Visibility | Type | Value       |
|--------------------|------------|------|-------------|
| `SOURCE_INSTANCE`  | public     |      | 'instance'  |
| `SOURCE_LOCAL`     | public     |      | 'local'     |
| `SOURCE_SERVICE`   | public     |      | 'service'   |
| `SOURCE_STORAGE`   | public     |      | 'storage'   |
| `SOURCE_TEMPORARY` | public     |      | 'temporary' |
| `SOURCE_TMP`       | public     |      | 'tmp'       |

## Properties

### source

```php
private string $source
```

***

### sourcePath

```php
private string $sourcePath
```

***

### service

```php
private ?string $service
```

***

## Methods

### __construct

```php
public __construct(string $source, string $sourcePath, ?string $service = null): mixed
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$source`     | **string**  |             |
| `$sourcePath` | **string**  |             |
| `$service`    | **?string** |             |

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

### getSource

```php
public getSource(): string
```

***

### getSourcePath

```php
public getSourcePath(): string
```

***

### getService

```php
public getService(): ?string
```

***
