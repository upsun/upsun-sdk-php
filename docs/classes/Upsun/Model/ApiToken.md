# ApiToken

Low level ApiToken (auto-generated)

***

* Full name: `\Upsun\Model\ApiToken`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### lastUsedAt

```php
private ?\DateTime $lastUsedAt
```

***

### id

```php
private ?string $id
```

***

### name

```php
private ?string $name
```

***

### mfaOnCreation

```php
private ?bool $mfaOnCreation
```

***

### token

```php
private ?string $token
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $lastUsedAt = null, ?string $id = null, ?string $name = null, ?bool $mfaOnCreation = null, ?string $token = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter        | Type           | Description |
|------------------|----------------|-------------|
| `$lastUsedAt`    | **?\DateTime** |             |
| `$id`            | **?string**    |             |
| `$name`          | **?string**    |             |
| `$mfaOnCreation` | **?bool**      |             |
| `$token`         | **?string**    |             |
| `$createdAt`     | **?\DateTime** |             |
| `$updatedAt`     | **?\DateTime** |             |

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

### getId

The ID of the token.

```php
public getId(): ?string
```

***

### getName

The token name.

```php
public getName(): ?string
```

***

### getMfaOnCreation

Whether the user had multi-factor authentication (MFA) enabled when they created the token.

```php
public getMfaOnCreation(): ?bool
```

***

### getToken

The token in plain text (available only when created).

```php
public getToken(): ?string
```

***

### getCreatedAt

The date and time when the token was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the token was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLastUsedAt

The date and time when the token was last exchanged for an access token. This will be <code>null</code> for a
token which has never been used, or not used since this API property was added. <strong>Note:</strong> After an
API token is used, the derived access token may continue to be used until its expiry. This also applies to SSH
certificate(s) derived from the access token.

```php
public getLastUsedAt(): ?\DateTime
```

***
