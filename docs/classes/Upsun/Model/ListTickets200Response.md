# ListTickets200Response

Low level ListTickets200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListTickets200Response`
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

### tickets

```php
private ?array $tickets
```

***

### links

```php
private ?\Upsun\Model\HalLinks $links
```

***

## Methods

### __construct

```php
public __construct(?int $count = null, ?array $tickets = [], ?\Upsun\Model\HalLinks $links = null): mixed
```

**Parameters:**

| Parameter  | Type                       | Description |
|------------|----------------------------|-------------|
| `$count`   | **?int**                   |             |
| `$tickets` | **?array**                 |             |
| `$links`   | **?\Upsun\Model\HalLinks** |             |

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

### getTickets

```php
public getTickets(): \Upsun\Model\Ticket[]|null
```

***

### getLinks

Links to _self, and previous or next page, given that they exist.

```php
public getLinks(): ?\Upsun\Model\HalLinks
```

***
