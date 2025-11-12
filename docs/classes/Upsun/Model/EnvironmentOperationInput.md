# EnvironmentOperationInput

Low level EnvironmentOperationInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentOperationInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### service

```php
private string $service
```

***

### operation

```php
private string $operation
```

***

### parameters

```php
private array $parameters
```

***

## Methods

### __construct

```php
public __construct(string $service, string $operation, array $parameters): mixed
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$service`    | **string** |             |
| `$operation`  | **string** |             |
| `$parameters` | **array**  |             |

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

### getService

The name of the application or worker to run the operation on

```php
public getService(): string
```

***

### getOperation

The name of the operation

```php
public getOperation(): string
```

***

### getParameters

```php
public getParameters(): array
```

***
