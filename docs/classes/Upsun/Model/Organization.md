# Organization

Low level Organization (auto-generated)

***

* Full name: `\Upsun\Model\Organization`
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

### namespace

```php
private ?string $namespace
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

### country

```php
private ?string $country
```

***

### capabilities

```php
private ?array $capabilities
```

***

### vendor

```php
private ?string $vendor
```

***

### billingAccountId

```php
private ?string $billingAccountId
```

***

### billingLegacy

```php
private ?bool $billingLegacy
```

***

### status

```php
private ?string $status
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

### links

```php
private ?\Upsun\Model\OrganizationLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $type = null, ?string $ownerId = null, ?string $namespace = null, ?string $name = null, ?string $label = null, ?string $country = null, ?array $capabilities = [], ?string $vendor = null, ?string $billingAccountId = null, ?bool $billingLegacy = null, ?string $status = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\OrganizationLinks $links = null): mixed
```

**Parameters:**

| Parameter           | Type                                | Description |
|---------------------|-------------------------------------|-------------|
| `$id`               | **?string**                         |             |
| `$type`             | **?string**                         |             |
| `$ownerId`          | **?string**                         |             |
| `$namespace`        | **?string**                         |             |
| `$name`             | **?string**                         |             |
| `$label`            | **?string**                         |             |
| `$country`          | **?string**                         |             |
| `$capabilities`     | **?array**                          |             |
| `$vendor`           | **?string**                         |             |
| `$billingAccountId` | **?string**                         |             |
| `$billingLegacy`    | **?bool**                           |             |
| `$status`           | **?string**                         |             |
| `$createdAt`        | **?\DateTime**                      |             |
| `$updatedAt`        | **?\DateTime**                      |             |
| `$links`            | **?\Upsun\Model\OrganizationLinks** |             |

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

### getNamespace

The namespace in which the organization name is unique.

```php
public getNamespace(): ?string
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

### getCountry

The organization country (2-letter country code).

```php
public getCountry(): ?string
```

***

### getCapabilities

```php
public getCapabilities(): ?array
```

***

### getVendor

The vendor.

```php
public getVendor(): ?string
```

***

### getBillingAccountId

The Billing Account ID.

```php
public getBillingAccountId(): ?string
```

***

### getBillingLegacy

Whether the account is billed with the legacy system.

```php
public getBillingLegacy(): ?bool
```

***

### getStatus

The status of the organization.

```php
public getStatus(): ?string
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

### getLinks

```php
public getLinks(): ?\Upsun\Model\OrganizationLinks
```

***
