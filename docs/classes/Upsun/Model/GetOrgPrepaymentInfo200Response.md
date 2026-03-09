# GetOrgPrepaymentInfo200Response

Low level GetOrgPrepaymentInfo200Response (auto-generated)

***

* Full name: `\Upsun\Model\GetOrgPrepaymentInfo200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### prepayment

```php
private ?\Upsun\Model\PrepaymentObject $prepayment
```

***

### links

```php
private ?\Upsun\Model\GetOrgPrepaymentInfo200ResponseLinks $links
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\PrepaymentObject $prepayment = null, ?\Upsun\Model\GetOrgPrepaymentInfo200ResponseLinks $links = null): mixed
```

**Parameters:**

| Parameter     | Type                                                   | Description |
|---------------|--------------------------------------------------------|-------------|
| `$prepayment` | **?\Upsun\Model\PrepaymentObject**                     |             |
| `$links`      | **?\Upsun\Model\GetOrgPrepaymentInfo200ResponseLinks** |             |

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

### getPrepayment

Prepayment information for an organization.

```php
public getPrepayment(): ?\Upsun\Model\PrepaymentObject
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\GetOrgPrepaymentInfo200ResponseLinks
```

***
