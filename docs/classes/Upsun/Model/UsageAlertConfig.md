# UsageAlertConfig

Low level UsageAlertConfig (auto-generated)

Configuration for the usage alert.

***

* Full name: `\Upsun\Model\UsageAlertConfig`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### threshold

```php
private ?\Upsun\Model\UsageAlertConfigThreshold $threshold
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\UsageAlertConfigThreshold $threshold = null): mixed
```

**Parameters:**

| Parameter    | Type                                        | Description |
|--------------|---------------------------------------------|-------------|
| `$threshold` | **?\Upsun\Model\UsageAlertConfigThreshold** |             |

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
public getThreshold(): ?\Upsun\Model\UsageAlertConfigThreshold
```

***
