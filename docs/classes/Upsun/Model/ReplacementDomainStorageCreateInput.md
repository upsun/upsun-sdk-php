# ReplacementDomainStorageCreateInput

Low level ReplacementDomainStorageCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\ReplacementDomainStorageCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private string $name
```

***

### attributes

```php
private ?array $attributes
```

***

### replacementFor

```php
private ?string $replacementFor
```

***

## Methods

### __construct

```php
public __construct(string $name, ?array $attributes = [], ?string $replacementFor = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$name`           | **string**  |             |
| `$attributes`     | **?array**  |             |
| `$replacementFor` | **?string** |             |

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

### getName

```php
public getName(): string
```

***

### getAttributes

```php
public getAttributes(): ?array
```

***

### getReplacementFor

Prod domain which will be replaced by this domain.

```php
public getReplacementFor(): ?string
```

***
