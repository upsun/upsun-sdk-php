# PlanRecords

Low level PlanRecords (auto-generated)
The plan record object.

***

* Full name: `\Upsun\Model\PlanRecords`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### end

```php
private ?\DateTime $end
```

***

### id

```php
private ?string $id
```

***

### owner

```php
private ?string $owner
```

***

### subscriptionId

```php
private ?string $subscriptionId
```

***

### sku

```php
private ?string $sku
```

***

### plan

```php
private ?string $plan
```

***

### options

```php
private ?array $options
```

***

### start

```php
private ?\DateTime $start
```

***

### status

```php
private ?string $status
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $end = null, ?string $id = null, ?string $owner = null, ?string $subscriptionId = null, ?string $sku = null, ?string $plan = null, ?array $options = [], ?\DateTime $start = null, ?string $status = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$end`            | **?\DateTime** |             |
| `$id`             | **?string**    |             |
| `$owner`          | **?string**    |             |
| `$subscriptionId` | **?string**    |             |
| `$sku`            | **?string**    |             |
| `$plan`           | **?string**    |             |
| `$options`        | **?array**     |             |
| `$start`          | **?\DateTime** |             |
| `$status`         | **?string**    |             |

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

### getId

The unique ID of the plan record.

```php
public getId(): ?string
```

***

### getOwner

The UUID of the owner.

```php
public getOwner(): ?string
```

***

### getSubscriptionId

The ID of the subscription this record pertains to.

```php
public getSubscriptionId(): ?string
```

***

### getSku

The product SKU of the plan that this record represents.

```php
public getSku(): ?string
```

***

### getPlan

The machine name of the plan that this record represents.

```php
public getPlan(): ?string
```

***

### getOptions

```php
public getOptions(): ?array
```

***

### getStart

The start timestamp of this plan record (ISO 8601).

```php
public getStart(): ?\DateTime
```

***

### getEnd

The end timestamp of this plan record (ISO 8601).

```php
public getEnd(): ?\DateTime
```

***

### getStatus

The status of the subscription during this record: active or suspended.

```php
public getStatus(): ?string
```

***
