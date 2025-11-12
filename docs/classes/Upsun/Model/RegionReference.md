# RegionReference

Low level RegionReference (auto-generated)

The referenced region, or null if it no longer exists.

***

* Full name: `\Upsun\Model\RegionReference`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### label

```php
private string $label
```

***

### zone

```php
private string $zone
```

***

### selectionLabel

```php
private string $selectionLabel
```

***

### projectLabel

```php
private string $projectLabel
```

***

### timezone

```php
private string $timezone
```

***

### available

```php
private bool $available
```

***

### endpoint

```php
private string $endpoint
```

***

### provider

```php
private object $provider
```

***

### datacenter

```php
private object $datacenter
```

***

### compliance

```php
private object $compliance
```

***

### createdAt

```php
private \DateTime $createdAt
```

***

### updatedAt

```php
private \DateTime $updatedAt
```

***

### private

```php
private ?bool $private
```

***

### code

```php
private ?string $code
```

***

### envimpact

```php
private ?object $envimpact
```

***

## Methods

### __construct

```php
public __construct(string $id, string $label, string $zone, string $selectionLabel, string $projectLabel, string $timezone, bool $available, string $endpoint, object $provider, object $datacenter, object $compliance, \DateTime $createdAt, \DateTime $updatedAt, ?bool $private = null, ?string $code = null, ?object $envimpact = null): mixed
```

**Parameters:**

| Parameter         | Type          | Description |
|-------------------|---------------|-------------|
| `$id`             | **string**    |             |
| `$label`          | **string**    |             |
| `$zone`           | **string**    |             |
| `$selectionLabel` | **string**    |             |
| `$projectLabel`   | **string**    |             |
| `$timezone`       | **string**    |             |
| `$available`      | **bool**      |             |
| `$endpoint`       | **string**    |             |
| `$provider`       | **object**    |             |
| `$datacenter`     | **object**    |             |
| `$compliance`     | **object**    |             |
| `$createdAt`      | **\DateTime** |             |
| `$updatedAt`      | **\DateTime** |             |
| `$private`        | **?bool**     |             |
| `$code`           | **?string**   |             |
| `$envimpact`      | **?object**   |             |

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

The machine name of the region where the project is located.

```php
public getId(): string
```

***

### getLabel

The human-readable name of the region.

```php
public getLabel(): string
```

***

### getZone

The geographical zone of the region.

```php
public getZone(): string
```

***

### getSelectionLabel

The label to display when choosing between regions for new projects.

```php
public getSelectionLabel(): string
```

***

### getProjectLabel

The label to display on existing projects.

```php
public getProjectLabel(): string
```

***

### getTimezone

Default timezone of the region.

```php
public getTimezone(): string
```

***

### getAvailable

Indicator whether or not this region is selectable during the checkout. Not available regions will never show up
during checkout.

```php
public getAvailable(): bool
```

***

### getEndpoint

Link to the region API endpoint.

```php
public getEndpoint(): string
```

***

### getProvider

Information about the region provider.

```php
public getProvider(): object
```

***

### getDatacenter

Information about the region provider data center.

```php
public getDatacenter(): object
```

***

### getCompliance

Information about the region's compliance.

```php
public getCompliance(): object
```

***

### getCreatedAt

The date and time when the resource was created.

```php
public getCreatedAt(): \DateTime
```

***

### getUpdatedAt

The date and time when the resource was last updated.

```php
public getUpdatedAt(): \DateTime
```

***

### getPrivate

Indicator whether or not this platform is for private use only.

```php
public getPrivate(): ?bool
```

***

### getCode

The code of the region

```php
public getCode(): ?string
```

***

### getEnvimpact

Information about the region provider's environmental impact.

```php
public getEnvimpact(): ?object
```

***
