# ConfirmTotpEnrollmentRequest

Low level ConfirmTotpEnrollmentRequest (auto-generated)

***

* Full name: `\Upsun\Model\ConfirmTotpEnrollmentRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### secret

```php
private string $secret
```

***

### passcode

```php
private string $passcode
```

***

## Methods

### __construct

```php
public __construct(string $secret, string $passcode): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$secret`   | **string** |             |
| `$passcode` | **string** |             |

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

### getSecret

```php
public getSecret(): string
```

***

### getPasscode

```php
public getPasscode(): string
```

***
