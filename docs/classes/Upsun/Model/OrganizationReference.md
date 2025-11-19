# OrganizationReference

Low level OrganizationReference (auto-generated)
The referenced organization, or null if it no longer exists.

***

* Full name: `\Upsun\Model\OrganizationReference`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
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

### label

```php
private ?string $label
```

***

### vendor

```php
private ?string $vendor
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $type = null, ?string $ownerId = null, ?string $name = null, ?string $label = null, ?string $vendor = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter    | Type           | Description |
|--------------|----------------|-------------|
| `$id`        | **?string**    |             |
| `$type`      | **?string**    |             |
| `$ownerId`   | **?string**    |             |
| `$name`      | **?string**    |             |
| `$label`     | **?string**    |             |
| `$vendor`    | **?string**    |             |
| `$createdAt` | **?\DateTime** |             |
| `$updatedAt` | **?\DateTime** |             |

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

### getId

The ID of the organization.

```php
public getId(): ?string
```

***

### getType

The type of the organization.

```php
public getType(): ?string
```

***

### getOwnerId

The ID of the owner.

```php
public getOwnerId(): ?string
```

***

### getName

A unique machine name representing the organization.

```php
public getName(): ?string
```

***

### getLabel

The human-readable label of the organization.

```php
public getLabel(): ?string
```

***

### getVendor

The vendor.

```php
public getVendor(): ?string
```

***

### getCreatedAt

The date and time when the organization was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the organization was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***
