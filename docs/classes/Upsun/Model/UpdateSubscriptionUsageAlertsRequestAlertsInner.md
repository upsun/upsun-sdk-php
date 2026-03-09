# UpdateSubscriptionUsageAlertsRequestAlertsInner

Low level UpdateSubscriptionUsageAlertsRequestAlertsInner (auto-generated)

***

* Full name: `\Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInner`
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

### active

```php
private ?bool $active
```

***

### config

```php
private ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig $config
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?bool $active = null, ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig $config = null): mixed
```

**Parameters:**

| Parameter | Type                                                                    | Description |
|-----------|-------------------------------------------------------------------------|-------------|
| `$id`     | **?string**                                                             |             |
| `$active` | **?bool**                                                               |             |
| `$config` | **?\Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig** |             |

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

```php
public getId(): ?string
```

***

### getActive

```php
public getActive(): ?bool
```

***

### getConfig

```php
public getConfig(): ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig
```

***
