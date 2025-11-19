# Order

Low level Order (auto-generated)
The order object.

***

* Full name: `\Upsun\Model\Order`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### paidOn

```php
private ?\DateTime $paidOn
```

***

### id

```php
private ?string $id
```

***

### status

```php
private ?string $status
```

***

### owner

```php
private ?string $owner
```

***

### address

```php
private ?\Upsun\Model\Address $address
```

***

### company

```php
private ?string $company
```

***

### vatNumber

```php
private ?string $vatNumber
```

***

### billingPeriodStart

```php
private ?\DateTime $billingPeriodStart
```

***

### billingPeriodEnd

```php
private ?\DateTime $billingPeriodEnd
```

***

### billingPeriodLabel

```php
private ?\Upsun\Model\OrderBillingPeriodLabel $billingPeriodLabel
```

***

### billingPeriodDuration

```php
private ?int $billingPeriodDuration
```

***

### total

```php
private ?int $total
```

***

### totalFormatted

```php
private ?int $totalFormatted
```

***

### components

```php
private ?\Upsun\Model\Components $components
```

***

### currency

```php
private ?string $currency
```

***

### invoiceUrl

```php
private ?string $invoiceUrl
```

***

### lastRefreshed

```php
private ?\DateTime $lastRefreshed
```

***

### invoiced

```php
private ?bool $invoiced
```

***

### lineItems

```php
private ?array $lineItems
```

***

### links

```php
private ?\Upsun\Model\OrderLinks $links
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $paidOn = null, ?string $id = null, ?string $status = null, ?string $owner = null, ?\Upsun\Model\Address $address = null, ?string $company = null, ?string $vatNumber = null, ?\DateTime $billingPeriodStart = null, ?\DateTime $billingPeriodEnd = null, ?\Upsun\Model\OrderBillingPeriodLabel $billingPeriodLabel = null, ?int $billingPeriodDuration = null, ?int $total = null, ?int $totalFormatted = null, ?\Upsun\Model\Components $components = null, ?string $currency = null, ?string $invoiceUrl = null, ?\DateTime $lastRefreshed = null, ?bool $invoiced = null, ?array $lineItems = [], ?\Upsun\Model\OrderLinks $links = null): mixed
```

**Parameters:**

| Parameter                | Type                                      | Description |
|--------------------------|-------------------------------------------|-------------|
| `$paidOn`                | **?\DateTime**                            |             |
| `$id`                    | **?string**                               |             |
| `$status`                | **?string**                               |             |
| `$owner`                 | **?string**                               |             |
| `$address`               | **?\Upsun\Model\Address**                 |             |
| `$company`               | **?string**                               |             |
| `$vatNumber`             | **?string**                               |             |
| `$billingPeriodStart`    | **?\DateTime**                            |             |
| `$billingPeriodEnd`      | **?\DateTime**                            |             |
| `$billingPeriodLabel`    | **?\Upsun\Model\OrderBillingPeriodLabel** |             |
| `$billingPeriodDuration` | **?int**                                  |             |
| `$total`                 | **?int**                                  |             |
| `$totalFormatted`        | **?int**                                  |             |
| `$components`            | **?\Upsun\Model\Components**              |             |
| `$currency`              | **?string**                               |             |
| `$invoiceUrl`            | **?string**                               |             |
| `$lastRefreshed`         | **?\DateTime**                            |             |
| `$invoiced`              | **?bool**                                 |             |
| `$lineItems`             | **?array**                                |             |
| `$links`                 | **?\Upsun\Model\OrderLinks**              |             |

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

The ID of the order.

```php
public getId(): ?string
```

***

### getStatus

The status of the subscription.

```php
public getStatus(): ?string
```

***

### getOwner

The UUID of the owner.

```php
public getOwner(): ?string
```

***

### getAddress

The address of the user.

```php
public getAddress(): ?\Upsun\Model\Address
```

***

### getCompany

The company name.

```php
public getCompany(): ?string
```

***

### getVatNumber

An identifier used in many countries for value added tax purposes.

```php
public getVatNumber(): ?string
```

***

### getBillingPeriodStart

The time when the billing period of the order started.

```php
public getBillingPeriodStart(): ?\DateTime
```

***

### getBillingPeriodEnd

The time when the billing period of the order ended.

```php
public getBillingPeriodEnd(): ?\DateTime
```

***

### getBillingPeriodLabel

Descriptive information about the billing cycle.

```php
public getBillingPeriodLabel(): ?\Upsun\Model\OrderBillingPeriodLabel
```

***

### getBillingPeriodDuration

The duration of the billing period of the order in seconds.

```php
public getBillingPeriodDuration(): ?int
```

***

### getPaidOn

The time when the order was successfully charged.

```php
public getPaidOn(): ?\DateTime
```

***

### getTotal

The total of the order.

```php
public getTotal(): ?int
```

***

### getTotalFormatted

The total of the order, formatted with currency.

```php
public getTotalFormatted(): ?int
```

***

### getComponents

The components of the project

```php
public getComponents(): ?\Upsun\Model\Components
```

***

### getCurrency

The order currency code.

```php
public getCurrency(): ?string
```

***

### getInvoiceUrl

A link to the PDF invoice.

```php
public getInvoiceUrl(): ?string
```

***

### getLastRefreshed

The time when the order was last refreshed.

```php
public getLastRefreshed(): ?\DateTime
```

***

### getInvoiced

The customer is invoiced.

```php
public getInvoiced(): ?bool
```

***

### getLineItems

The line items that comprise the order.

```php
public getLineItems(): \Upsun\Model\LineItem[]|null
```

***

### getLinks

Links to related API endpoints.

```php
public getLinks(): ?\Upsun\Model\OrderLinks
```

***
