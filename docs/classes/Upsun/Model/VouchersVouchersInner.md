# VouchersVouchersInner

Low level VouchersVouchersInner (auto-generated)

***

* Full name: `\Upsun\Model\VouchersVouchersInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### code

```php
private ?string $code
```

***

### amount

```php
private ?string $amount
```

***

### currency

```php
private ?string $currency
```

***

### orders

```php
private ?array $orders
```

***

## Methods

### __construct

```php
public __construct(?string $code = null, ?string $amount = null, ?string $currency = null, ?array $orders = []): mixed
```

**Parameters:**

| Parameter   | Type        | Description |
|-------------|-------------|-------------|
| `$code`     | **?string** |             |
| `$amount`   | **?string** |             |
| `$currency` | **?string** |             |
| `$orders`   | **?array**  |             |

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

### getCode

```php
public getCode(): ?string
```

***

### getAmount

```php
public getAmount(): ?string
```

***

### getCurrency

```php
public getCurrency(): ?string
```

***

### getOrders

```php
public getOrders(): \Upsun\Model\VouchersVouchersInnerOrdersInner[]|null
```

***
