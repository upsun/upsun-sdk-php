# CronsValue

Low level CronsValue (auto-generated)

***

* Full name: `\Upsun\Model\CronsValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### spec

```php
private string $spec
```

***

### commands

```php
private \Upsun\Model\Commands $commands
```

***

### timeout

```php
private int $timeout
```

***

### shutdownTimeout

```php
private ?int $shutdownTimeout
```

***

### cmd

```php
private ?string $cmd
```

***

## Methods

### __construct

```php
public __construct(string $spec, \Upsun\Model\Commands $commands, int $timeout, ?int $shutdownTimeout = null, ?string $cmd = null): mixed
```

**Parameters:**

| Parameter          | Type                      | Description |
|--------------------|---------------------------|-------------|
| `$spec`            | **string**                |             |
| `$commands`        | **\Upsun\Model\Commands** |             |
| `$timeout`         | **int**                   |             |
| `$shutdownTimeout` | **?int**                  |             |
| `$cmd`             | **?string**               |             |

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

### getSpec

```php
public getSpec(): string
```

***

### getCommands

```php
public getCommands(): \Upsun\Model\Commands
```

***

### getTimeout

```php
public getTimeout(): int
```

***

### getShutdownTimeout

```php
public getShutdownTimeout(): ?int
```

***

### getCmd

```php
public getCmd(): ?string
```

***
