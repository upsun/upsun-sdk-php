# GetTotpEnrollment200Response

Low level GetTotpEnrollment200Response (auto-generated)

***

* Full name: `\Upsun\Model\GetTotpEnrollment200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### issuer

```php
private ?string $issuer
```

***

### accountName

```php
private ?string $accountName
```

***

### secret

```php
private ?string $secret
```

***

### qrCode

```php
private ?string $qrCode
```

***

## Methods

### __construct

```php
public __construct(?string $issuer = null, ?string $accountName = null, ?string $secret = null, ?string $qrCode = null): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$issuer`      | **?string** |             |
| `$accountName` | **?string** |             |
| `$secret`      | **?string** |             |
| `$qrCode`      | **?string** |             |

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

### getIssuer

```php
public getIssuer(): ?string
```

***

### getAccountName

```php
public getAccountName(): ?string
```

***

### getSecret

```php
public getSecret(): ?string
```

***

### getQrCode

```php
public getQrCode(): ?string
```

***
