# OrganizationEstimationObjectSubscriptions

Low level OrganizationEstimationObjectSubscriptions (auto-generated)

An estimation of subscriptions cost.

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectSubscriptions`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### total

```php
private ?string $total
```

***

### list

```php
private ?array $list
```

***

## Methods

### __construct

```php
public __construct(?string $total = null, ?array $list = []): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$total`  | **?string** |             |
| `$list`   | **?array**  |             |

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

### getTotal

The total price for subscriptions.

```php
public getTotal(): ?string
```

***

### getList

The list of active subscriptions.

```php
public getList(): \Upsun\Model\OrganizationEstimationObjectSubscriptionsListInner[]|null
```

***
