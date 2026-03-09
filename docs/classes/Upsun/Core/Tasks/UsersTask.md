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

### userAccessApi

```php
private \Upsun\Api\UserAccessApi $userAccessApi
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
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\UsersApi $api, \Upsun\Api\UserProfilesApi $profilesApi, \Upsun\Api\UserAccessApi $userAccessApi, \Upsun\Api\ApiTokensApi $tokensApi, \Upsun\Api\ConnectionsApi $connectionsApi, \Upsun\Api\GrantsApi $grantsApi, \Upsun\Api\MfaApi $mfaApi, \Upsun\Api\PhoneNumberApi $phoneNumberApi): mixed
```

**Parameters:**

| Parameter         | Type                           | Description |
|-------------------|--------------------------------|-------------|
| `$client`         | **\Upsun\UpsunClient**         |             |
| `$api`            | **\Upsun\Api\UsersApi**        |             |
| `$profilesApi`    | **\Upsun\Api\UserProfilesApi** |             |
| `$userAccessApi`  | **\Upsun\Api\UserAccessApi**   |             |
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

### create

Note that user creation is not supported through the API, and this method will throw an error if called.

```php
public create(): void
```

Use `upsun.invitations.createOrgInvite()` to invite users to your organization instead,
or `upsun.invitations.createProjectInvite()` to invite users to specific projects.
Inviting users to your organization or projects will send them an email invitation,
which will allow them to create their own accounts and join your organization with the appropriate permissions.

**Throws:**

