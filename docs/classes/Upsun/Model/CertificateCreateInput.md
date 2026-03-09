# CertificateCreateInput

Low level CertificateCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\CertificateCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### certificate

```php
private string $certificate
```

***

### key

```php
private string $key
```

***

### chain

```php
private ?array $chain
```

***

### isInvalid

```php
private ?bool $isInvalid
```

***

## Methods

### __construct

```php
public __construct(string $certificate, string $key, ?array $chain = [], ?bool $isInvalid = null): mixed
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$certificate` | **string** |             |
| `$key`         | **string** |             |
| `$chain`       | **?array** |             |
| `$isInvalid`   | **?bool**  |             |

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

### getCertificate

The PEM-encoded certificate

```php
public getCertificate(): string
```

***

### getKey

The PEM-encoded private key

```php
public getKey(): string
```

***

### getChain

```php
public getChain(): ?array
```

***

### getIsInvalid

Whether this certificate should be skipped during provisioning

```php
public getIsInvalid(): ?bool
```

***
