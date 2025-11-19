# InvoicePDF

Low level InvoicePDF (auto-generated)
Invoice PDF document details.

***

* Full name: `\Upsun\Model\InvoicePDF`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### url

```php
private ?string $url
```

***

### status

```php
private ?string $status
```

***

## Methods

### __construct

```php
public __construct(?string $url = null, ?string $status = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$url`    | **?string** |             |
| `$status` | **?string** |             |

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

### getUrl

A link to the PDF invoice.

```php
public getUrl(): ?string
```

***

### getStatus

The status of the PDF document. We generate invoice PDF asyncronously in batches. An invoice PDF document may not
be immediately available to download. If status is 'ready', the PDF is ready to download. 'pending' means the PDF
is not created but queued up. If you get this status, try again later.

```php
public getStatus(): ?string
```

***
