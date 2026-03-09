# OperationsValue

Low level OperationsValue (auto-generated)

***

* Full name: `\Upsun\Model\OperationsValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant           | Visibility | Type | Value         |
|--------------------|------------|------|---------------|
| `ROLE_ADMIN`       | public     |      | 'admin'       |
| `ROLE_CONTRIBUTOR` | public     |      | 'contributor' |
| `ROLE_VIEWER`      | public     |      | 'viewer'      |

## Properties

### commands

```php
private \Upsun\Model\Commands $commands
```

***

### role

```php
private string $role
```

***

### timeout

```php
private ?int $timeout
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Model\Commands $commands, string $role, ?int $timeout): mixed
```

**Parameters:**

| Parameter   | Type                      | Description |
|-------------|---------------------------|-------------|
| `$commands` | **\Upsun\Model\Commands** |             |
| `$role`     | **string**                |             |
| `$timeout`  | **?int**                  |             |

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

### getCommands

```php
public getCommands(): \Upsun\Model\Commands
```

***

### getTimeout

```php
public getTimeout(): ?int
```

***

### getRole

```php
public getRole(): string
```

***
