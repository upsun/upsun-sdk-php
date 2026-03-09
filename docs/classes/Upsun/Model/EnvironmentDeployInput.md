# EnvironmentDeployInput

Low level EnvironmentDeployInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentDeployInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant             | Visibility | Type | Value       |
|----------------------|------------|------|-------------|
| `STRATEGY_ROLLING`   | public     |      | 'rolling'   |
| `STRATEGY_STOPSTART` | public     |      | 'stopstart' |

## Properties

### strategy

```php
private string $strategy
```

***

## Methods

### __construct

```php
public __construct(string $strategy): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$strategy` | **string** |             |

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

### getStrategy

The deployment strategy (`rolling` or `stopstart`)

```php
public getStrategy(): string
```

***
