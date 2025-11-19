# UsersTask

UserTask class.

***

* Full name: `\Upsun\Core\Tasks\UsersTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\UsersApi $api
```

***

### profilesApi

```php
private \Upsun\Api\UserProfilesApi $profilesApi
```

***

### accessApi

```php
private \Upsun\Api\UserAccessApi $accessApi
```

***

### tokensApi

```php
private \Upsun\Api\ApiTokensApi $tokensApi
```

***

### connectionsApi

```php
private \Upsun\Api\ConnectionsApi $connectionsApi
```

***

### grantsApi

```php
private \Upsun\Api\GrantsApi $grantsApi
```

***

### mfaApi

```php
private \Upsun\Api\MfaApi $mfaApi
```

***

### phoneNumberApi

```php
private \Upsun\Api\PhoneNumberApi $phoneNumberApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\UsersApi $api, \Upsun\Api\UserProfilesApi $profilesApi, \Upsun\Api\UserAccessApi $accessApi, \Upsun\Api\ApiTokensApi $tokensApi, \Upsun\Api\ConnectionsApi $connectionsApi, \Upsun\Api\GrantsApi $grantsApi, \Upsun\Api\MfaApi $mfaApi, \Upsun\Api\PhoneNumberApi $phoneNumberApi): mixed
```

**Parameters:**

| Parameter         | Type                           | Description |
|-------------------|--------------------------------|-------------|
| `$client`         | **\Upsun\UpsunClient**         |             |
| `$api`            | **\Upsun\Api\UsersApi**        |             |
| `$profilesApi`    | **\Upsun\Api\UserProfilesApi** |             |
| `$accessApi`      | **\Upsun\Api\UserAccessApi**   |             |
| `$tokensApi`      | **\Upsun\Api\ApiTokensApi**    |             |
| `$connectionsApi` | **\Upsun\Api\ConnectionsApi**  |             |
| `$grantsApi`      | **\Upsun\Api\GrantsApi**       |             |
| `$mfaApi`         | **\Upsun\Api\MfaApi**          |             |
| `$phoneNumberApi` | **\Upsun\Api\PhoneNumberApi**  |             |

***

### me

Get the current user

```php
public me(): \Upsun\Model\User
```

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserVerificationStatus

Checks if phone verification is required

```php
public getCurrentUserVerificationStatus(): \Upsun\Model\GetCurrentUserVerificationStatus200Response
```

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCurrentUserVerificationStatusFull

Checks if verification is required

```php
public getCurrentUserVerificationStatusFull(): \Upsun\Model\GetCurrentUserVerificationStatusFull200Response
```

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets a user

```php
public get(string $id): \Upsun\Model\User
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$id`     | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getByEmailAddress

Gets a user by email

```php
public getByEmailAddress(string $email): \Upsun\Model\User
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getByUsername

Gets a user by username

```php
public getByUsername(string $username): \Upsun\Model\User
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### resetEmailAddress

Resets email address

```php
public resetEmailAddress(string $userId, ?string $emailAddress = null): void
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$userId`       | **string**  |             |
| `$emailAddress` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### resetPassword

Resets user password

