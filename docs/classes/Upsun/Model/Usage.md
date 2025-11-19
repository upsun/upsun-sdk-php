# Usage

Low level Usage (auto-generated)
The usage object.

***

* Full name: `\Upsun\Model\Usage`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### subscriptionId

```php
private ?string $subscriptionId
```

***

### usageGroup

```php
private ?string $usageGroup
```

***

### quantity

```php
private ?float $quantity
```

***

### start

```php
private ?\DateTime $start
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $subscriptionId = null, ?string $usageGroup = null, ?float $quantity = null, ?\DateTime $start = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$id`             | **?string**    |             |
| `$subscriptionId` | **?string**    |             |
| `$usageGroup`     | **?string**    |             |
| `$quantity`       | **?float**     |             |
| `$start`          | **?\DateTime** |             |

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

The unique ID of the usage record.

```php
public getId(): ?string
```

***

### getSubscriptionId

The ID of the subscription.

```php
public getSubscriptionId(): ?string
```

***

### getUsageGroup

The type of usage that this record represents.

```php
public getUsageGroup(): ?string
```

***

### getQuantity

The quantity used.

```php
public getQuantity(): ?float
```

***

### getStart

The start timestamp of this usage record (ISO 8601).

```php
public getStart(): ?\DateTime
```

***
