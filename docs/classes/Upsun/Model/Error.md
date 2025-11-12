# Error

Low level Error (auto-generated)

***

* Full name: `\Upsun\Model\Error`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### status

```php
private ?string $status
```

***

### message

```php
private ?string $message
```

***

### code

```php
private ?float $code
```

***

### detail

```php
private ?object $detail
```

***

### title

```php
private ?string $title
```

***

## Methods

### __construct

```php
public __construct(?string $status = null, ?string $message = null, ?float $code = null, ?object $detail = null, ?string $title = null): mixed
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$status`  | **?string** |             |
| `$message` | **?string** |             |
| `$code`    | **?float**  |             |
| `$detail`  | **?object** |             |
| `$title`   | **?string** |             |

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

### getStatus

```php
public getStatus(): ?string
```

***

### getMessage

```php
public getMessage(): ?string
```

***

### getCode

```php
public getCode(): ?float
```

***

### getDetail

```php
public getDetail(): ?object
```

***

### getTitle

```php
public getTitle(): ?string
```

***
