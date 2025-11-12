# SyslogIntegrationPatch

Low level SyslogIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\SyslogIntegrationPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### extra

```php
private ?array $extra
```

***

### host

```php
private ?string $host
```

***

### port

```php
private ?int $port
```

***

### protocol

```php
private ?string $protocol
```

***

### facility

```php
private ?int $facility
```

***

### messageFormat

```php
private ?string $messageFormat
```

***

### authToken

```php
private ?string $authToken
```

***

### authMode

```php
private ?string $authMode
```

***

### tlsVerify

```php
private ?bool $tlsVerify
```

***

### excludedServices

```php
private ?array $excludedServices
```

***

## Methods

### __construct

```php
public __construct(string $type, ?array $extra = [], ?string $host = null, ?int $port = null, ?string $protocol = null, ?int $facility = null, ?string $messageFormat = null, ?string $authToken = null, ?string $authMode = null, ?bool $tlsVerify = null, ?array $excludedServices = []): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$type`             | **string**  |             |
| `$extra`            | **?array**  |             |
| `$host`             | **?string** |             |
| `$port`             | **?int**    |             |
| `$protocol`         | **?string** |             |
| `$facility`         | **?int**    |             |
| `$messageFormat`    | **?string** |             |
| `$authToken`        | **?string** |             |
| `$authMode`         | **?string** |             |
| `$tlsVerify`        | **?bool**   |             |
| `$excludedServices` | **?array**  |             |

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

### getType

```php
public getType(): string
```

***

### getExtra

```php
public getExtra(): ?array
```

***

### getHost

Syslog relay/collector host

```php
public getHost(): ?string
```

***

### getPort

Syslog relay/collector port

```php
public getPort(): ?int
```

***

### getProtocol

Transport protocol

```php
public getProtocol(): ?string
```

***

### getFacility

Syslog facility

```php
public getFacility(): ?int
```

***

### getMessageFormat

Syslog message format

```php
public getMessageFormat(): ?string
```

***

### getAuthToken

```php
public getAuthToken(): ?string
```

***

### getAuthMode

```php
public getAuthMode(): ?string
```

***

### getTlsVerify

Enable/Disable HTTPS certificate verification

```php
public getTlsVerify(): ?bool
```

***

### getExcludedServices

```php
public getExcludedServices(): ?array
```

***
