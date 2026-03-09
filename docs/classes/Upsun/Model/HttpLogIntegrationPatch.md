# HttpLogIntegrationPatch

Low level HttpLogIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\HttpLogIntegrationPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationPatch`](./IntegrationPatch.md)

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

### extra

```php
private ?array $extra
```

***

### headers

```php
private ?array $headers
```

***

### tlsVerify

```php
private ?bool $tlsVerify
```

***

### excludedServices

```php
private ?string $excludedServices
```

***

## Methods

### __construct

```php
public __construct(string $type, string $url, ?array $extra = [], ?array $headers = [], ?bool $tlsVerify = null, ?string $excludedServices = null): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$type`             | **string**  |             |
| `$url`              | **string**  |             |
| `$extra`            | **?array**  |             |
| `$headers`          | **?array**  |             |
| `$tlsVerify`        | **?bool**   |             |
| `$excludedServices` | **?string** |             |

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

```php
public getUrl(): string
```

***

### getExtra

```php
public getExtra(): ?array
```

***

### getHeaders

```php
public getHeaders(): ?array
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
public getExcludedServices(): ?string
```

***
