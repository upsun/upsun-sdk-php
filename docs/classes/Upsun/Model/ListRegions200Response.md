# ListRegions200Response

Low level ListRegions200Response (auto-generated)

***

* Full name: `\Upsun\Model\ListRegions200Response`
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

### regions

```php
private ?array $regions
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
public __construct(?int $count = null, ?array $regions = [], ?\Upsun\Model\ListLinks $links = null): mixed
```

**Parameters:**

| Parameter  | Type                        | Description |
|------------|-----------------------------|-------------|
| `$count`   | **?int**                    |             |
| `$regions` | **?array**                  |             |
| `$links`   | **?\Upsun\Model\ListLinks** |             |

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

### getRegions

```php
public getRegions(): \Upsun\Model\Region[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ListLinks
```

***
