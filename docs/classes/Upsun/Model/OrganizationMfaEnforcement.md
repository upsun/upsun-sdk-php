# OrganizationMfaEnforcement

Low level OrganizationMfaEnforcement (auto-generated)

The MFA enforcement for the organization.

***

* Full name: `\Upsun\Model\OrganizationMfaEnforcement`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enforceMfa

```php
private ?bool $enforceMfa
```

***

## Methods

### __construct

```php
public __construct(?bool $enforceMfa = null): mixed
```

**Parameters:**

| Parameter     | Type      | Description |
|---------------|-----------|-------------|
| `$enforceMfa` | **?bool** |             |

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

### getEnforceMfa

Whether the MFA enforcement is enabled.

```php
public getEnforceMfa(): ?bool
```

***
