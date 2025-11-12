# OrganizationEstimationObjectSubscriptionsListInner

Low level OrganizationEstimationObjectSubscriptionsListInner (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### licenseId

```php
private ?string $licenseId
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### total

```php
private ?string $total
```

***

### usage

```php
private ?\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage $usage
```

***

## Methods

### __construct

```php
public __construct(?string $licenseId = null, ?string $projectTitle = null, ?string $total = null, ?\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage $usage = null): mixed
```

**Parameters:**

| Parameter       | Type                                                                      | Description |
|-----------------|---------------------------------------------------------------------------|-------------|
| `$licenseId`    | **?string**                                                               |             |
| `$projectTitle` | **?string**                                                               |             |
| `$total`        | **?string**                                                               |             |
| `$usage`        | **?\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage** |             |

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

### getLicenseId

```php
public getLicenseId(): ?string
```

***

### getProjectTitle

```php
public getProjectTitle(): ?string
```

***

### getTotal

```php
public getTotal(): ?string
```

***

### getUsage

```php
public getUsage(): ?\Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage
```

***
