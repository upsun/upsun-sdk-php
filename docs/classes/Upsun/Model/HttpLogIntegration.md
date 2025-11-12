# HttpLogIntegration

Low level HttpLogIntegration (auto-generated)

***

* Full name: `\Upsun\Model\HttpLogIntegration`
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
private array $extra
```

***

### url

```php
private string $url
```

***

### headers

```php
private array $headers
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
public __construct(string $type, array $extra, string $url, array $headers, bool $tlsVerify, array $excludedServices, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$type`             | **string**     |             |
| `$extra`            | **array**      |             |
| `$url`              | **string**     |             |
| `$headers`          | **array**      |             |
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

```php
public getUrl(): string
```

***

### getHeaders

```php
public getHeaders(): array
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

The identifier of HttpLogIntegration

```php
public getId(): ?string
```

***
