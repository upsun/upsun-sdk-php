# VouchersVouchersInnerOrdersInner

Low level VouchersVouchersInnerOrdersInner (auto-generated)

***

* Full name: `\Upsun\Model\VouchersVouchersInnerOrdersInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### orderId

```php
private ?string $orderId
```

***

### status

```php
private ?string $status
```

***

### billingPeriodStart

```php
private ?string $billingPeriodStart
```

***

### billingPeriodEnd

```php
private ?string $billingPeriodEnd
```

***

### orderTotal

```php
private ?string $orderTotal
```

***

### orderDiscount

```php
private ?string $orderDiscount
```

***

### currency

```php
private ?string $currency
```

***

## Methods

### __construct

```php
public __construct(?string $orderId = null, ?string $status = null, ?string $billingPeriodStart = null, ?string $billingPeriodEnd = null, ?string $orderTotal = null, ?string $orderDiscount = null, ?string $currency = null): mixed
```

**Parameters:**

| Parameter             | Type        | Description |
|-----------------------|-------------|-------------|
| `$orderId`            | **?string** |             |
| `$status`             | **?string** |             |
| `$billingPeriodStart` | **?string** |             |
| `$billingPeriodEnd`   | **?string** |             |
| `$orderTotal`         | **?string** |             |
| `$orderDiscount`      | **?string** |             |
| `$currency`           | **?string** |             |

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

### getOrderId

```php
public getOrderId(): ?string
```

***

### getStatus

```php
public getStatus(): ?string
```

***

### getBillingPeriodStart

```php
public getBillingPeriodStart(): ?string
```

***

### getBillingPeriodEnd

```php
public getBillingPeriodEnd(): ?string
```

***

### getOrderTotal

```php
public getOrderTotal(): ?string
```

***

### getOrderDiscount

```php
public getOrderDiscount(): ?string
```

***

### getCurrency

```php
public getCurrency(): ?string
```

***
