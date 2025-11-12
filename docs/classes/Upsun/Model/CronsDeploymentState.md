# CronsDeploymentState

Low level CronsDeploymentState (auto-generated)

The crons deployment state

***

* Full name: `\Upsun\Model\CronsDeploymentState`
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

### status

```php
private string $status
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, string $status): mixed
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$enabled` | **bool**   |             |
| `$status`  | **string** |             |

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

Enabled or disabled

```php
public getEnabled(): bool
```

***

### getStatus

The status of the crons

```php
public getStatus(): string
```

***
