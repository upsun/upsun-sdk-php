# CreateOrgRequest

Low level CreateOrgRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateOrgRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### label

```php
private string $label
```

***

### type

```php
private ?string $type
```

***

### ownerId

```php
private ?string $ownerId
```

***

### name

```php
private ?string $name
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
public __construct(string $label, ?string $type = null, ?string $ownerId = null, ?string $name = null, ?string $country = null): mixed
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$label`   | **string**  |             |
| `$type`    | **?string** |             |
| `$ownerId` | **?string** |             |
| `$name`    | **?string** |             |
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

### getLabel

```php
public getLabel(): string
```

***

### getType

```php
public getType(): ?string
```

***

### getOwnerId

```php
public getOwnerId(): ?string
```

***

### getName

```php
public getName(): ?string
```

***

### getCountry

```php
public getCountry(): ?string
```

***
