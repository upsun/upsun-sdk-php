# PrepaymentTransactionObject

Low level PrepaymentTransactionObject (auto-generated)
Prepayment transaction for an organization.

***

* Full name: `\Upsun\Model\PrepaymentTransactionObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### updated

```php
private ?string $updated
```

***

### expireDate

```php
private ?string $expireDate
```

***

### orderId

```php
private ?string $orderId
```

***

### message

```php
private ?string $message
```

***

### status

```php
private ?string $status
```

***

### amount

```php
private ?\Upsun\Model\PrepaymentTransactionObjectAmount $amount
```

***

### created

```php
private ?string $created
```

***

## Methods

### __construct

```php
public __construct(?string $updated = null, ?string $expireDate = null, ?string $orderId = null, ?string $message = null, ?string $status = null, ?\Upsun\Model\PrepaymentTransactionObjectAmount $amount = null, ?string $created = null): mixed
```

**Parameters:**

| Parameter     | Type                                                | Description |
|---------------|-----------------------------------------------------|-------------|
| `$updated`    | **?string**                                         |             |
| `$expireDate` | **?string**                                         |             |
| `$orderId`    | **?string**                                         |             |
| `$message`    | **?string**                                         |             |
| `$status`     | **?string**                                         |             |
| `$amount`     | **?\Upsun\Model\PrepaymentTransactionObjectAmount** |             |
| `$created`    | **?string**                                         |             |

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

Order ID

```php
public getOrderId(): ?string
```

***

### getMessage

The message associated with transaction.

```php
public getMessage(): ?string
```

***

### getStatus

Whether the transactions was successful or a failure.

```php
public getStatus(): ?string
```

***

### getAmount

The prepayment balance in complex format.

```php
public getAmount(): ?\Upsun\Model\PrepaymentTransactionObjectAmount
```

***

### getCreated

Time the transaction was created.

```php
public getCreated(): ?string
```

***

### getUpdated

Time the transaction was last updated.

```php
public getUpdated(): ?string
```

***

### getExpireDate

The expiration date of the transaction (deposits only).

```php
public getExpireDate(): ?string
```

***
