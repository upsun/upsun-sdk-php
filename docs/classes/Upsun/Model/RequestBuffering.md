# RequestBuffering

Low level RequestBuffering (auto-generated)

***

* Full name: `\Upsun\Model\RequestBuffering`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private bool $enabled
```

***

### maxRequestSize

```php
private ?string $maxRequestSize
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, ?string $maxRequestSize): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$enabled`        | **bool**    |             |
| `$maxRequestSize` | **?string** |             |

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

```php
public getEnabled(): bool
```

***

### getMaxRequestSize

```php
public getMaxRequestSize(): ?string
```

***
