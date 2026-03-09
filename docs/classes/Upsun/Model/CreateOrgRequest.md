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

## Constants

| Constant        | Visibility | Type | Value      |
|-----------------|------------|------|------------|
| `TYPE_FIXED`    | public     |      | 'fixed'    |
| `TYPE_FLEXIBLE` | public     |      | 'flexible' |

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

### securityContact

```php
private ?string $securityContact
```

***

## Methods

### __construct

```php
public __construct(string $label, ?string $type = null, ?string $ownerId = null, ?string $name = null, ?string $country = null, ?string $securityContact = null): mixed
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$label`           | **string**  |             |
| `$type`            | **?string** |             |
| `$ownerId`         | **?string** |             |
| `$name`            | **?string** |             |
| `$country`         | **?string** |             |
| `$securityContact` | **?string** |             |

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

### getSecurityContact

```php
public getSecurityContact(): ?string
```

***
