# OrganizationSSOConfig

Low level OrganizationSSOConfig (auto-generated)

The SSO configuration for the organization.

***

* Full name: `\Upsun\Model\OrganizationSSOConfig`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### providerType

```php
private ?string $providerType
```

***

### domain

```php
private ?string $domain
```

***

### organizationId

```php
private ?string $organizationId
```

***

### enforced

```php
private ?bool $enforced
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
public __construct(?string $providerType = null, ?string $domain = null, ?string $organizationId = null, ?bool $enforced = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$providerType`   | **?string**    |             |
| `$domain`         | **?string**    |             |
| `$organizationId` | **?string**    |             |
| `$enforced`       | **?bool**      |             |
| `$createdAt`      | **?\DateTime** |             |
| `$updatedAt`      | **?\DateTime** |             |

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

### getProviderType

SSO provider type.

```php
public getProviderType(): ?string
```

***

### getDomain

Google hosted domain.

```php
public getDomain(): ?string
```

***

### getOrganizationId

Organization ID.

```php
public getOrganizationId(): ?string
```

***

### getEnforced

Whether the configuration is enforced for all the organization members.

```php
public getEnforced(): ?bool
```

***

### getCreatedAt

The date and time when the SSO configuration was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the SSO configuration was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***
