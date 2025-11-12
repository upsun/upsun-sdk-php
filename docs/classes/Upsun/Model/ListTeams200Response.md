# ListTeams200Response

Low level ListTeams200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListTeams200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### items

```php
private ?array $items
```

***

### count

```php
private ?int $count
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
public __construct(?array $items = [], ?int $count = null, ?\Upsun\Model\ListLinks $links = null): mixed
```

**Parameters:**

| Parameter | Type                        | Description |
|-----------|-----------------------------|-------------|
| `$items`  | **?array**                  |             |
| `$count`  | **?int**                    |             |
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

### getItems

```php
public getItems(): \Upsun\Model\Team[]|null
```

***

### getCount

```php
public getCount(): ?int
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListLinks
```

***
