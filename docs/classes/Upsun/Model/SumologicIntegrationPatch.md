# SumologicIntegrationPatch

Low level SumologicIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\SumologicIntegrationPatch`
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

### category

```php
private ?string $category
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
public __construct(string $type, string $url, ?array $extra = [], ?string $category = null, ?bool $tlsVerify = null, ?array $excludedServices = []): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$type`             | **string**  |             |
| `$url`              | **string**  |             |
| `$extra`            | **?array**  |             |
| `$category`         | **?string** |             |
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

```php
public getUrl(): string
```

***

### getExtra

```php
public getExtra(): ?array
```

***

### getCategory

The Category used to easy filtering (sent as X-Sumo-Category header)

```php
public getCategory(): ?string
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
