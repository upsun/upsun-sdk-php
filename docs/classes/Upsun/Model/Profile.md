# Profile

Low level Profile (auto-generated)
The user profile.

***

* Full name: `\Upsun\Model\Profile`
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

### displayName

```php
private ?string $displayName
```

***

### email

```php
private ?string $email
```

***

### username

```php
private ?string $username
```

***

### type

```php
private ?string $type
```

***

### picture

```php
private ?string $picture
```

***

### companyType

```php
private ?string $companyType
```

***

### companyName

```php
private ?string $companyName
```

***

### currency

```php
private ?string $currency
```

***

### vatNumber

```php
private ?string $vatNumber
```

***

### companyRole

```php
private ?string $companyRole
```

***

### websiteUrl

```php
private ?string $websiteUrl
```

***

### newUi

```php
private ?bool $newUi
```

***

### uiColorscheme

```php
private ?string $uiColorscheme
```

***

### defaultCatalog

```php
private ?string $defaultCatalog
```

***

### projectOptionsUrl

```php
private ?string $projectOptionsUrl
```

***

### marketing

```php
private ?bool $marketing
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

### billingContact

```php
private ?string $billingContact
```

***

### invoiced

```php
private ?bool $invoiced
```

***

### customerType

```php
private ?string $customerType
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $displayName = null, ?string $email = null, ?string $username = null, ?string $type = null, ?string $picture = null, ?string $companyType = null, ?string $companyName = null, ?string $currency = null, ?string $vatNumber = null, ?string $companyRole = null, ?string $websiteUrl = null, ?bool $newUi = null, ?string $uiColorscheme = null, ?string $defaultCatalog = null, ?string $projectOptionsUrl = null, ?bool $marketing = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?string $billingContact = null, ?bool $invoiced = null, ?string $customerType = null): mixed
```

**Parameters:**

| Parameter            | Type           | Description |
|----------------------|----------------|-------------|
| `$id`                | **?string**    |             |
| `$displayName`       | **?string**    |             |
| `$email`             | **?string**    |             |
| `$username`          | **?string**    |             |
| `$type`              | **?string**    |             |
| `$picture`           | **?string**    |             |
| `$companyType`       | **?string**    |             |
| `$companyName`       | **?string**    |             |
| `$currency`          | **?string**    |             |
| `$vatNumber`         | **?string**    |             |
| `$companyRole`       | **?string**    |             |
| `$websiteUrl`        | **?string**    |             |
| `$newUi`             | **?bool**      |             |
| `$uiColorscheme`     | **?string**    |             |
| `$defaultCatalog`    | **?string**    |             |
| `$projectOptionsUrl` | **?string**    |             |
| `$marketing`         | **?bool**      |             |
| `$createdAt`         | **?\DateTime** |             |
| `$updatedAt`         | **?\DateTime** |             |
| `$billingContact`    | **?string**    |             |
| `$invoiced`          | **?bool**      |             |
| `$customerType`      | **?string**    |             |

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

The user's unique ID.

```php
public getId(): ?string
```

***

### getDisplayName

The user's display name.

```php
public getDisplayName(): ?string
```

***

### getEmail

The user's email address.

```php
public getEmail(): ?string
```

***

### getUsername

The user's username.

```php
public getUsername(): ?string
```

***

### getType

The user's type (user/organization).

```php
public getType(): ?string
```

***

### getPicture

The URL of the user's picture.

```php
public getPicture(): ?string
```

***

### getCompanyType

The company type.

```php
public getCompanyType(): ?string
```

***

### getCompanyName

The name of the company.

```php
public getCompanyName(): ?string
```

***

### getCurrency

A 3-letter ISO 4217 currency code (assigned according to the billing address).

```php
public getCurrency(): ?string
```

***

### getVatNumber

The vat number of the user.

```php
public getVatNumber(): ?string
```

***

### getCompanyRole

The role of the user in the company.

```php
public getCompanyRole(): ?string
```

***

### getWebsiteUrl

The user or company website.

```php
public getWebsiteUrl(): ?string
```

***

### getNewUi

Whether the new UI features are enabled for this user.

```php
public getNewUi(): ?bool
```

***

### getUiColorscheme

The user's chosen color scheme for user interfaces.

```php
public getUiColorscheme(): ?string
```

***

### getDefaultCatalog

The URL of a catalog file which overrides the default.

```php
public getDefaultCatalog(): ?string
```

***

### getProjectOptionsUrl

The URL of an account-wide project options file.

```php
public getProjectOptionsUrl(): ?string
```

***

### getMarketing

Flag if the user agreed to receive marketing communication.

```php
public getMarketing(): ?bool
```

***

### getCreatedAt

The timestamp representing when the user account was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The timestamp representing when the user account was last modified.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getBillingContact

The e-mail address of a contact to whom billing notices will be sent.

```php
public getBillingContact(): ?string
```

***

### getInvoiced

The customer is invoiced.

```php
public getInvoiced(): ?bool
```

***

### getCustomerType

The customer type.

```php
public getCustomerType(): ?string
```

***
