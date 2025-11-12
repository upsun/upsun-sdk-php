# ProjectOptions

Low level ProjectOptions (auto-generated)

The project options object.

***

* Full name: `\Upsun\Model\ProjectOptions`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### defaults

```php
private ?\Upsun\Model\ProjectOptionsDefaults $defaults
```

***

### enforced

```php
private ?\Upsun\Model\ProjectOptionsEnforced $enforced
```

***

### regions

```php
private ?array $regions
```

***

### plans

```php
private ?array $plans
```

***

### billing

```php
private ?object $billing
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\ProjectOptionsDefaults $defaults = null, ?\Upsun\Model\ProjectOptionsEnforced $enforced = null, ?array $regions = [], ?array $plans = [], ?object $billing = null): mixed
```

**Parameters:**

| Parameter   | Type                                     | Description |
|-------------|------------------------------------------|-------------|
| `$defaults` | **?\Upsun\Model\ProjectOptionsDefaults** |             |
| `$enforced` | **?\Upsun\Model\ProjectOptionsEnforced** |             |
| `$regions`  | **?array**                               |             |
| `$plans`    | **?array**                               |             |
| `$billing`  | **?object**                              |             |

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

### getDefaults

The initial values applied to the project.

```php
public getDefaults(): ?\Upsun\Model\ProjectOptionsDefaults
```

***

### getEnforced

The enforced values applied to the project.

```php
public getEnforced(): ?\Upsun\Model\ProjectOptionsEnforced
```

***

### getRegions

```php
public getRegions(): ?array
```

***

### getPlans

```php
public getPlans(): ?array
```

***

### getBilling

The billing settings.

```php
public getBilling(): ?object
```

***
