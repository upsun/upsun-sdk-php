# ListOrgSubscriptions200Response

Low level ListOrgSubscriptions200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListOrgSubscriptions200Response`
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

### items

```php
private ?array $items
```

***

### links

```php
private ?\Upsun\Model\ListLinks $links
```

***

## Methods

### __construct

```php
public __construct(?int $count = null, ?array $items = [], ?\Upsun\Model\ListLinks $links = null): mixed
```

**Parameters:**

| Parameter | Type                        | Description |
|-----------|-----------------------------|-------------|
| `$count`  | **?int**                    |             |
| `$items`  | **?array**                  |             |
| `$links`  | **?\Upsun\Model\ListLinks** |             |

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

### getItems

```php
public getItems(): \Upsun\Model\Subscription[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListLinks
```

***
