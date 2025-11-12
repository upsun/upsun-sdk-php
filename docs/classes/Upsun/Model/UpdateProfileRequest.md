# UpdateProfileRequest

Low level UpdateProfileRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateProfileRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### displayName

```php
private ?string $displayName
```

***

### username

```php
private ?string $username
```

***

### currentPassword

```php
private ?string $currentPassword
```

***

### password

```php
private ?string $password
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

### marketing

```php
private ?bool $marketing
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

### picture

```php
private ?string $picture
```

***

## Methods

### __construct

```php
public __construct(?string $displayName = null, ?string $username = null, ?string $currentPassword = null, ?string $password = null, ?string $companyType = null, ?string $companyName = null, ?string $vatNumber = null, ?string $companyRole = null, ?bool $marketing = null, ?string $uiColorscheme = null, ?string $defaultCatalog = null, ?string $projectOptionsUrl = null, ?string $picture = null): mixed
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$displayName`       | **?string** |             |
| `$username`          | **?string** |             |
| `$currentPassword`   | **?string** |             |
| `$password`          | **?string** |             |
| `$companyType`       | **?string** |             |
| `$companyName`       | **?string** |             |
| `$vatNumber`         | **?string** |             |
| `$companyRole`       | **?string** |             |
| `$marketing`         | **?bool**   |             |
| `$uiColorscheme`     | **?string** |             |
| `$defaultCatalog`    | **?string** |             |
| `$projectOptionsUrl` | **?string** |             |
| `$picture`           | **?string** |             |

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

### getDisplayName

```php
public getDisplayName(): ?string
```

***

### getUsername

```php
public getUsername(): ?string
```

***

### getCurrentPassword

```php
public getCurrentPassword(): ?string
```

***

### getPassword

```php
public getPassword(): ?string
```

***

### getCompanyType

```php
public getCompanyType(): ?string
```

***

### getCompanyName

```php
public getCompanyName(): ?string
```

***

### getVatNumber

```php
public getVatNumber(): ?string
```

***

### getCompanyRole

```php
public getCompanyRole(): ?string
```

***

### getMarketing

```php
public getMarketing(): ?bool
```

***

### getUiColorscheme

```php
public getUiColorscheme(): ?string
```

***

### getDefaultCatalog

```php
public getDefaultCatalog(): ?string
```

***

### getProjectOptionsUrl

```php
public getProjectOptionsUrl(): ?string
```

***

### getPicture

```php
public getPicture(): ?string
```

***
