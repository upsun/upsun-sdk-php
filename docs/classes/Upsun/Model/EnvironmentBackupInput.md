# EnvironmentBackupInput

Low level EnvironmentBackupInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentBackupInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### safe

```php
private bool $safe
```

***

## Methods

### __construct

```php
public __construct(bool $safe): mixed
```

**Parameters:**

| Parameter | Type     | Description |
|-----------|----------|-------------|
| `$safe`   | **bool** |             |

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

### getSafe

Take a safe or a live backup

```php
public getSafe(): bool
```

***
