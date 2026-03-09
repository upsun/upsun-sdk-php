# SubscriptionAddonsObject

Low level SubscriptionAddonsObject (auto-generated)
The list of available and current addons for the license.

***

* Full name: `\Upsun\Model\SubscriptionAddonsObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### available

```php
private ?\Upsun\Model\SubscriptionAddonsObjectAvailable $available
```

***

### current

```php
private ?\Upsun\Model\SubscriptionAddonsObjectCurrent $current
```

***

### upgradesAvailable

```php
private ?\Upsun\Model\SubscriptionAddonsObjectUpgradesAvailable $upgradesAvailable
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\SubscriptionAddonsObjectAvailable $available = null, ?\Upsun\Model\SubscriptionAddonsObjectCurrent $current = null, ?\Upsun\Model\SubscriptionAddonsObjectUpgradesAvailable $upgradesAvailable = null): mixed
```

**Parameters:**

| Parameter            | Type                                                        | Description |
|----------------------|-------------------------------------------------------------|-------------|
| `$available`         | **?\Upsun\Model\SubscriptionAddonsObjectAvailable**         |             |
| `$current`           | **?\Upsun\Model\SubscriptionAddonsObjectCurrent**           |             |
| `$upgradesAvailable` | **?\Upsun\Model\SubscriptionAddonsObjectUpgradesAvailable** |             |

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

The list of available addons.

```php
public getAvailable(): ?\Upsun\Model\SubscriptionAddonsObjectAvailable
```

***

### getCurrent

The list of existing addons and their current values.

```php
public getCurrent(): ?\Upsun\Model\SubscriptionAddonsObjectCurrent
```

***

### getUpgradesAvailable

The upgrades available for current addons.

```php
public getUpgradesAvailable(): ?\Upsun\Model\SubscriptionAddonsObjectUpgradesAvailable
```

***
