# EnvironmentSourceOperationInput

Low level EnvironmentSourceOperationInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentSourceOperationInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### operation

```php
private string $operation
```

***

### variables

```php
private array $variables
```

***

## Methods

### __construct

```php
public __construct(string $operation, array $variables): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$operation` | **string** |             |
| `$variables` | **array**  |             |

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

### getOperation

The name of the operation to execute

```php
public getOperation(): string
```

***

### getVariables

```php
public getVariables(): array
```

***
