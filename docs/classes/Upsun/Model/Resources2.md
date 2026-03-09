# Resources2

Low level Resources2 (auto-generated)

***

* Full name: `\Upsun\Model\Resources2`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant        | Visibility | Type | Value     |
|-----------------|------------|------|-----------|
| `INIT__DEFAULT` | public     |      | 'default' |
| `INIT_MINIMUM`  | public     |      | 'minimum' |
| `INIT_PARENT`   | public     |      | 'parent'  |

## Properties

### init

```php
private ?string $init
```

***

## Methods

### __construct

```php
public __construct(?string $init): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$init`   | **?string** |             |

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

### getInit

The resources used when activating an environment

```php
public getInit(): ?string
```

***
