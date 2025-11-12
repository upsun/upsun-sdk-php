# Subscription1

Low level Subscription1 (auto-generated)

Subscription

***

* Full name: `\Upsun\Model\Subscription1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### licenseUri

```php
private string $licenseUri
```

***

### storage

```php
private int $storage
```

***

### includedUsers

```php
private int $includedUsers
```

***

### subscriptionManagementUri

```php
private string $subscriptionManagementUri
```

***

### restricted

```php
private bool $restricted
```

***

### suspended

```php
private bool $suspended
```

***

### userLicenses

```php
private int $userLicenses
```

***

### plan

```php
private ?string $plan
```

***

### environments

```php
private ?int $environments
```

***

### resources

```php
private ?\Upsun\Model\ResourcesLimits $resources
```

***

### resourceValidationUrl

```php
private ?string $resourceValidationUrl
```

***

### imageTypes

```php
private ?\Upsun\Model\ImageTypeRestrictions $imageTypes
```

***

## Methods

### __construct

```php
public __construct(string $licenseUri, int $storage, int $includedUsers, string $subscriptionManagementUri, bool $restricted, bool $suspended, int $userLicenses, ?string $plan = null, ?int $environments = null, ?\Upsun\Model\ResourcesLimits $resources = null, ?string $resourceValidationUrl = null, ?\Upsun\Model\ImageTypeRestrictions $imageTypes = null): mixed
```

**Parameters:**

| Parameter                    | Type                                    | Description |
|------------------------------|-----------------------------------------|-------------|
| `$licenseUri`                | **string**                              |             |
| `$storage`                   | **int**                                 |             |
| `$includedUsers`             | **int**                                 |             |
| `$subscriptionManagementUri` | **string**                              |             |
| `$restricted`                | **bool**                                |             |
| `$suspended`                 | **bool**                                |             |
| `$userLicenses`              | **int**                                 |             |
| `$plan`                      | **?string**                             |             |
| `$environments`              | **?int**                                |             |
| `$resources`                 | **?\Upsun\Model\ResourcesLimits**       |             |
| `$resourceValidationUrl`     | **?string**                             |             |
| `$imageTypes`                | **?\Upsun\Model\ImageTypeRestrictions** |             |

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

### getLicenseUri

URI of the subscription

```php
public getLicenseUri(): string
```

***

### getStorage

Size of storage (in MB)

```php
public getStorage(): int
```

***

### getIncludedUsers

Number of users

```php
public getIncludedUsers(): int
```

***

### getSubscriptionManagementUri

URI for managing the subscription

```php
public getSubscriptionManagementUri(): string
```

***

### getRestricted

True if subscription attributes, like number of users, are frozen

```php
public getRestricted(): bool
```

***

### getSuspended

Whether or not the subscription is suspended

```php
public getSuspended(): bool
```

***

### getUserLicenses

Current number of users

```php
public getUserLicenses(): int
```

***

### getPlan

```php
public getPlan(): ?string
```

***

### getEnvironments

Number of environments

```php
public getEnvironments(): ?int
```

***

### getResources

Resources limits

```php
public getResources(): ?\Upsun\Model\ResourcesLimits
```

***

### getResourceValidationUrl

URL for resources validation

```php
public getResourceValidationUrl(): ?string
```

***

### getImageTypes

Restricted and denied image types

```php
public getImageTypes(): ?\Upsun\Model\ImageTypeRestrictions
```

***
