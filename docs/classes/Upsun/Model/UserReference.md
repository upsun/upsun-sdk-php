# UserReference

Low level UserReference (auto-generated)

The referenced user, or null if it no longer exists.

***

* Full name: `\Upsun\Model\UserReference`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### username

```php
private ?string $username
```

***

### email

```php
private ?string $email
```

***

### firstName

```php
private ?string $firstName
```

***

### lastName

```php
private ?string $lastName
```

***

### picture

```php
private ?string $picture
```

***

### mfaEnabled

```php
private ?bool $mfaEnabled
```

***

### ssoEnabled

```php
private ?bool $ssoEnabled
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $username = null, ?string $email = null, ?string $firstName = null, ?string $lastName = null, ?string $picture = null, ?bool $mfaEnabled = null, ?bool $ssoEnabled = null): mixed
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$id`         | **?string** |             |
| `$username`   | **?string** |             |
| `$email`      | **?string** |             |
| `$firstName`  | **?string** |             |
| `$lastName`   | **?string** |             |
| `$picture`    | **?string** |             |
| `$mfaEnabled` | **?bool**   |             |
| `$ssoEnabled` | **?bool**   |             |

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

The ID of the user.

```php
public getId(): ?string
```

***

### getUsername

The user's username.

```php
public getUsername(): ?string
```

***

### getEmail

The user's email address.

```php
public getEmail(): ?string
```

***

### getFirstName

The user's first name.

```php
public getFirstName(): ?string
```

***

### getLastName

The user's last name.

```php
public getLastName(): ?string
```

***

### getPicture

The user's picture.

```php
public getPicture(): ?string
```

***

### getMfaEnabled

Whether the user has enabled MFA. Note: the built-in MFA feature may not be necessary if the user is linked to a
mandatory SSO provider that itself supports MFA (see "sso_enabled\").

```php
public getMfaEnabled(): ?bool
```

***

### getSsoEnabled

Whether the user is linked to a mandatory SSO provider.

```php
public getSsoEnabled(): ?bool
```

***
