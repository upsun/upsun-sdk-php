# Resources5

Low level Resources5 (auto-generated)

***

* Full name: `\Upsun\Model\Resources5`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant        | Visibility | Type | Value     |
|-----------------|------------|------|-----------|
| `INIT_CHILD`    | public     |      | 'child'   |
| `INIT__DEFAULT` | public     |      | 'default' |
| `INIT_MANUAL`   | public     |      | 'manual'  |
| `INIT_MINIMUM`  | public     |      | 'minimum' |

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

The resources used when merging an environment

```php
public getInit(): ?string
```

***
