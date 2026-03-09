# SplunkIntegrationCreateInput

Low level SplunkIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\SplunkIntegrationCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationCreateInput`](./IntegrationCreateInput.md)

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### url

```php
private string $url
```

***

### index

```php
private string $index
```

***

### token

```php
private string $token
```

***

### extra

```php
private ?array $extra
```

***

### sourcetype

```php
private ?string $sourcetype
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
public __construct(string $type, string $url, string $index, string $token, ?array $extra = [], ?string $sourcetype = null, ?bool $tlsVerify = null, ?array $excludedServices = []): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$type`             | **string**  |             |
| `$url`              | **string**  |             |
| `$index`            | **string**  |             |
| `$token`            | **string**  |             |
| `$extra`            | **?array**  |             |
| `$sourcetype`       | **?string** |             |
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

### getUrl

The Splunk HTTP Event Connector REST API endpoint

```php
public getUrl(): string
```

***

### getIndex

The Splunk Index

```php
public getIndex(): string
```

***

### getToken

The Splunk Authorization Token

```php
public getToken(): string
```

***

### getExtra

```php
public getExtra(): ?array
```

***

### getSourcetype

The event 'sourcetype'

```php
public getSourcetype(): ?string
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
