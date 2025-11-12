# CertificateProvisionerPatch

Low level CertificateProvisionerPatch (auto-generated)

***

* Full name: `\Upsun\Model\CertificateProvisionerPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### eabKid

```php
private ?string $eabKid
```

***

### eabHmacKey

```php
private ?string $eabHmacKey
```

***

### directoryUrl

```php
private ?string $directoryUrl
```

***

### email

```php
private ?string $email
```

***

## Methods

### __construct

```php
public __construct(?string $eabKid = null, ?string $eabHmacKey = null, ?string $directoryUrl = null, ?string $email = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$eabKid`       | **?string** |             |
| `$eabHmacKey`   | **?string** |             |
| `$directoryUrl` | **?string** |             |
| `$email`        | **?string** |             |

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

### getDirectoryUrl

The URL to the ACME directory

```php
public getDirectoryUrl(): ?string
```

***

### getEmail

The email address for contact information

```php
public getEmail(): ?string
```

***

### getEabKid

The key identifier for Entity Attestation Binding

```php
public getEabKid(): ?string
```

***

### getEabHmacKey

The Keyed-'Hashing Message Authentication Code' for Entity Attestation Binding

```php
public getEabHmacKey(): ?string
```

***
