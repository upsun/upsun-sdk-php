# Commands2

Low level Commands2 (auto-generated)

***

* Full name: `\Upsun\Model\Commands2`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### start

```php
private string $start
```

***

### preStart

```php
private ?string $preStart
```

***

### postStart

```php
private ?string $postStart
```

***

## Methods

### __construct

```php
public __construct(string $start, ?string $preStart = null, ?string $postStart = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$start`     | **string**  |             |
| `$preStart`  | **?string** |             |
| `$postStart` | **?string** |             |

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

### getStart

```php
public getStart(): string
```

***

### getPreStart

```php
public getPreStart(): ?string
```

***

### getPostStart

```php
public getPostStart(): ?string
```

***
