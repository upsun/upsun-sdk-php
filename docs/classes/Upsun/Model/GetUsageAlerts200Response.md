# GetUsageAlerts200Response

Low level GetUsageAlerts200Response (auto-generated)

***

* Full name: `\Upsun\Model\GetUsageAlerts200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### available

```php
private ?array $available
```

***

### current

```php
private ?array $current
```

***

## Methods

### __construct

```php
public __construct(?array $available = [], ?array $current = []): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$available` | **?array** |             |
| `$current`   | **?array** |             |

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

### getAvailable

```php
public getAvailable(): \Upsun\Model\Alert[]|null
```

***

### getCurrent

```php
public getCurrent(): \Upsun\Model\Alert[]|null
```

***
