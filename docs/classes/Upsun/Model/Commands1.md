# Commands1

Low level Commands1 (auto-generated)

***

* Full name: `\Upsun\Model\Commands1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### preStart

```php
private ?string $preStart
```

***

### start

```php
private ?string $start
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
public __construct(?string $preStart = null, ?string $start = null, ?string $postStart = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$preStart`  | **?string** |             |
| `$start`     | **?string** |             |
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

### getPreStart

```php
public getPreStart(): ?string
```

***

### getStart

```php
public getStart(): ?string
```

***

### getPostStart

```php
public getPostStart(): ?string
```

***
