# SyslogIntegration

Low level SyslogIntegration (auto-generated)

***

* Full name: `\Upsun\Model\SyslogIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Integration`](./Integration.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                 | Visibility | Type | Value     |
|--------------------------|------------|------|-----------|
| `PROTOCOL_TCP`           | public     |      | 'tcp'     |
| `PROTOCOL_TLS`           | public     |      | 'tls'     |
| `PROTOCOL_UDP`           | public     |      | 'udp'     |
| `MESSAGE_FORMAT_RFC3164` | public     |      | 'rfc3164' |
| `MESSAGE_FORMAT_RFC5424` | public     |      | 'rfc5424' |

## Properties

### type

```php
private string $type
```

***

### extra

```php
private array $extra
```

***

### host

```php
private string $host
```

***

### port

```php
private int $port
```

***

### protocol

```php
private string $protocol
```

***

### facility

```php
private int $facility
```

***

### messageFormat

```php
private string $messageFormat
```

***

### tlsVerify

```php
private bool $tlsVerify
```

***

### excludedServices

```php
private array $excludedServices
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

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, array $extra, string $host, int $port, string $protocol, int $facility, string $messageFormat, bool $tlsVerify, array $excludedServices, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$type`             | **string**     |             |
| `$extra`            | **array**      |             |
| `$host`             | **string**     |             |
| `$port`             | **int**        |             |
| `$protocol`         | **string**     |             |
| `$facility`         | **int**        |             |
| `$messageFormat`    | **string**     |             |
| `$tlsVerify`        | **bool**       |             |
| `$excludedServices` | **array**      |             |
| `$createdAt`        | **?\DateTime** |             |
| `$updatedAt`        | **?\DateTime** |             |
| `$id`               | **?string**    |             |

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

### getType

```php
public getType(): string
```

***

### getExtra

```php
public getExtra(): array
```

***

### getHost

Syslog relay/collector host

```php
public getHost(): string
```

***

### getPort

Syslog relay/collector port

```php
public getPort(): int
```

***

### getProtocol

Transport protocol

```php
public getProtocol(): string
```

***

### getFacility

Syslog facility

```php
public getFacility(): int
```

***

### getMessageFormat

Syslog message format

```php
public getMessageFormat(): string
```

***

### getTlsVerify

Enable/Disable HTTPS certificate verification

```php
public getTlsVerify(): bool
```

***

### getExcludedServices

```php
public getExcludedServices(): array
```

***

### getId

The identifier of SyslogIntegration

```php
public getId(): ?string
```

***
