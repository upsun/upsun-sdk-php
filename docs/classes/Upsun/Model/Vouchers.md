# Vouchers

Low level Vouchers (auto-generated)

***

* Full name: `\Upsun\Model\Vouchers`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### uuid

```php
private ?string $uuid
```

***

### vouchersTotal

```php
private ?string $vouchersTotal
```

***

### vouchersApplied

```php
private ?string $vouchersApplied
```

***

### vouchersRemainingBalance

```php
private ?string $vouchersRemainingBalance
```

***

### currency

```php
private ?string $currency
```

***

### vouchers

```php
private ?array $vouchers
```

***

### links

```php
private ?\Upsun\Model\VouchersLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $uuid = null, ?string $vouchersTotal = null, ?string $vouchersApplied = null, ?string $vouchersRemainingBalance = null, ?string $currency = null, ?array $vouchers = [], ?\Upsun\Model\VouchersLinks $links = null): mixed
```

**Parameters:**

| Parameter                   | Type                            | Description |
|-----------------------------|---------------------------------|-------------|
| `$uuid`                     | **?string**                     |             |
| `$vouchersTotal`            | **?string**                     |             |
| `$vouchersApplied`          | **?string**                     |             |
| `$vouchersRemainingBalance` | **?string**                     |             |
| `$currency`                 | **?string**                     |             |
| `$vouchers`                 | **?array**                      |             |
| `$links`                    | **?\Upsun\Model\VouchersLinks** |             |

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

### getUuid

The uuid of the user.

```php
public getUuid(): ?string
```

***

### getVouchersTotal

The total voucher credit given to the user.

```php
public getVouchersTotal(): ?string
```

***

### getVouchersApplied

The part of total voucher credit applied to orders.

```php
public getVouchersApplied(): ?string
```

***

### getVouchersRemainingBalance

The remaining voucher credit, available for future orders.

```php
public getVouchersRemainingBalance(): ?string
```

***

### getCurrency

The currency of the vouchers.

```php
public getCurrency(): ?string
```

***

### getVouchers

Array of vouchers.

```php
public getVouchers(): \Upsun\Model\VouchersVouchersInner[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\VouchersLinks
```

***
