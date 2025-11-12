# PreflightChecks

Low level PreflightChecks (auto-generated)

***

* Full name: `\Upsun\Model\PreflightChecks`
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

### ignoredRules

```php
private array $ignoredRules
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, array $ignoredRules): mixed
```

**Parameters:**

| Parameter       | Type      | Description |
|-----------------|-----------|-------------|
| `$enabled`      | **bool**  |             |
| `$ignoredRules` | **array** |             |

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

### getIgnoredRules

```php
public getIgnoredRules(): array
```

***
