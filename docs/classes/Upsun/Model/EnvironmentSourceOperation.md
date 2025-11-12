# EnvironmentSourceOperation

Low level EnvironmentSourceOperation (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentSourceOperation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### app

```php
private string $app
```

***

### operation

```php
private string $operation
```

***

### command

```php
private string $command
```

***

## Methods

### __construct

```php
public __construct(string $id, string $app, string $operation, string $command): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$id`        | **string** |             |
| `$app`       | **string** |             |
| `$operation` | **string** |             |
| `$command`   | **string** |             |

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

### getId

The identifier of EnvironmentSourceOperation

```php
public getId(): string
```

***

### getApp

The name of the application

```php
public getApp(): string
```

***

### getOperation

The name of the source operation

```php
public getOperation(): string
```

***

### getCommand

The command that will be triggered

```php
public getCommand(): string
```

***
