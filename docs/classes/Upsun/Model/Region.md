# Region

Low level Region (auto-generated)

The hosting region.

***

* Full name: `\Upsun\Model\Region`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### label

```php
private ?string $label
```

***

### zone

```php
private ?string $zone
```

***

### selectionLabel

```php
private ?string $selectionLabel
```

***

### projectLabel

```php
private ?string $projectLabel
```

***

### timezone

```php
private ?string $timezone
```

***

### available

```php
private ?bool $available
```

***

### private

```php
private ?bool $private
```

***

### endpoint

```php
private ?string $endpoint
```

***

### provider

```php
private ?\Upsun\Model\RegionProvider $provider
```

***

### datacenter

```php
private ?\Upsun\Model\RegionDatacenter $datacenter
```

***

### environmentalImpact

```php
private ?\Upsun\Model\RegionEnvironmentalImpact $environmentalImpact
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $label = null, ?string $zone = null, ?string $selectionLabel = null, ?string $projectLabel = null, ?string $timezone = null, ?bool $available = null, ?bool $private = null, ?string $endpoint = null, ?\Upsun\Model\RegionProvider $provider = null, ?\Upsun\Model\RegionDatacenter $datacenter = null, ?\Upsun\Model\RegionEnvironmentalImpact $environmentalImpact = null): mixed
```

**Parameters:**

| Parameter              | Type                                        | Description |
|------------------------|---------------------------------------------|-------------|
| `$id`                  | **?string**                                 |             |
| `$label`               | **?string**                                 |             |
| `$zone`                | **?string**                                 |             |
| `$selectionLabel`      | **?string**                                 |             |
| `$projectLabel`        | **?string**                                 |             |
| `$timezone`            | **?string**                                 |             |
| `$available`           | **?bool**                                   |             |
| `$private`             | **?bool**                                   |             |
| `$endpoint`            | **?string**                                 |             |
| `$provider`            | **?\Upsun\Model\RegionProvider**            |             |
| `$datacenter`          | **?\Upsun\Model\RegionDatacenter**          |             |
| `$environmentalImpact` | **?\Upsun\Model\RegionEnvironmentalImpact** |             |

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

### getId

The ID of the region.

```php
public getId(): ?string
```

***

### getLabel

The human-readable name of the region.

```php
public getLabel(): ?string
```

***

### getZone

Geographical zone of the region

```php
public getZone(): ?string
```

***

### getSelectionLabel

The label to display when choosing between regions for new projects.

```php
public getSelectionLabel(): ?string
```

***

### getProjectLabel

The label to display on existing projects.

```php
public getProjectLabel(): ?string
```

***

### getTimezone

Default timezone of the region

```php
public getTimezone(): ?string
```

***

### getAvailable

Indicator whether or not this region is selectable during the checkout. Not available regions will never show up
during checkout.

```php
public getAvailable(): ?bool
```

***

### getPrivate

Indicator whether or not this platform is for private use only.

```php
public getPrivate(): ?bool
```

***

### getEndpoint

Link to the region API endpoint.

```php
public getEndpoint(): ?string
```

***

### getProvider

Information about the region provider.

```php
public getProvider(): ?\Upsun\Model\RegionProvider
```

***

### getDatacenter

Information about the region provider data center.

```php
public getDatacenter(): ?\Upsun\Model\RegionDatacenter
```

***

### getEnvironmentalImpact

Information about the region provider's environmental impact.

```php
public getEnvironmentalImpact(): ?\Upsun\Model\RegionEnvironmentalImpact
```

***
