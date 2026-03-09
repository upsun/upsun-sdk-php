# SplunkIntegration

Low level SplunkIntegration (auto-generated)

***

* Full name: `\Upsun\Model\SplunkIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Integration`](./Integration.md)

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
private array $extra
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

### sourcetype

```php
private string $sourcetype
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
public __construct(string $type, array $extra, string $url, string $index, string $sourcetype, bool $tlsVerify, array $excludedServices, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$type`             | **string**     |             |
| `$extra`            | **array**      |             |
| `$url`              | **string**     |             |
| `$index`            | **string**     |             |
| `$sourcetype`       | **string**     |             |
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

### getSourcetype

The event 'sourcetype'

```php
public getSourcetype(): string
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

The identifier of SplunkIntegration

```php
public getId(): ?string
```

***
