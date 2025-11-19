# OrganizationAddonsObject

Low level OrganizationAddonsObject (auto-generated)
The list of available and current add-ons of an organization.

***

* Full name: `\Upsun\Model\OrganizationAddonsObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### available

```php
private ?\Upsun\Model\OrganizationAddonsObjectAvailable $available
```

***

### current

```php
private ?\Upsun\Model\OrganizationAddonsObjectCurrent $current
```

***

### upgradesAvailable

```php
private ?\Upsun\Model\OrganizationAddonsObjectUpgradesAvailable $upgradesAvailable
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationAddonsObjectAvailable $available = null, ?\Upsun\Model\OrganizationAddonsObjectCurrent $current = null, ?\Upsun\Model\OrganizationAddonsObjectUpgradesAvailable $upgradesAvailable = null): mixed
```

**Parameters:**

| Parameter            | Type                                                        | Description |
|----------------------|-------------------------------------------------------------|-------------|
| `$available`         | **?\Upsun\Model\OrganizationAddonsObjectAvailable**         |             |
| `$current`           | **?\Upsun\Model\OrganizationAddonsObjectCurrent**           |             |
| `$upgradesAvailable` | **?\Upsun\Model\OrganizationAddonsObjectUpgradesAvailable** |             |

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

The list of available add-ons and their possible values.

```php
public getAvailable(): ?\Upsun\Model\OrganizationAddonsObjectAvailable
```

***

### getCurrent

The list of existing add-ons and their current values.

```php
public getCurrent(): ?\Upsun\Model\OrganizationAddonsObjectCurrent
```

***

### getUpgradesAvailable

The upgrades available for current add-ons.

```php
public getUpgradesAvailable(): ?\Upsun\Model\OrganizationAddonsObjectUpgradesAvailable
```

***
