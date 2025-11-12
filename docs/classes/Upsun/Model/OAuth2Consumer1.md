# OAuth2Consumer1

Low level OAuth2Consumer1 (auto-generated)

The OAuth2 consumer information (optional).

***

* Full name: `\Upsun\Model\OAuth2Consumer1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### key

```php
private string $key
```

***

### secret

```php
private string $secret
```

***

## Methods

### __construct

```php
public __construct(string $key, string $secret): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$key`    | **string** |             |
| `$secret` | **string** |             |

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

### getKey

The OAuth consumer key.

```php
public getKey(): string
```

***

### getSecret

The OAuth consumer secret.

```php
public getSecret(): string
```

***