- [`BadMethodCallException`](https://www.php.net/manual/en/class.badmethodcallexception.php) Always, as user creation is not supported through the API


***

### addToProject

Adds users to a project with specified permissions.

```php
public addToProject(string $projectId, array $userPermissions): void
```

This method allows you to grant access to a project for one or more users, specifying their access levels
and permissions within the project.

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$userPermissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid, or if permissions are not properly specified


***

### removeFromProject

Removes a user's access to a project.

```php
public removeFromProject(string $userId, string $projectId): void
```

Note that this does not delete the user from the system, but simply revokes their access to the specified project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### get

Retrieves information about a specific user by their ID.

```php
public get(string $userId): \Upsun\Model\User
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listProjectUserAccesses

Lists all users who have access to a specific project, along with their access levels and permissions.

```php
public listProjectUserAccesses(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the email is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the username is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the email address is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### getUserProjectAccessByProject

Gets user access for a project

```php
public getUserProjectAccessByProject(string $projectId, string $userId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### getProjectUserAccess

Gets user access for a project

```php
public getProjectUserAccess(string $projectId, string $userId): \Upsun\Model\UserProjectAccess
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### getUserProjectAccessByUser

Gets project access for a user

```php
public getUserProjectAccessByUser(string $userId, string $projectId): \Upsun\Model\UserProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID or project ID is invalid


***

### getUserProjectAccess

Gets project access for a user

```php
public getUserProjectAccess(string $userId, string $projectId): \Upsun\Model\UserProjectAccess
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID or project ID is invalid


***

### grantProjectUserAccess

Grants user access to a project

```php
public grantProjectUserAccess(string $projectId, array $grantProjectUserAccessRequestInner): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter                             | Type       | Description |
|---------------------------------------|------------|-------------|
| `$projectId`                          | **string** |             |
| `$grantProjectUserAccessRequestInner` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### grantUserProjectAccessByUser

Grants project access to a user

```php
public grantUserProjectAccessByUser(string $userId, array $access): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |
| `$access` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### grantUserProjectAccess

Grants project access to a user

```php
public grantUserProjectAccess(string $userId, array $data): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |
| `$data`   | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listProjectUserAccess

Lists user access for a project

```php
public listProjectUserAccess(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### listUserProjectAccessByUser

Lists project access for a user

```php
public listUserProjectAccessByUser(string $userId, ?string $filterOrganizationId = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listUserProjectAccess

Lists project access for a user

```php
public listUserProjectAccess(string $userId, ?string $filterOrganizationId = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listExtendedUserProjectAccess

Retrieves a list of all projects that a user has access to, along with their access levels and permissions for
each project. This method provides an extended view of the user's access, which may include additional details
about the projects and the user's permissions within those projects, making it easier to manage and review user
access across multiple projects.

```php
public listExtendedUserProjectAccess(string $userId, ?array $filterResourceType = null, ?array $filterOrganizationId = null, ?array $filterPermissions = null): \Upsun\Model\ListUserExtendedAccess200Response
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### revokeUserProjectAccessByUser

Revokes a user's access to a project. This method revokes the user's permissions for the specified project,
effectively preventing them from accessing or collaborating on the project. Note that this does not delete the user
from the system, but simply removes their access to the specified project.

```php
public revokeUserProjectAccessByUser(string $userId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### removeProjectUserAccess

Removes user access for a project

```php
public removeProjectUserAccess(string $projectId, string $userId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### removeUserProjectAccess

Removes project access for a user

```php
public removeUserProjectAccess(string $userId, string $projectId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$userId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID or project ID is invalid


***

### updateUserProjectAccessByProject

Updates a user's access level and permissions for a specific project. This method allows you to modify the access
permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
appropriate level of access to perform their tasks within the project. By updating a user's project access, you
can grant them additional permissions or restrict their access as needed.

```php
public updateUserProjectAccessByProject(string $projectId, string $userId, array $permissions): void
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$userId`      | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid, or if permissions are empty.


***

### updateProjectUserAccess

Updates a user's access level and permissions for a specific project. This method allows you to modify the access
permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
appropriate level of access to perform their tasks within the project. By updating a user's project access, you
can grant them additional permissions or restrict their access as needed.

```php
public updateProjectUserAccess(string $projectId, string $userId, array $permissions): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$userId`      | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid, or if permissions are empty.


***

### updateUserProjectAccessByUser

Updates a user's access level and permissions for a specific project. This method allows you to modify the access
permissions of a user for a project, which can be useful for managing user roles and ensuring that users have the
appropriate level of access to perform their tasks within the project. By updating a user's project access, you
can grant them additional permissions or restrict their access as needed.

```php
public updateUserProjectAccessByUser(string $userId, string $projectId, array $permissions): void
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$userId`      | **string** |             |
| `$projectId`   | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid, or if permissions are empty.


***

### updateUserProjectAccess

Updates project access for a user

```php
public updateUserProjectAccess(string $userId, string $projectId, array $permissions): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$userId`      | **string** |             |
| `$projectId`   | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid, or if permissions are empty.


***

### deleteProfilePicture

Deletes a user profile picture

```php
public deleteProfilePicture(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the token name is empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the token ID is empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the token ID is empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the provider name is empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the provider name is empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### confirmTotpEnrollment

Confirms a user's TOTP enrollment by verifying the provided TOTP secret and pass code. This method is used to
complete the TOTP enrollment process for a user, ensuring that they have successfully set up their TOTP
authentication method. By confirming the TOTP enrollment, the user can then use TOTP for
two-factor authentication when logging in.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the TOTP secret or passcode are empty


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### withdrawTotpEnrollment

Withdraws a user's TOTP enrollment. This method allows you to revoke a user's TOTP enrollment.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### recreateMfaRecoveryCodes

Re-creates recovery codes

```php
public recreateMfaRecoveryCodes(string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### recreateRecoveryCodes

Re-creates recovery codes

```php
public recreateRecoveryCodes(string $userId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the SID or confirmation code are empty


***

### verifyPhoneNumber

Sends a verification code to a user's phone number via the specified channel (e.g., SMS, voice call)
for phone number verification.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid, or if the channel or phone number are empty


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

### checkUserId

```php
protected static checkUserId(string $userId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$userId` | **string** |             |

***

### checkProjectId

```php
protected static checkProjectId(string $projectId): void
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

***

### checkOrganizationId

```php
protected static checkOrganizationId(string $organizationId): void
```

* This method is **static**.
**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

***

### checkEnvironmentId

```php
protected static checkEnvironmentId(string $environmentId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$environmentId` | **string** |             |

***

### checkActivityId

```php
protected static checkActivityId(string $activityId): void
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$activityId` | **string** |             |

***

### checkApplicationId

```php
protected static checkApplicationId(string $applicationId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$applicationId` | **string** |             |

***

### checkBackupId

```php
protected static checkBackupId(string $backupId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$backupId` | **string** |             |

***

### checkCertificateId

```php
protected static checkCertificateId(string $certificateId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$certificateId` | **string** |             |

***

### checkSubscriptionId

```php
protected static checkSubscriptionId(string $subscriptionId): void
```

* This method is **static**.
**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$subscriptionId` | **string** |             |

***

### checkTeamId

```php
protected static checkTeamId(string $teamId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |

***

### checkDeploymentId

```php
protected static checkDeploymentId(string $deploymentId): void
```

* This method is **static**.
**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$deploymentId` | **string** |             |

***

### checkInvoiceId

```php
protected static checkInvoiceId(string $invoiceId): void
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$invoiceId` | **string** |             |

***

### checkOrderId

```php
protected static checkOrderId(string $orderId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$orderId` | **string** |             |

***

### checkVoucherCode

```php
protected static checkVoucherCode(string $code): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$code`   | **string** |             |

***

### checkProjectRegion

```php
protected static checkProjectRegion(string $region): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$region` | **string** |             |

***

### checkVariableId

```php
protected static checkVariableId(string $variableId): void
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$variableId` | **string** |             |

***

### checkRepositoryBlobId

```php
protected static checkRepositoryBlobId(string $repositoryBlobId): void
```

* This method is **static**.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$repositoryBlobId` | **string** |             |

***

### checkRepositoryCommitId

```php
protected static checkRepositoryCommitId(string $repositoryCommitId): void
```

* This method is **static**.
**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$repositoryCommitId` | **string** |             |

***

### checkRepositoryRefId

```php
protected static checkRepositoryRefId(string $repositoryRefId): void
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$repositoryRefId` | **string** |             |

***

### checkRepositoryTreeId

```php
protected static checkRepositoryTreeId(string $repositoryTreeId): void
```

* This method is **static**.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$repositoryTreeId` | **string** |             |

***

### checkIntegrationId

```php
protected static checkIntegrationId(string $integrationId): void
```

* This method is **static**.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$integrationId` | **string** |             |

***

### checkDomainId

```php
protected static checkDomainId(string $domainId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$domainId` | **string** |             |

***

### checkApiTokenId

```php
protected static checkApiTokenId(string $tokenId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$tokenId` | **string** |             |

***

### checkEmail

```php
protected static checkEmail(string $email): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$email`  | **string** |             |

***

### checkInviteId

```php
protected static checkInviteId(string $inviteId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$inviteId` | **string** |             |

***

### checkUsername

```php
protected static checkUsername(string $username): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$username` | **string** |             |

***

### checkSshKeyId

```php
protected static checkSshKeyId(int $keyId): void
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$keyId`  | **int** |             |

***

### checkEnvironmentTypeId

```php
protected static checkEnvironmentTypeId(string $environmentTypeId): void
```

* This method is **static**.
**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$environmentTypeId` | **string** |             |

***

### checkRouteId

```php
protected static checkRouteId(string $routeId): void
```

* This method is **static**.
**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$routeId` | **string** |             |

***

### checkInvitationId

```php
protected static checkInvitationId(string $invitationId): void
```

* This method is **static**.
**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$invitationId` | **string** |             |

***

### checkTicketId

```php
protected static checkTicketId(string $ticketId): void
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$ticketId` | **string** |             |

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
