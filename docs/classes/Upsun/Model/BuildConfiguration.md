# BuildConfiguration

Low level BuildConfiguration (auto-generated)

***

* Full name: `\Upsun\Model\BuildConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### caches

```php
private array $caches
```

***

### flavor

```php
private ?string $flavor
```

***

## Methods

### __construct

```php
public __construct(array $caches, ?string $flavor): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$caches` | **array**   |             |
| `$flavor` | **?string** |             |

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

### getFlavor

```php
public getFlavor(): ?string
```

***

### getCaches

```php
public getCaches(): \Upsun\Model\BuildCachesValue[]
```

***
