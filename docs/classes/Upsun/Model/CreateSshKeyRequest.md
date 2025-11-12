# CreateSshKeyRequest

Low level CreateSshKeyRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateSshKeyRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### value

```php
private string $value
```

***

### title

```php
private ?string $title
```

***

### uuid

```php
private ?string $uuid
```

***

## Methods

### __construct

```php
public __construct(string $value, ?string $title = null, ?string $uuid = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$value`  | **string**  |             |
| `$title`  | **?string** |             |
| `$uuid`   | **?string** |             |

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

### getValue

```php
public getValue(): string
```

***

### getTitle

```php
public getTitle(): ?string
```

***

### getUuid

```php
public getUuid(): ?string
```

***
