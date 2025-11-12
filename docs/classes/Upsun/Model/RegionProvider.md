# RegionProvider

Low level RegionProvider (auto-generated)

Information about the region provider.

***

* Full name: `\Upsun\Model\RegionProvider`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### name

```php
private ?string $name
```

***

### logo

```php
private ?string $logo
```

***

## Methods

### __construct

```php
public __construct(?string $name = null, ?string $logo = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$name`   | **?string** |             |
| `$logo`   | **?string** |             |

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

### getName

```php
public getName(): ?string
```

***

### getLogo

```php
public getLogo(): ?string
```

***
