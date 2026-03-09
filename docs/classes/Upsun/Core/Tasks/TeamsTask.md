# TeamsTask

TeamTask class.

***

* Full name: `\Upsun\Core\Tasks\TeamsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### teamsApi

```php
private \Upsun\Api\TeamsApi $teamsApi
```

***

### accessApi

```php
private \Upsun\Api\TeamAccessApi $accessApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\TeamsApi $teamsApi, \Upsun\Api\TeamAccessApi $accessApi): mixed
```

**Parameters:**

| Parameter    | Type                         | Description |
|--------------|------------------------------|-------------|
| `$client`    | **\Upsun\UpsunClient**       |             |
| `$teamsApi`  | **\Upsun\Api\TeamsApi**      |             |
| `$accessApi` | **\Upsun\Api\TeamAccessApi** |             |

***

### create

Creates team

```php
public create(string $organizationId, string $label, ?array $projectPermissions = []): \Upsun\Model\Team
```

**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$organizationId`     | **string** |             |
| `$label`              | **string** |             |
| `$projectPermissions` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the organization ID is invalid


***

### delete

Deletes team

```php
public delete(string $teamId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### get

Get a team by its ID. This method allows you to retrieve the details of a specific team by providing the team ID.

```php
public get(string $teamId): \Upsun\Model\Team
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### update

Update a team by its ID. This method allows you to update the details of a specific team by providing the team ID
and the parameters to update.

```php
public update(string $teamId, ?string $label = null, ?array $projectPermissions = []): \Upsun\Model\Team
```

**Parameters:**

| Parameter             | Type        | Description |
|-----------------------|-------------|-------------|
| `$teamId`             | **string**  |             |
| `$label`              | **?string** |             |
| `$projectPermissions` | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### list

List teams with optional filtering. This method allows you to retrieve a list of teams based on various filter
criteria.

```php
public list(?array $filterOrganizationId = [], ?array $filterId = [], ?array $filterUpdatedAt = [], ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$filterOrganizationId` | **?array**  |             |
| `$filterId`             | **?array**  |             |
| `$filterUpdatedAt`      | **?array**  |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if any of the provided filter parameters are invalid


***

### listByMember

Retrieves teams that the specified user is a member of.

```php
public listByMember(string $userId, ?array $filterOrganizationId = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$userId`               | **string**  |             |
| `$filterOrganizationId` | **?array**  |             |
| `$filterUpdatedAt`      | **?array**  |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listUserTeams

Lists teams by member

```php
public listUserTeams(string $userId, ?array $filterOrganizationId = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$userId`               | **string**  |             |
| `$filterOrganizationId` | **?array**  |             |
| `$filterUpdatedAt`      | **?array**  |             |
| `$pageSize`             | **?int**    |             |
| `$pageBefore`           | **?string** |             |
| `$pageAfter`            | **?string** |             |
| `$sort`                 | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### addMember

Add a member to a team. This method allows you to add a user as a member of a specific team by providing the team
ID and the user ID.

```php
public addMember(string $teamId, string $userId): \Upsun\Model\TeamMember
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID or user ID is invalid


***

### createMember

Creates team member

```php
public createMember(string $teamId, string $userId): \Upsun\Model\TeamMember
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID or user ID is invalid


***

### deleteMember

Deletes team member

```php
public deleteMember(string $teamId, string $userId): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID or user ID is invalid


***

### getMember

Gets team member

```php
public getMember(string $teamId, string $userId): \Upsun\Model\TeamMember
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID or user ID is invalid


***

### listMembers

Lists team members

```php
public listMembers(string $teamId, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeamMembers200Response
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$teamId`     | **string**  |             |
| `$pageBefore` | **?string** |             |
| `$pageAfter`  | **?string** |             |
| `$sort`       | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTeamProjectAccessByProject

Gets team access for a project

```php
public getTeamProjectAccessByProject(string $projectId, string $teamId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### getProjectTeamAccess

Gets team access for a project

```php
public getProjectTeamAccess(string $projectId, string $teamId): \Upsun\Model\TeamProjectAccess
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### getTeamProjectAccessByTeam

Gets project access for a team

```php
public getTeamProjectAccessByTeam(string $teamId, string $projectId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### getTeamProjectAccess

Gets project access for a team

```php
public getTeamProjectAccess(string $teamId, string $projectId): \Upsun\Model\TeamProjectAccess
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### grantTeamProjectAccessToProject

Grants team access to a project

```php
public grantTeamProjectAccessToProject(string $projectId, array{teamId: string} $access): void
```

**Parameters:**

| Parameter    | Type                      | Description |
|--------------|---------------------------|-------------|
| `$projectId` | **string**                |             |
| `$access`    | **array{teamId: string}** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### grantProjectTeamAccess

Grants team access to a project

```php
public grantProjectTeamAccess(string $projectId, array $access): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$access`    | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### grantTeamProjectAccessToTeam

Grants project access to a team

```php
public grantTeamProjectAccessToTeam(string $teamId, array{projectId: string} $access): void
```

**Parameters:**

| Parameter | Type                         | Description |
|-----------|------------------------------|-------------|
| `$teamId` | **string**                   |             |
| `$access` | **array{projectId: string}** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### grantTeamProjectAccess

Grants project access to a team

```php
public grantTeamProjectAccess(string $teamId, array $access): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$access` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### listTeamProjectAccessByProject

Lists team access for a project

```php
public listTeamProjectAccessByProject(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### listProjectTeamAccess

Lists team access for a project

```php
public listProjectTeamAccess(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### listTeamProjectAccessByTeam

Lists project access for a team

```php
public listTeamProjectAccessByTeam(string $teamId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$teamId`     | **string**  |             |
| `$pageSize`   | **?int**    |             |
| `$pageBefore` | **?string** |             |
| `$pageAfter`  | **?string** |             |
| `$sort`       | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### listTeamProjectAccess

Lists project access for a team

```php
public listTeamProjectAccess(string $teamId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$teamId`     | **string**  |             |
| `$pageSize`   | **?int**    |             |
| `$pageBefore` | **?string** |             |
| `$pageAfter`  | **?string** |             |
| `$sort`       | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### revokeTeamProjectAccessByProject

Revokes team access for a project

```php
public revokeTeamProjectAccessByProject(string $projectId, string $teamId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### revokeProjectTeamAccess

Removes team access for a project

```php
public revokeProjectTeamAccess(string $projectId, string $teamId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### revokeTeamProjectAccessByTeam

Removes project access for a team

```php
public revokeTeamProjectAccessByTeam(string $teamId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


***

### revokeTeamProjectAccess

Removes project access for a team

```php
public revokeTeamProjectAccess(string $teamId, string $projectId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid


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
