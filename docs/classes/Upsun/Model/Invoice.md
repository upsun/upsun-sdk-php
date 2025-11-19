# Invoice

Low level Invoice (auto-generated)
The invoice object.

***

* Full name: `\Upsun\Model\Invoice`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### relatedInvoiceId

```php
private ?string $relatedInvoiceId
```

***

### invoiceDate

```php
private ?\DateTime $invoiceDate
```

***

### invoiceDue

```php
private ?\DateTime $invoiceDue
```

***

### created

```php
private ?\DateTime $created
```

***

### changed

```php
private ?\DateTime $changed
```

***

### id

```php
private ?string $id
```

***

### invoiceNumber

```php
private ?string $invoiceNumber
```

***

### type

```php
private ?string $type
```

***

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

### owner

```php
private ?string $owner
```

***

### company

```php
private ?string $company
```

***

### total

```php
private ?float $total
```

***

### address

```php
private ?\Upsun\Model\Address $address
```

***

### notes

```php
private ?string $notes
```

***

### invoicePdf

```php
private ?\Upsun\Model\InvoicePDF $invoicePdf
```

***

## Methods

### __construct

```php
public __construct(?string $relatedInvoiceId = null, ?\DateTime $invoiceDate = null, ?\DateTime $invoiceDue = null, ?\DateTime $created = null, ?\DateTime $changed = null, ?string $id = null, ?string $invoiceNumber = null, ?string $type = null, ?string $orderId = null, ?string $status = null, ?string $owner = null, ?string $company = null, ?float $total = null, ?\Upsun\Model\Address $address = null, ?string $notes = null, ?\Upsun\Model\InvoicePDF $invoicePdf = null): mixed
```

**Parameters:**

| Parameter           | Type                         | Description |
|---------------------|------------------------------|-------------|
| `$relatedInvoiceId` | **?string**                  |             |
| `$invoiceDate`      | **?\DateTime**               |             |
| `$invoiceDue`       | **?\DateTime**               |             |
| `$created`          | **?\DateTime**               |             |
| `$changed`          | **?\DateTime**               |             |
| `$id`               | **?string**                  |             |
| `$invoiceNumber`    | **?string**                  |             |
| `$type`             | **?string**                  |             |
| `$orderId`          | **?string**                  |             |
| `$status`           | **?string**                  |             |
| `$owner`            | **?string**                  |             |
| `$company`          | **?string**                  |             |
| `$total`            | **?float**                   |             |
| `$address`          | **?\Upsun\Model\Address**    |             |
| `$notes`            | **?string**                  |             |
| `$invoicePdf`       | **?\Upsun\Model\InvoicePDF** |             |

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

The invoice id.

```php
public getId(): ?string
```

***

### getInvoiceNumber

The invoice number.

```php
public getInvoiceNumber(): ?string
```

***

### getType

Invoice type.

```php
public getType(): ?string
```

***

### getOrderId

The id of the related order.

```php
public getOrderId(): ?string
```

***

### getRelatedInvoiceId

If the invoice is a credit memo (type=credit_memo), this field stores the id of the related/original invoice.

```php
public getRelatedInvoiceId(): ?string
```

***

### getStatus

The invoice status.

```php
public getStatus(): ?string
```

***

### getOwner

The ULID of the owner.

```php
public getOwner(): ?string
```

***

### getInvoiceDate

The invoice date.

```php
public getInvoiceDate(): ?\DateTime
```

***

### getInvoiceDue

The invoice due date.

```php
public getInvoiceDue(): ?\DateTime
```

***

### getCreated

The time when the invoice was created.

```php
public getCreated(): ?\DateTime
```

***

### getChanged

The time when the invoice was changed.

```php
public getChanged(): ?\DateTime
```

***

### getCompany

Company name (if any).

```php
public getCompany(): ?string
```

***

### getTotal

The invoice total.

```php
public getTotal(): ?float
```

***

### getAddress

The address of the user.

```php
public getAddress(): ?\Upsun\Model\Address
```

***

### getNotes

The invoice note.

```php
public getNotes(): ?string
```

***

### getInvoicePdf

Invoice PDF document details.

```php
public getInvoicePdf(): ?\Upsun\Model\InvoicePDF
```

***
