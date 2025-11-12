# AutoscalerMemoryTrigger

Low level AutoscalerMemoryTrigger (auto-generated)

Memory resource trigger settings. When memory usage goes below lower bound, service will be scaled down. When
memory usage goes above upper bound, service will be scaled up.

***

* Full name: `\Upsun\Model\AutoscalerMemoryTrigger`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private ?bool $enabled
```

***

### down

```php
private ?\Upsun\Model\AutoscalerCondition $down
```

***

### up

```php
private ?\Upsun\Model\AutoscalerCondition $up
```

***

## Methods

### __construct

```php
public __construct(?bool $enabled = null, ?\Upsun\Model\AutoscalerCondition $down = null, ?\Upsun\Model\AutoscalerCondition $up = null): mixed
```

**Parameters:**

| Parameter  | Type                                  | Description |
|------------|---------------------------------------|-------------|
| `$enabled` | **?bool**                             |             |
| `$down`    | **?\Upsun\Model\AutoscalerCondition** |             |
| `$up`      | **?\Upsun\Model\AutoscalerCondition** |             |

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

### getEnabled

Whether the trigger is enabled

```php
public getEnabled(): ?bool
```

***

### getDown

Trigger condition settings

```php
public getDown(): ?\Upsun\Model\AutoscalerCondition
```

***

### getUp

Trigger condition settings

```php
public getUp(): ?\Upsun\Model\AutoscalerCondition
```

***
