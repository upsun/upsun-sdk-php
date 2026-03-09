# TLSSettings

Low level TLSSettings (auto-generated)
TLS settings for the route.

***

* Full name: `\Upsun\Model\TLSSettings`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                         | Visibility | Type | Value     |
|----------------------------------|------------|------|-----------|
| `MIN_VERSION_TLSV1_0`            | public     |      | 'TLSv1.0' |
| `MIN_VERSION_TLSV1_1`            | public     |      | 'TLSv1.1' |
| `MIN_VERSION_TLSV1_2`            | public     |      | 'TLSv1.2' |
| `MIN_VERSION_TLSV1_3`            | public     |      | 'TLSv1.3' |
| `CLIENT_AUTHENTICATION_REQUEST`  | public     |      | 'request' |
| `CLIENT_AUTHENTICATION__REQUIRE` | public     |      | 'require' |

## Properties

### strictTransportSecurity

```php
private \Upsun\Model\StrictTransportSecurityOptions $strictTransportSecurity
```

***

### clientCertificateAuthorities

```php
private array $clientCertificateAuthorities
```

***

### minVersion

```php
private ?string $minVersion
```

***

### clientAuthentication

```php
private ?string $clientAuthentication
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Model\StrictTransportSecurityOptions $strictTransportSecurity, array $clientCertificateAuthorities, ?string $minVersion, ?string $clientAuthentication): mixed
```

**Parameters:**

| Parameter                       | Type                                            | Description |
|---------------------------------|-------------------------------------------------|-------------|
| `$strictTransportSecurity`      | **\Upsun\Model\StrictTransportSecurityOptions** |             |
| `$clientCertificateAuthorities` | **array**                                       |             |
| `$minVersion`                   | **?string**                                     |             |
| `$clientAuthentication`         | **?string**                                     |             |

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

### getStrictTransportSecurity

```php
public getStrictTransportSecurity(): \Upsun\Model\StrictTransportSecurityOptions
```

***

### getMinVersion

The minimum TLS version to support.

```php
public getMinVersion(): ?string
```

***

### getClientAuthentication

The type of client authentication to request.

```php
public getClientAuthentication(): ?string
```

***

### getClientCertificateAuthorities

```php
public getClientCertificateAuthorities(): array
```

***
