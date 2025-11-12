# SumologicIntegration

Low level SumologicIntegration (auto-generated)

***

* Full name: `\Upsun\Model\SumologicIntegration`
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

### category

```php
private string $category
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
public __construct(string $type, array $extra, string $url, string $category, bool $tlsVerify, array $excludedServices, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter           | Type           | Description |
|---------------------|----------------|-------------|
| `$type`             | **string**     |             |
| `$extra`            | **array**      |             |
| `$url`              | **string**     |             |
| `$category`         | **string**     |             |
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

### getCategory

The Category used to easy filtering (sent as X-Sumo-Category header)

```php
public getCategory(): string
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

The identifier of SumologicIntegration

```php
public getId(): ?string
```

***
