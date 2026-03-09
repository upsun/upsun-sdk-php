# AcceptedResponse

Low level AcceptedResponse (auto-generated)

***

* Full name: `\Upsun\Model\AcceptedResponse`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### status

```php
private string $status
```

***

### code

```php
private int $code
```

***

## Methods

### __construct

```php
public __construct(string $status, int $code): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$status` | **string** |             |
| `$code`   | **int**    |             |

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

### getStatus

The status text of the response

```php
public getStatus(): string
```

***

### getCode

The status code of the response

```php
public getCode(): int
```

***
