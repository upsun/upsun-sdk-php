# UpdateOrgRequest

Low level UpdateOrgRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateOrgRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private ?string $name
```

***

### label

```php
private ?string $label
```

***

### country

```php
private ?string $country
```

***

## Methods

### __construct

```php
public __construct(?string $name = null, ?string $label = null, ?string $country = null): mixed
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$name`    | **?string** |             |
| `$label`   | **?string** |             |
| `$country` | **?string** |             |

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
public getName(): ?string
```

***

### getLabel

```php
public getLabel(): ?string
```

***

### getCountry

```php
public getCountry(): ?string
```

***
