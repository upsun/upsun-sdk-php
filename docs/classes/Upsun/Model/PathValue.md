# PathValue

Low level PathValue (auto-generated)

***

* Full name: `\Upsun\Model\PathValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant          | Visibility | Type | Value |
|-------------------|------------|------|-------|
| `CODE_NUMBER_301` | public     |      | 301   |
| `CODE_NUMBER_302` | public     |      | 302   |
| `CODE_NUMBER_307` | public     |      | 307   |
| `CODE_NUMBER_308` | public     |      | 308   |

## Properties

### regexp

```php
private bool $regexp
```

***

### to

```php
private string $to
```

***

### code

```php
private int $code
```

***

### prefix

```php
private ?bool $prefix
```

***

### appendSuffix

```php
private ?bool $appendSuffix
```

***

### expires

```php
private ?string $expires
```

***

## Methods

### __construct

```php
public __construct(bool $regexp, string $to, int $code, ?bool $prefix, ?bool $appendSuffix, ?string $expires): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$regexp`       | **bool**    |             |
| `$to`           | **string**  |             |
| `$code`         | **int**     |             |
| `$prefix`       | **?bool**   |             |
| `$appendSuffix` | **?bool**   |             |
| `$expires`      | **?string** |             |

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

### getRegexp

```php
public getRegexp(): bool
```

***

### getTo

```php
public getTo(): string
```

***

### getPrefix

```php
public getPrefix(): ?bool
```

***

### getAppendSuffix

```php
public getAppendSuffix(): ?bool
```

***

### getCode

```php
public getCode(): int
```

***

### getExpires

```php
public getExpires(): ?string
```

***
