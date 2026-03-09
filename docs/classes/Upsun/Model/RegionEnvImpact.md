# RegionEnvImpact

Low level RegionEnvImpact (auto-generated)
Information about the region provider's environmental impact.

***

* Full name: `\Upsun\Model\RegionEnvImpact`
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
private ?float $carbonIntensity
```

***

### carbonIntensitySource

```php
private ?string $carbonIntensitySource
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
public __construct(?string $zone = null, ?float $carbonIntensity = null, ?string $carbonIntensitySource = null, ?bool $green = null): mixed
```

**Parameters:**

| Parameter                | Type        | Description |
|--------------------------|-------------|-------------|
| `$zone`                  | **?string** |             |
| `$carbonIntensity`       | **?float**  |             |
| `$carbonIntensitySource` | **?string** |             |
| `$green`                 | **?bool**   |             |

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

The geographical zone code for carbon intensity.

```php
public getZone(): ?string
```

***

### getCarbonIntensity

The carbon intensity value.

```php
public getCarbonIntensity(): ?float
```

***

### getCarbonIntensitySource

The source of the carbon intensity data.

```php
public getCarbonIntensitySource(): ?string
```

***

### getGreen

Indicator whether the data center uses green energy.

```php
public getGreen(): ?bool
```

***
