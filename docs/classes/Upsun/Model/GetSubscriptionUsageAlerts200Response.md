# GetSubscriptionUsageAlerts200Response

Low level GetSubscriptionUsageAlerts200Response (auto-generated)

***

* Full name: `\Upsun\Model\GetSubscriptionUsageAlerts200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### current

```php
private ?array $current
```

***

### available

```php
private ?array $available
```

***

## Methods

### __construct

```php
public __construct(?array $current = [], ?array $available = []): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$current`   | **?array** |             |
| `$available` | **?array** |             |

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

### getCurrent

```php
public getCurrent(): \Upsun\Model\UsageAlert[]|null
```

***

### getAvailable

```php
public getAvailable(): \Upsun\Model\UsageAlert[]|null
```

***
