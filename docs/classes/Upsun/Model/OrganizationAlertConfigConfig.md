# OrganizationAlertConfigConfig

Low level OrganizationAlertConfigConfig (auto-generated)
Configuration for threshold and mode.

***

* Full name: `\Upsun\Model\OrganizationAlertConfigConfig`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### threshold

```php
private ?\Upsun\Model\OrganizationAlertConfigConfigThreshold $threshold
```

***

### mode

```php
private ?string $mode
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationAlertConfigConfigThreshold $threshold = null, ?string $mode = null): mixed
```

**Parameters:**

| Parameter    | Type                                                     | Description |
|--------------|----------------------------------------------------------|-------------|
| `$threshold` | **?\Upsun\Model\OrganizationAlertConfigConfigThreshold** |             |
| `$mode`      | **?string**                                              |             |

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

### getThreshold

Data regarding threshold spend.

```php
public getThreshold(): ?\Upsun\Model\OrganizationAlertConfigConfigThreshold
```

***

### getMode

The mode of alert.

```php
public getMode(): ?string
```

***
