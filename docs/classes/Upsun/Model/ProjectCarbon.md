# ProjectCarbon

Low level ProjectCarbon (auto-generated)

***

* Full name: `\Upsun\Model\ProjectCarbon`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### projectId

```php
private ?string $projectId
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### meta

```php
private ?\Upsun\Model\MetricsMetadata $meta
```

***

### values

```php
private ?array $values
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
public __construct(?string $projectId = null, ?string $projectTitle = null, ?\Upsun\Model\MetricsMetadata $meta = null, ?array $values = [], ?float $total = null): mixed
```

**Parameters:**

| Parameter       | Type                              | Description |
|-----------------|-----------------------------------|-------------|
| `$projectId`    | **?string**                       |             |
| `$projectTitle` | **?string**                       |             |
| `$meta`         | **?\Upsun\Model\MetricsMetadata** |             |
| `$values`       | **?array**                        |             |
| `$total`        | **?float**                        |             |

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

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getProjectTitle

The title of the project.

```php
public getProjectTitle(): ?string
```

***

### getMeta

```php
public getMeta(): ?\Upsun\Model\MetricsMetadata
```

***

### getValues

```php
public getValues(): \Upsun\Model\MetricsValue[]|null
```

***

### getTotal

The calculated total of the metric for the given interval.

```php
public getTotal(): ?float
```

***
