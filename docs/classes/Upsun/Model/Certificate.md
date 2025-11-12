# Certificate

Low level Certificate (auto-generated)

***

* Full name: `\Upsun\Model\Certificate`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### certificate

```php
private string $certificate
```

***

### chain

```php
private array $chain
```

***

### isProvisioned

```php
private bool $isProvisioned
```

***

### isInvalid

```php
private bool $isInvalid
```

***

### isRoot

```php
private bool $isRoot
```

***

### domains

```php
private array $domains
```

***

### authType

```php
private array $authType
```

***

### issuer

```php
private array $issuer
```

***

### expiresAt

```php
private \DateTime $expiresAt
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
public __construct(string $id, string $certificate, array $chain, bool $isProvisioned, bool $isInvalid, bool $isRoot, array $domains, array $authType, array $issuer, \DateTime $expiresAt, ?\DateTime $createdAt, ?\DateTime $updatedAt): mixed
```

**Parameters:**

| Parameter        | Type           | Description |
|------------------|----------------|-------------|
| `$id`            | **string**     |             |
| `$certificate`   | **string**     |             |
| `$chain`         | **array**      |             |
| `$isProvisioned` | **bool**       |             |
| `$isInvalid`     | **bool**       |             |
| `$isRoot`        | **bool**       |             |
| `$domains`       | **array**      |             |
| `$authType`      | **array**      |             |
| `$issuer`        | **array**      |             |
| `$expiresAt`     | **\DateTime**  |             |
| `$createdAt`     | **?\DateTime** |             |
| `$updatedAt`     | **?\DateTime** |             |

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

The identifier of Certificate

```php
public getId(): string
```

***

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getCertificate

The PEM-encoded certificate

```php
public getCertificate(): string
```

***

### getChain

```php
public getChain(): array
```

***

### getIsProvisioned

Whether this certificate is automatically provisioned

```php
public getIsProvisioned(): bool
```

***

### getIsInvalid

Whether this certificate should be skipped during provisioning

```php
public getIsInvalid(): bool
```

***

### getIsRoot

Whether this certificate is root type

```php
public getIsRoot(): bool
```

***

### getDomains

```php
public getDomains(): array
```

***

### getAuthType

```php
public getAuthType(): array
```

***

### getIssuer

The issuer of the certificate

```php
public getIssuer(): \Upsun\Model\IssuerInner[]
```

***

### getExpiresAt

Expiration date

```php
public getExpiresAt(): \DateTime
```

***
