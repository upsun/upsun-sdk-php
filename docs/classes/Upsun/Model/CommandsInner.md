# CommandsInner

Low level CommandsInner (auto-generated)

***

* Full name: `\Upsun\Model\CommandsInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### app

```php
private string $app
```

***

### type

```php
private string $type
```

***

### exitCode

```php
private int $exitCode
```

***

## Methods

### __construct

```php
public __construct(string $app, string $type, int $exitCode): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$app`      | **string** |             |
| `$type`     | **string** |             |
| `$exitCode` | **int**    |             |

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

### getApp

```php
public getApp(): string
```

***

### getType

```php
public getType(): string
```

***

### getExitCode

```php
public getExitCode(): int
```

***
