# ProjectStatus

Low level ProjectStatus (auto-generated)
The status of the project.

***

* Full name: `\Upsun\Model\ProjectStatus`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant    | Visibility | Type | Value       |
|-------------|------------|------|-------------|
| `REQUESTED` | public     |      | 'requested' |
| `ACTIVE`    | public     |      | 'active'    |
| `FAILED`    | public     |      | 'failed'    |
| `SUSPENDED` | public     |      | 'suspended' |
| `DELETED`   | public     |      | 'deleted'   |

## Properties

### value

```php
private string $value
```

***

## Methods

### __construct

```php
public __construct(string $value): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$value`  | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if value is not allowed


***

### getValue

Get the enum value

```php
public getValue(): string
```

***

### getAllowableEnumValues

Gets allowable values of the enum

```php
public static getAllowableEnumValues(): array
```

* This method is **static**.
***

### jsonSerialize

```php
public jsonSerialize(): string
```

***

### __toString

```php
public __toString(): string
```

***
