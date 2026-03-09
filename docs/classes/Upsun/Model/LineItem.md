# LineItem

Low level LineItem (auto-generated)
A line item in an order.

***

* Full name: `\Upsun\Model\LineItem`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                     | Visibility | Type | Value                   |
|------------------------------|------------|------|-------------------------|
| `TYPE_PROJECT_PLAN`          | public     |      | 'project_plan'          |
| `TYPE_PROJECT_FEATURE`       | public     |      | 'project_feature'       |
| `TYPE_PROJECT_SUBTOTAL`      | public     |      | 'project_subtotal'      |
| `TYPE_ORGANIZATION_PLAN`     | public     |      | 'organization_plan'     |
| `TYPE_ORGANIZATION_FEATURE`  | public     |      | 'organization_feature'  |
| `TYPE_ORGANIZATION_SUBTOTAL` | public     |      | 'organization_subtotal' |

## Properties

### licenseId

```php
private ?float $licenseId
```

***

### projectId

```php
private ?string $projectId
```

***

### type

```php
private ?string $type
```

***

### product

```php
private ?string $product
```

***

### sku

```php
private ?string $sku
```

***

### total

```php
private ?float $total
```

***

### totalFormatted

```php
private ?string $totalFormatted
```

***

### components

```php
private ?array $components
```

***

### excludeFromInvoice

```php
private ?bool $excludeFromInvoice
```

***

## Methods

### __construct

```php
public __construct(?float $licenseId = null, ?string $projectId = null, ?string $type = null, ?string $product = null, ?string $sku = null, ?float $total = null, ?string $totalFormatted = null, ?array $components = [], ?bool $excludeFromInvoice = null): mixed
```

**Parameters:**

| Parameter             | Type        | Description |
|-----------------------|-------------|-------------|
| `$licenseId`          | **?float**  |             |
| `$projectId`          | **?string** |             |
| `$type`               | **?string** |             |
| `$product`            | **?string** |             |
| `$sku`                | **?string** |             |
| `$total`              | **?float**  |             |
| `$totalFormatted`     | **?string** |             |
| `$components`         | **?array**  |             |
| `$excludeFromInvoice` | **?bool**   |             |

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

The type of line item.

```php
public getType(): ?string
```

***

### getLicenseId

The associated subscription identifier.

```php
public getLicenseId(): ?float
```

***

### getProjectId

The associated project identifier.

```php
public getProjectId(): ?string
```

***

### getProduct

Display name of the line item product.

```php
public getProduct(): ?string
```

***

### getSku

The line item product SKU.

```php
public getSku(): ?string
```

***

### getTotal

Total price as a decimal.

```php
public getTotal(): ?float
```

***

### getTotalFormatted

Total price, formatted with currency.

```php
public getTotalFormatted(): ?string
```

***

### getComponents

The price components for the line item, keyed by type.

```php
public getComponents(): \Upsun\Model\LineItemComponent[]|null
```

***

### getExcludeFromInvoice

Line item should not be considered billable.

```php
public getExcludeFromInvoice(): ?bool
```

***
