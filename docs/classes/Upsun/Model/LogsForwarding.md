# LogsForwarding

Low level LogsForwarding (auto-generated)

***

* Full name: `\Upsun\Model\LogsForwarding`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### maxExtraPayloadSize

```php
private int $maxExtraPayloadSize
```

***

## Methods

### __construct

```php
public __construct(int $maxExtraPayloadSize): mixed
```

**Parameters:**

| Parameter              | Type    | Description |
|------------------------|---------|-------------|
| `$maxExtraPayloadSize` | **int** |             |

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

### getMaxExtraPayloadSize

Limit on the maximum size for the custom extra attributes added to the forwarded logs payload

```php
public getMaxExtraPayloadSize(): int
```

***
