# AutoscalerServiceSettings

Low level AutoscalerServiceSettings (auto-generated)
Autoscaling settings for a specific service

***

* Full name: `\Upsun\Model\AutoscalerServiceSettings`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### triggers

```php
private ?\Upsun\Model\AutoscalerTriggers $triggers
```

***

### instances

```php
private ?\Upsun\Model\AutoscalerInstances $instances
```

***

### resources

```php
private ?\Upsun\Model\AutoscalerResources $resources
```

***

### scaleFactor

```php
private ?\Upsun\Model\AutoscalerScalingFactor $scaleFactor
```

***

### scaleCooldown

```php
private ?\Upsun\Model\AutoscalerScalingCooldown $scaleCooldown
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\AutoscalerTriggers $triggers = null, ?\Upsun\Model\AutoscalerInstances $instances = null, ?\Upsun\Model\AutoscalerResources $resources = null, ?\Upsun\Model\AutoscalerScalingFactor $scaleFactor = null, ?\Upsun\Model\AutoscalerScalingCooldown $scaleCooldown = null): mixed
```

**Parameters:**

| Parameter        | Type                                        | Description |
|------------------|---------------------------------------------|-------------|
| `$triggers`      | **?\Upsun\Model\AutoscalerTriggers**        |             |
| `$instances`     | **?\Upsun\Model\AutoscalerInstances**       |             |
| `$resources`     | **?\Upsun\Model\AutoscalerResources**       |             |
| `$scaleFactor`   | **?\Upsun\Model\AutoscalerScalingFactor**   |             |
| `$scaleCooldown` | **?\Upsun\Model\AutoscalerScalingCooldown** |             |

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

### getTriggers

Scaling triggers settings

```php
public getTriggers(): ?\Upsun\Model\AutoscalerTriggers
```

***

### getInstances

Horizontal scaling settings

```php
public getInstances(): ?\Upsun\Model\AutoscalerInstances
```

***

### getResources

Vertical scaling settings

```php
public getResources(): ?\Upsun\Model\AutoscalerResources
```

***

### getScaleFactor

Scaling factor settings

```php
public getScaleFactor(): ?\Upsun\Model\AutoscalerScalingFactor
```

***

### getScaleCooldown

Scaling cooldown settings

```php
public getScaleCooldown(): ?\Upsun\Model\AutoscalerScalingCooldown
```

***
