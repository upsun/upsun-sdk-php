# AutoscalerScalingCooldown

Low level AutoscalerScalingCooldown (auto-generated)

Scaling cooldown settings

***

* Full name: `\Upsun\Model\AutoscalerScalingCooldown`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### up

```php
private ?int $up
```

***

### down

```php
private ?int $down
```

***

## Methods

### __construct

```php
public __construct(?int $up = null, ?int $down = null): mixed
```

**Parameters:**

| Parameter | Type     | Description |
|-----------|----------|-------------|
| `$up`     | **?int** |             |
| `$down`   | **?int** |             |

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

### getUp

Number of seconds to wait until scaling up can be done again (since last attempt)

```php
public getUp(): ?int
```

***

### getDown

Number of seconds to wait until scaling down can be done again (since last attempt)

```php
public getDown(): ?int
```

***
