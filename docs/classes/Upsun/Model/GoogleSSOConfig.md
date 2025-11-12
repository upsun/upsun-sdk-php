# GoogleSSOConfig

Low level GoogleSSOConfig (auto-generated)

***

* Full name: `\Upsun\Model\GoogleSSOConfig`
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

## Methods

### __construct

```php
public __construct(?string $providerType = null, ?string $domain = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$providerType` | **?string** |             |
| `$domain`       | **?string** |             |

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
