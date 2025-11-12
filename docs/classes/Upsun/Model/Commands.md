# Commands

Low level Commands (auto-generated)

***

* Full name: `\Upsun\Model\Commands`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### start

```php
private string $start
```

***

### stop

```php
private ?string $stop
```

***

## Methods

### __construct

```php
public __construct(string $start, ?string $stop = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$start`  | **string**  |             |
| `$stop`   | **?string** |             |

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

### getStart

```php
public getStart(): string
```

***

### getStop

```php
public getStop(): ?string
```

***
