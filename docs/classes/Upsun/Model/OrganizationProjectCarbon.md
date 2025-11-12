# OrganizationProjectCarbon

Low level OrganizationProjectCarbon (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationProjectCarbon`
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
public __construct(?string $projectId = null, ?string $projectTitle = null, ?array $values = [], ?float $total = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$projectId`    | **?string** |             |
| `$projectTitle` | **?string** |             |
| `$values`       | **?array**  |             |
| `$total`        | **?float**  |             |

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
