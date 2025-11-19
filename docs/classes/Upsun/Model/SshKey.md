# SshKey

Low level SshKey (auto-generated)
The ssh key object.

***

* Full name: `\Upsun\Model\SshKey`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### keyId

```php
private ?int $keyId
```

***

### uid

```php
private ?int $uid
```

***

### fingerprint

```php
private ?string $fingerprint
```

***

### title

```php
private ?string $title
```

***

### value

```php
private ?string $value
```

***

### changed

```php
private ?string $changed
```

***

## Methods

### __construct

```php
public __construct(?int $keyId = null, ?int $uid = null, ?string $fingerprint = null, ?string $title = null, ?string $value = null, ?string $changed = null): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$keyId`       | **?int**    |             |
| `$uid`         | **?int**    |             |
| `$fingerprint` | **?string** |             |
| `$title`       | **?string** |             |
| `$value`       | **?string** |             |
| `$changed`     | **?string** |             |

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

### getKeyId

The ID of the public key.

```php
public getKeyId(): ?int
```

***

### getUid

The internal user ID.

```php
public getUid(): ?int
```

***

### getFingerprint

The fingerprint of the public key.

```php
public getFingerprint(): ?string
```

***

### getTitle

The title of the public key.

```php
public getTitle(): ?string
```

***

### getValue

The actual value of the public key.

```php
public getValue(): ?string
```

***

### getChanged

The time of the last key modification (ISO 8601)

```php
public getChanged(): ?string
```

***
