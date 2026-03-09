# WorkerConfiguration

Low level WorkerConfiguration (auto-generated)

***

* Full name: `\Upsun\Model\WorkerConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### commands

```php
private \Upsun\Model\Commands2 $commands
```

***

### disk

```php
private ?int $disk
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Model\Commands2 $commands, ?int $disk = null): mixed
```

**Parameters:**

| Parameter   | Type                       | Description |
|-------------|----------------------------|-------------|
| `$commands` | **\Upsun\Model\Commands2** |             |
| `$disk`     | **?int**                   |             |

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

### getCommands

```php
public getCommands(): \Upsun\Model\Commands2
```

***

### getDisk

```php
public getDisk(): ?int
```

***
