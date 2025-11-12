# RegionEnvironmentalImpact

Low level RegionEnvironmentalImpact (auto-generated)

Information about the region provider's environmental impact.

***

* Full name: `\Upsun\Model\RegionEnvironmentalImpact`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### zone

```php
private ?string $zone
```

***

### carbonIntensity

```php
private ?string $carbonIntensity
```

***

### green

```php
private ?bool $green
```

***

## Methods

### __construct

```php
public __construct(?string $zone = null, ?string $carbonIntensity = null, ?bool $green = null): mixed
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$zone`            | **?string** |             |
| `$carbonIntensity` | **?string** |             |
| `$green`           | **?bool**   |             |

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

### getZone

```php
public getZone(): ?string
```

***

### getCarbonIntensity

```php
public getCarbonIntensity(): ?string
```

***

### getGreen

```php
public getGreen(): ?bool
```

***
