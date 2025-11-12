# AutoscalerDuration

Low level AutoscalerDuration (auto-generated)

***

* Full name: `\Upsun\Model\AutoscalerDuration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant      | Visibility | Type | Value |
|---------------|------------|------|-------|
| `NUMBER_60`   | public     |      | 60    |
| `NUMBER_120`  | public     |      | 120   |
| `NUMBER_300`  | public     |      | 300   |
| `NUMBER_600`  | public     |      | 600   |
| `NUMBER_1800` | public     |      | 1800  |
| `NUMBER_3600` | public     |      | 3600  |

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
