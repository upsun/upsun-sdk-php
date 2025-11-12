# DefaultConfig1

Low level DefaultConfig1 (auto-generated)

***

* Full name: `\Upsun\Model\DefaultConfig1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### manualCount

```php
private ?int $manualCount
```

***

### schedule

```php
private ?array $schedule
```

***

## Methods

### __construct

```php
public __construct(?int $manualCount = null, ?array $schedule = []): mixed
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$manualCount` | **?int**   |             |
| `$schedule`    | **?array** |             |

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

### getManualCount

```php
public getManualCount(): ?int
```

***

### getSchedule

```php
public getSchedule(): \Upsun\Model\ScheduleInner[]|null
```

***
