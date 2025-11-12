# AutoscalerScalingFactor

Low level AutoscalerScalingFactor (auto-generated)

Scaling factor settings

***

* Full name: `\Upsun\Model\AutoscalerScalingFactor`
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

Number of instances to add when scaling up horizontally

```php
public getUp(): ?int
```

***

### getDown

Number of instances to remove when scaling down horizontally

```php
public getDown(): ?int
```

***