```php
public resetPassword(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates a user

```php
public update(string $userId, ?string $username = null, ?string $firstName = null, ?string $lastName = null, ?string $picture = null, ?string $company = null, ?string $website = null, ?string $country = null): \Upsun\Model\User
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$userId`    | **string**  |             |
| `$username`  | **?string** |             |
| `$firstName` | **?string** |             |
| `$lastName`  | **?string** |             |
| `$picture`   | **?string** |             |
| `$company`   | **?string** |             |
| `$website`   | **?string** |             |
| `$country`   | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectUserAccess

Gets user access for a project

```php
public getProjectUserAccess(string $projectId, string $userId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getUserProjectAccess

Gets project access for a user

```php
public getUserProjectAccess(string $userId, string $projectId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantProjectUserAccess

Grants user access to a project

```php
public grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description |
|---------------------------------------|------------|-------------|
| `$projectId`                          | **string** |             |
| `$grantProjectUserAccessRequestInner` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantUserProjectAccess

Grants project access to a user

```php
public grantUserProjectAccess(string $userId, array $data): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |
| `$data`   | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectUserAccess

Lists user access for a project

```php
public listProjectUserAccess(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$projectId`  | **string**  |             |
| `$pageSize`   | **?int**    |             |
| `$pageBefore` | **?string** |             |
| `$pageAfter`  | **?string** |             |
| `$sort`       | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserProjectAccess

Lists project access for a user

```php
public listUserProjectAccess(string $userId, ?string $filterOrganizationId = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$userId`               | **string**  |             |
| `$filterOrganizationId` | **?string** |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeProjectUserAccess

Removes user access for a project

```php
public removeProjectUserAccess(string $projectId, string $userId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeUserProjectAccess

Removes project access for a user

```php
public removeUserProjectAccess(string $userId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectUserAccess

Updates user access for a project

```php
public updateProjectUserAccess(string $projectId, string $userId, ?array $permissions = null): void
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$userId`      | **string** |             |
| `$permissions` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateUserProjectAccess

Updates project access for a user

```php
public updateUserProjectAccess(string $userId, string $projectId, ?array $permissions = null): void
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$userId`      | **string** |             |
| `$projectId`   | **string** |             |
| `$permissions` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProfilePicture

Creates a user profile picture

```php
public createProfilePicture(string $uuid): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$uuid`   | **string** |             |

**Throws:**

- [`BadMethodCallException`](https://www.php.net/manual/en/class.badmethodcallexception.php) Not implemented yet


***

### deleteProfilePicture

Deletes a user profile picture

```php
public deleteProfilePicture(string $uuid): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$uuid`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getAddress

Gets a user address

```php
public getAddress(string $userId): \Upsun\Model\GetAddress200Response
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProfile

Gets a single user profile

```php
public getProfile(string $userId): \Upsun\Model\Profile
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProfiles

Lists current user profiles

```php
public listProfiles(): \Upsun\Model\ListProfiles200Response
```

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateAddress

Updates a user address

```php
public updateAddress(string $userId, ?string $country = null, ?string $nameLine = null, ?string $premise = null, ?string $subPremise = null, ?string $thoroughfare = null, ?string $administrativeArea = null, ?string $subAdministrativeArea = null, ?string $locality = null, ?string $dependentLocality = null, ?string $postalCode = null): \Upsun\Model\GetAddress200Response
```

**Parameters:**

| Parameter                | Type        | Description |
|--------------------------|-------------|-------------|
| `$userId`                | **string**  |             |
| `$country`               | **?string** |             |
| `$nameLine`              | **?string** |             |
| `$premise`               | **?string** |             |
| `$subPremise`            | **?string** |             |
| `$thoroughfare`          | **?string** |             |
| `$administrativeArea`    | **?string** |             |
| `$subAdministrativeArea` | **?string** |             |
| `$locality`              | **?string** |             |
| `$dependentLocality`     | **?string** |             |
| `$postalCode`            | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProfile

Updates a user profile

```php
public updateProfile(string $userId, ?string $displayName = null, ?string $username = null, ?string $currentPassword = null, ?string $password = null, ?string $companyType = null, ?string $companyName = null, ?string $vatNumber = null, ?string $companyRole = null, ?bool $marketing = null, ?string $uiColorscheme = null, ?string $defaultCatalog = null, ?string $projectOptionsUrl = null, ?string $picture = null): \Upsun\Model\Profile
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$userId`            | **string**  |             |
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

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createApiToken

Creates an API token

```php
public createApiToken(string $userId, string $name): \Upsun\Model\ApiToken
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |
| `$name`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteApiToken

Deletes an API token

```php
public deleteApiToken(string $userId, string $tokenId): void
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$userId`  | **string** |             |
| `$tokenId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getApiToken

Gets an API token

```php
public getApiToken(string $userId, string $tokenId): \Upsun\Model\ApiToken
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$userId`  | **string** |             |
| `$tokenId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listApiTokens

Lists a user's API tokens

```php
public listApiTokens(string $userId): \Upsun\Model\ApiToken[]
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteLoginConnection

Deletes a federated login connection

```php
public deleteLoginConnection(string $provider, string $userId): void
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$provider` | **string** |             |
| `$userId`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getLoginConnection

Gets a federated login connection

```php
public getLoginConnection(string $provider, string $userId): \Upsun\Model\Connection
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$provider` | **string** |             |
| `$userId`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listLoginConnections

Lists federated login connections

```php
public listLoginConnections(string $userId): \Upsun\Model\Connection[]
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listExtendedAccess

Lists extended access of a user

```php
public listExtendedAccess(string $userId, ?array $filterResourceType = null, ?array $filterOrganizationId = null, ?array $filterPermissions = null): \Upsun\Model\ListUserExtendedAccess200Response
```

**Parameters:**

| Parameter               | Type       | Description |
|-------------------------|------------|-------------|
| `$userId`               | **string** |             |
| `$filterResourceType`   | **?array** |             |
| `$filterOrganizationId` | **?array** |             |
| `$filterPermissions`    | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### confirmTotpEnrollment

Confirms TOTP enrollment

```php
public confirmTotpEnrollment(string $userId, string $secret, string $passCode): \Upsun\Model\ConfirmTotpEnrollment200Response
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$userId`   | **string** |             |
| `$secret`   | **string** |             |
| `$passCode` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTotpEnrollment

Get information about TOTP enrollment

```php
public getTotpEnrollment(string $userId): \Upsun\Model\GetTotpEnrollment200Response
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### recreateRecoveryCodes

Re-creates recovery codes

```php
public recreateRecoveryCodes(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### withdrawTotpEnrollment

Withdraws TOTP enrollment

```php
public withdrawTotpEnrollment(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### confirmPhoneNumber

Confirms phone number

```php
public confirmPhoneNumber(string $sid, string $userId, string $code): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$sid`    | **string** |             |
| `$userId` | **string** |             |
| `$code`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### verifyPhoneNumber

Verifies phone number

```php
public verifyPhoneNumber(string $userId, string $channel, string $phoneNumber): \Upsun\Model\VerifyPhoneNumber200Response
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$userId`      | **string** |             |
| `$channel`     | **string** |             |
| `$phoneNumber` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client): mixed
```

**Parameters:**

| Parameter | Type                   | Description |
|-----------|------------------------|-------------|
| `$client` | **\Upsun\UpsunClient** |             |

***

### normalizeFilter

```php
protected normalizeFilter(array|string|int|\DateTime|null $value): array
```

**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **array\|string\|int\|\DateTime\|null** |             |

***

### extractSubscriptionId

Get SubscriptionId of a Project Licence Uri

```php
protected extractSubscriptionId(string $projectLicenceUri): string
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectLicenceUri` | **string** |             |

***
