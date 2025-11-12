# User

Low level User (auto-generated)

***

* Full name: `\Upsun\Model\User`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### deactivated

```php
private bool $deactivated
```

***

### namespace

```php
private string $namespace
```

***

### username

```php
private string $username
```

***

### email

```php
private string $email
```

***

### emailVerified

```php
private bool $emailVerified
```

***

### firstName

```php
private string $firstName
```

***

### lastName

```php
private string $lastName
```

***

### picture

```php
private string $picture
```

***

### company

```php
private string $company
```

***

### website

```php
private string $website
```

***

### country

```php
private string $country
```

***

### createdAt

```php
private \DateTime $createdAt
```

***

### updatedAt

```php
private \DateTime $updatedAt
```

***

### consentedAt

```php
private ?\DateTime $consentedAt
```

***

### consentMethod

```php
private ?string $consentMethod
```

***

## Methods

### __construct

```php
public __construct(string $id, bool $deactivated, string $namespace, string $username, string $email, bool $emailVerified, string $firstName, string $lastName, string $picture, string $company, string $website, string $country, \DateTime $createdAt, \DateTime $updatedAt, ?\DateTime $consentedAt = null, ?string $consentMethod = null): mixed
```

**Parameters:**

| Parameter        | Type           | Description |
|------------------|----------------|-------------|
| `$id`            | **string**     |             |
| `$deactivated`   | **bool**       |             |
| `$namespace`     | **string**     |             |
| `$username`      | **string**     |             |
| `$email`         | **string**     |             |
| `$emailVerified` | **bool**       |             |
| `$firstName`     | **string**     |             |
| `$lastName`      | **string**     |             |
| `$picture`       | **string**     |             |
| `$company`       | **string**     |             |
| `$website`       | **string**     |             |
| `$country`       | **string**     |             |
| `$createdAt`     | **\DateTime**  |             |
| `$updatedAt`     | **\DateTime**  |             |
| `$consentedAt`   | **?\DateTime** |             |
| `$consentMethod` | **?string**    |             |

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
public getId(): string
```

***

### getDeactivated

Whether the user has been deactivated.

```php
public getDeactivated(): bool
```

***

### getNamespace

The namespace in which the user's username is unique.

```php
public getNamespace(): string
```

***

### getUsername

The user's username.

```php
public getUsername(): string
```

***

### getEmail

The user's email address.

```php
public getEmail(): string
```

***

### getEmailVerified

Whether the user's email address has been verified.

```php
public getEmailVerified(): bool
```

***

### getFirstName

The user's first name.

```php
public getFirstName(): string
```

***

### getLastName

The user's last name.

```php
public getLastName(): string
```

***

### getPicture

The user's picture.

```php
public getPicture(): string
```

***

### getCompany

The user's company.

```php
public getCompany(): string
```

***

### getWebsite

The user's website.

```php
public getWebsite(): string
```

***

### getCountry

The user's ISO 3166-1 alpha-2 country code.

```php
public getCountry(): string
```

***

### getCreatedAt

The date and time when the user was created.

```php
public getCreatedAt(): \DateTime
```

***

### getUpdatedAt

The date and time when the user was last updated.

```php
public getUpdatedAt(): \DateTime
```

***

### getConsentedAt

The date and time when the user consented to the Terms of Service.

```php
public getConsentedAt(): ?\DateTime
```

***

### getConsentMethod

The method by which the user consented to the Terms of Service.

```php
public getConsentMethod(): ?string
```

***
