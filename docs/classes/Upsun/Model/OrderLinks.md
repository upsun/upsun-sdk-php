# OrderLinks

Low level OrderLinks (auto-generated)
Links to related API endpoints.

***

* Full name: `\Upsun\Model\OrderLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### invoices

```php
private ?\Upsun\Model\OrderLinksInvoices $invoices
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrderLinksInvoices $invoices = null): mixed
```

**Parameters:**

| Parameter   | Type                                 | Description |
|-------------|--------------------------------------|-------------|
| `$invoices` | **?\Upsun\Model\OrderLinksInvoices** |             |

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

### getInvoices

Link to related Invoices API. Use this to retrieve invoices related to this order.

```php
public getInvoices(): ?\Upsun\Model\OrderLinksInvoices
```

***
