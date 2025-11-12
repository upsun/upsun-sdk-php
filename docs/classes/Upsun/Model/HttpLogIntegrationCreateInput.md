# HttpLogIntegrationCreateInput

Low level HttpLogIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\HttpLogIntegrationCreateInput`
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
private ?array $excludedServices
```

***

## Methods

### __construct

```php
public __construct(string $type, string $url, ?array $extra = [], ?array $headers = [], ?bool $tlsVerify = null, ?array $excludedServices = []): mixed
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$type`             | **string** |             |
| `$url`              | **string** |             |
| `$extra`            | **?array** |             |
| `$headers`          | **?array** |             |
| `$tlsVerify`        | **?bool**  |             |
| `$excludedServices` | **?array** |             |

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
public getExcludedServices(): ?array
```

***
