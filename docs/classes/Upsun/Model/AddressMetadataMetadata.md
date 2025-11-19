# AddressMetadataMetadata

Low level AddressMetadataMetadata (auto-generated)
Address field metadata.

***

* Full name: `\Upsun\Model\AddressMetadataMetadata`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### requiredFields

```php
private ?array $requiredFields
```

***

### fieldLabels

```php
private ?object $fieldLabels
```

***

### showVat

```php
private ?bool $showVat
```

***

## Methods

### __construct

```php
public __construct(?array $requiredFields = [], ?object $fieldLabels = null, ?bool $showVat = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$requiredFields` | **?array**  |             |
| `$fieldLabels`    | **?object** |             |
| `$showVat`        | **?bool**   |             |

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

### getRequiredFields

```php
public getRequiredFields(): ?array
```

***

### getFieldLabels

Localized labels for address fields.

```php
public getFieldLabels(): ?object
```

***

### getShowVat

Whether this country supports a VAT number.

```php
public getShowVat(): ?bool
```

***
