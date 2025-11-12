# EnvironmentSynchronizeInput

Low level EnvironmentSynchronizeInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentSynchronizeInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### synchronizeCode

```php
private bool $synchronizeCode
```

***

### rebase

```php
private bool $rebase
```

***

### synchronizeData

```php
private bool $synchronizeData
```

***

### synchronizeResources

```php
private bool $synchronizeResources
```

***

## Methods

### __construct

```php
public __construct(bool $synchronizeCode, bool $rebase, bool $synchronizeData, bool $synchronizeResources): mixed
```

**Parameters:**

| Parameter               | Type     | Description |
|-------------------------|----------|-------------|
| `$synchronizeCode`      | **bool** |             |
| `$rebase`               | **bool** |             |
| `$synchronizeData`      | **bool** |             |
| `$synchronizeResources` | **bool** |             |

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

### getSynchronizeCode

Synchronize code?

```php
public getSynchronizeCode(): bool
```

***

### getRebase

Synchronize code by rebasing instead of merging

```php
public getRebase(): bool
```

***

### getSynchronizeData

Synchronize data?

```php
public getSynchronizeData(): bool
```

***

### getSynchronizeResources

Synchronize resources?

```php
public getSynchronizeResources(): bool
```

***
