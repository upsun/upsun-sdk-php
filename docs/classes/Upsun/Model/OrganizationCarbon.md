# OrganizationCarbon

Low level OrganizationCarbon (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationCarbon`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### organizationId

```php
private ?string $organizationId
```

***

### meta

```php
private ?\Upsun\Model\MetricsMetadata $meta
```

***

### projects

```php
private ?array $projects
```

***

### total

```php
private ?float $total
```

***

## Methods

### __construct

```php
public __construct(?string $organizationId = null, ?\Upsun\Model\MetricsMetadata $meta = null, ?array $projects = [], ?float $total = null): mixed
```

**Parameters:**

| Parameter         | Type                              | Description |
|-------------------|-----------------------------------|-------------|
| `$organizationId` | **?string**                       |             |
| `$meta`           | **?\Upsun\Model\MetricsMetadata** |             |
| `$projects`       | **?array**                        |             |
| `$total`          | **?float**                        |             |

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

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
```

***

### getMeta

```php
public getMeta(): ?\Upsun\Model\MetricsMetadata
```

***

### getProjects

```php
public getProjects(): \Upsun\Model\OrganizationProjectCarbon[]|null
```

***

### getTotal

The calculated total of the metric for the given interval.

```php
public getTotal(): ?float
```

***
