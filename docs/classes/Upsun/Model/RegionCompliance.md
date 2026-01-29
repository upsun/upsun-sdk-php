# RegionCompliance

Low level RegionCompliance (auto-generated)
Information about the region's compliance.

***

* Full name: `\Upsun\Model\RegionCompliance`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### hipaa

```php
private ?bool $hipaa
```

***

## Methods

### __construct

```php
public __construct(?bool $hipaa = null): mixed
```

**Parameters:**

| Parameter | Type      | Description |
|-----------|-----------|-------------|
| `$hipaa`  | **?bool** |             |

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

### getHipaa

Indicator whether or not this region is HIPAA compliant.

```php
public getHipaa(): ?bool
```

***
