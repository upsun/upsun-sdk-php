# CertificateProvisioner

Low level CertificateProvisioner (auto-generated)

***

* Full name: `\Upsun\Model\CertificateProvisioner`
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

### directoryUrl

```php
private string $directoryUrl
```

***

### email

```php
private string $email
```

***

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

## Methods

### __construct

```php
public __construct(string $id, string $directoryUrl, string $email, ?string $eabKid, ?string $eabHmacKey): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$id`           | **string**  |             |
| `$directoryUrl` | **string**  |             |
| `$email`        | **string**  |             |
| `$eabKid`       | **?string** |             |
| `$eabHmacKey`   | **?string** |             |

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

The identifier of CertificateProvisioner

```php
public getId(): string
```

***

### getDirectoryUrl

The URL to the ACME directory

```php
public getDirectoryUrl(): string
```

***

### getEmail

The email address for contact information

```php
public getEmail(): string
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
