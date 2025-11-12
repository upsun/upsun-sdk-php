# ListOrgPrepaymentTransactions200Response

Low level ListOrgPrepaymentTransactions200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListOrgPrepaymentTransactions200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### count

```php
private ?int $count
```

***

### transactions

```php
private ?array $transactions
```

***

### links

```php
private ?\Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinks $links
```

***

## Methods

### __construct

```php
public __construct(?int $count = null, ?array $transactions = [], ?\Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinks $links = null): mixed
```

**Parameters:**

| Parameter       | Type                                                            | Description |
|-----------------|-----------------------------------------------------------------|-------------|
| `$count`        | **?int**                                                        |             |
| `$transactions` | **?array**                                                      |             |
| `$links`        | **?\Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinks** |             |

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

### getCount

```php
public getCount(): ?int
```

***

### getTransactions

```php
public getTransactions(): \Upsun\Model\PrepaymentTransactionObject[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinks
```

***
