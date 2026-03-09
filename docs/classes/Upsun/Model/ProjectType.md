# ProjectType

Low level ProjectType (auto-generated)
The type of projects.

***

* Full name: `\Upsun\Model\ProjectType`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant    | Visibility | Type | Value       |
|-------------|------------|------|-------------|
| `GRID`      | public     |      | 'grid'      |
| `DEDICATED` | public     |      | 'dedicated' |

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
