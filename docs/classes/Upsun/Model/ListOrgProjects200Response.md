# ListOrgProjects200Response

Low level ListOrgProjects200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListOrgProjects200Response`
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

### facets

```php
private ?\Upsun\Model\ProjectFacets $facets
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
public __construct(?int $count = null, ?array $items = [], ?\Upsun\Model\ProjectFacets $facets = null, ?\Upsun\Model\ListLinks $links = null): mixed
```

**Parameters:**

| Parameter | Type                            | Description |
|-----------|---------------------------------|-------------|
| `$count`  | **?int**                        |             |
| `$items`  | **?array**                      |             |
| `$facets` | **?\Upsun\Model\ProjectFacets** |             |
| `$links`  | **?\Upsun\Model\ListLinks**     |             |

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
public getItems(): \Upsun\Model\OrganizationProject[]|null
```

***

### getFacets

Facets for filtering options.

```php
public getFacets(): ?\Upsun\Model\ProjectFacets
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListLinks
```

***
