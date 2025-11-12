# ListProjectUserAccess200Response

Low level ListProjectUserAccess200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListProjectUserAccess200Response`
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

### links

```php
private ?\Upsun\Model\ListLinks $links
```

***

## Methods

### __construct

```php
public __construct(?array $items = [], ?\Upsun\Model\ListLinks $links = null): mixed
```

**Parameters:**

| Parameter | Type                        | Description |
|-----------|-----------------------------|-------------|
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

### getItems

```php
public getItems(): \Upsun\Model\UserProjectAccess[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListLinks
```

***
