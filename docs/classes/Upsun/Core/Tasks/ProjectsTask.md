# ProjectsTask

ProjectTask class.

***

* Full name: `\Upsun\Core\Tasks\ProjectsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### prjApi

```php
private \Upsun\Api\ProjectApi $prjApi
```

***

### organizationApi

```php
private \Upsun\Api\OrganizationProjectsApi $organizationApi
```

***

### settingsApi

```php
private \Upsun\Api\ProjectSettingsApi $settingsApi
```

***

### subscriptionsApi

```php
private \Upsun\Api\SubscriptionsApi $subscriptionsApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ProjectApi $prjApi, \Upsun\Api\OrganizationProjectsApi $organizationApi, \Upsun\Api\ProjectSettingsApi $settingsApi, \Upsun\Api\SubscriptionsApi $subscriptionsApi): mixed
```

**Parameters:**

| Parameter           | Type                                   | Description |
|---------------------|----------------------------------------|-------------|
| `$client`           | **\Upsun\UpsunClient**                 |             |
| `$prjApi`           | **\Upsun\Api\ProjectApi**              |             |
| `$organizationApi`  | **\Upsun\Api\OrganizationProjectsApi** |             |
| `$settingsApi`      | **\Upsun\Api\ProjectSettingsApi**      |             |
| `$subscriptionsApi` | **\Upsun\Api\SubscriptionsApi**        |             |

***

### clearBuildCache

Clears the build cache for a project.

```php
public clearBuildCache(string $projectId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### create

Creates a project

```php
public create(string $organizationId, string $projectRegion, ?string $title = null, ?string $defaultBranch = null, ?string $plan = null, ?string $optionsUrl = null, ?int $environments = null, ?int $storage = null): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$projectRegion`  | **string**  |             |
| `$title`          | **?string** |             |
| `$defaultBranch`  | **?string** |             |
| `$plan`           | **?string** |             |
| `$optionsUrl`     | **?string** |             |
| `$environments`   | **?int**    |             |
| `$storage`        | **?int**    |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### canCreate

Checks if the user is able to create a new project in the organization.

```php
public canCreate(string $organizationId): \Upsun\Model\CanCreateNewOrgSubscription200Response
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the organization ID is invalid


***

### delete

Deletes a project. This will effectively delete the project, along with any related resources and data.

```php
public delete(string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### info

Get or update a project.

```php
public info(string $projectId, ?string $title = null, ?string $defaultBranch = null, ?string $description = null, ?string $defaultDomain = null, ?array $attributes = [], ?string $timezone = null, ?string $region = null): \Upsun\Model\Project
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$title`         | **?string** |             |
| `$defaultBranch` | **?string** |             |
| `$description`   | **?string** |             |
| `$defaultDomain` | **?string** |             |
| `$attributes`    | **?array**  |             |
| `$timezone`      | **?string** |             |
| `$region`        | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### get

Gets a project

```php
public get(string $projectId): \Upsun\Model\Project
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### update

Updates a project

```php
public update(string $projectId, ?string $title = null, ?string $defaultBranch = null, ?string $description = null, ?string $defaultDomain = null, ?array $attributes = [], ?string $timezone = null, ?string $region = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$title`         | **?string** |             |
| `$defaultBranch` | **?string** |             |
| `$description`   | **?string** |             |
| `$defaultDomain` | **?string** |             |
| `$attributes`    | **?array**  |             |
| `$timezone`      | **?string** |             |
| `$region`        | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### list

Lists projects for an organization.

```php
public list(string $organizationId): \Upsun\Model\ListOrgProjects200Response
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the organization ID is invalid


***

### getSubscription

Get the subscription details for a project. This method retrieves the subscription information associated with the
project, including details such as the subscription ID, status, plan, and other relevant information about the
subscription that is linked to the project.

```php
public getSubscription(string $projectId): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the subscription ID cannot be extracted from
the project information


***

### getCapabilities

Retrieves the capabilities that are available for the specified project.

```php
public getCapabilities(string $projectId): \Upsun\Model\ProjectCapabilities
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### cancelInvite

Cancel an invitation to a project. This will revoke the access that was granted to the invitee through the
invitation, and the invite will no longer be valid.

```php
public cancelInvite(string $projectId, string $invitationId): void
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$projectId`    | **string** |             |
| `$invitationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or invitation ID is invalid


***

### createInvite

Invites user to a project by email. This will send an invitation to the specified email address, allowing the
recipient to accept the invitation and gain access to the project with the specified role and permissions.

```php
public createInvite(string $projectId, string $email, ?string $role = null, array<int,"read"|"write"|"admin">|null $permissions = null, array<int,array{id: string, name: string}>|null $environments = null, ?bool $force = null): \Upsun\Model\ProjectInvitation
```

**Parameters:**

| Parameter       | Type                                                 | Description |
|-----------------|------------------------------------------------------|-------------|
| `$projectId`    | **string**                                           |             |
| `$email`        | **string**                                           |             |
| `$role`         | **?string**                                          |             |
| `$permissions`  | **array<int,"read"\|"write"\|"admin">\|null**        |             |
| `$environments` | **array<int,array{id: string, name: string}>\|null** |             |
| `$force`        | **?bool**                                            |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or email is invalid


***

### listInvites

List all pending invitations for a project, with optional filtering.

```php
public listInvites(string $projectId, ?array $filterState = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ProjectInvitation[]
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$projectId`   | **string**  |             |
| `$filterState` | **?array**  |             |
| `$pageSize`    | **?int**    |             |
| `$pageBefore`  | **?string** |             |
| `$pageAfter`   | **?string** |             |
| `$sort`        | **?string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### getSettings

Gets project settings

```php
public getSettings(string $projectId): \Upsun\Model\ProjectSettings
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### updateSettings

Updates a project setting

```php
public updateSettings(string $projectId, null|array{step: string, status: string} $initialize = null, ?array $dataRetention = null, ?float $cpu = null, ?int $memory = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                                          | Description |
|------------------|-----------------------------------------------|-------------|
| `$projectId`     | **string**                                    |             |
| `$initialize`    | **null\|array{step: string, status: string}** |             |
| `$dataRetention` | **?array**                                    |             |
| `$cpu`           | **?float**                                    |             |
| `$memory`        | **?int**                                      |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided settings are not valid


***

### createVariable

Adds a project variable

```php
public createVariable(string $projectId, string $name, string $value, ?array $attributes = [], ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = []): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$name`             | **string** |             |
| `$value`            | **string** |             |
| `$attributes`       | **?array** |             |
| `$isJson`           | **?bool**  |             |
| `$isSensitive`      | **?bool**  |             |
| `$visibleBuild`     | **?bool**  |             |
| `$visibleRuntime`   | **?bool**  |             |
| `$applicationScope` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided variable details are not valid


***

### getVariable

Get a project variable

```php
public getVariable(string $projectId, string $variableId): \Upsun\Model\ProjectVariable
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$variableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the project variable ID is invalid


***

### deleteVariable

Deletes a project variable

```php
public deleteVariable(string $projectId, string $variableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$variableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the project variable ID is invalid


***

### listVariables

Gets list of project variables

```php
public listVariables(string $projectId): \Upsun\Model\ProjectVariable[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateVariable

Updates a project variable

```php
public updateVariable(string $projectId, string $variableId, ?string $name = null, ?string $value = null, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$projectId`        | **string**  |             |
| `$variableId`       | **string**  |             |
| `$name`             | **?string** |             |
| `$value`            | **?string** |             |
| `$attributes`       | **?array**  |             |
| `$isJson`           | **?bool**   |             |
| `$isSensitive`      | **?bool**   |             |
| `$visibleBuild`     | **?bool**   |             |
| `$visibleRuntime`   | **?bool**   |             |
| `$applicationScope` | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the project variable ID is invalid


***

### listActivities

Gets project activity log

```php
public listActivities(string $projectId): \Upsun\Model\Activity[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### getActivity

Gets a project activity log entry

```php
public getActivity(string $projectId, string $activityId): \Upsun\Model\Activity
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or activity ID is invalid


***

### cancelActivity

Cancels a project activity

```php
public cancelActivity(string $projectId, string $activityId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or activity ID is invalid


***

### getGitBlob

Gets a blob object

```php
public getGitBlob(string $projectId, string $repositoryBlobId): \Upsun\Model\Blob
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryBlobId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or repository blob ID is invalid


***

### getGitCommit

Gets a commit object

```php
public getGitCommit(string $projectId, string $repositoryCommitId): \Upsun\Model\Commit
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$projectId`          | **string** |             |
| `$repositoryCommitId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or repository commit ID is invalid


***

### getGitRef

Gets a Git ref object

```php
public getGitRef(string $projectId, string $repositoryRefId): \Upsun\Model\Ref
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$repositoryRefId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or repository ref ID is invalid


***

### getGitTree

Gets a Git tree object

```php
public getGitTree(string $projectId, string $repositoryTreeId): \Upsun\Model\Tree
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryTreeId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or repository tree ID is invalid


***

### listGitRefs

Gets list of repository refs

```php
public listGitRefs(string $projectId): \Upsun\Model\Ref[]
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### getGitInfo

Get information about the Git server.

```php
public getGitInfo(string $projectId): \Upsun\Model\SystemInformation
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### addDomain

Adds a project domain

```php
public addDomain(string $projectId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided domain details are not valid


***

### deleteDomain

Deletes a project domain

```php
public deleteDomain(string $projectId, string $domainId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or domain ID is invalid


***

### getDomain

Gets a project domain

```php
public getDomain(string $projectId, string $domainId): \Upsun\Model\Domain
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or domain ID is invalid


***

### listDomains

Gets list of project domains

```php
public listDomains(string $projectId): \Upsun\Model\Domain[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### updateDomain

Updates a project domain

```php
public updateDomain(string $projectId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter      | Type                         | Description |
|----------------|------------------------------|-------------|
| `$projectId`   | **string**                   |             |
| `$domainId`    | **string**                   |             |
| `$domainPatch` | **\Upsun\Model\DomainPatch** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or domain ID is invalid
or if the provided domain details are not valid


***

### addCertificate

Adds an SSL certificate

```php
public addCertificate(string $projectId, string $certificate, string $key, ?array $chain = null, ?bool $isInvalid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$certificate` | **string** |             |
| `$key`         | **string** |             |
| `$chain`       | **?array** |             |
| `$isInvalid`   | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided certificate details are not
valid


***

### deleteCertificate

Deletes an SSL certificate

```php
public deleteCertificate(string $projectId, string $certificateId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or certificate ID is invalid


***

### getCertificate

Gets an SSL certificate

```php
public getCertificate(string $projectId, string $certificateId): \Upsun\Model\Certificate
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or certificate ID is invalid


***

### listCertificates

Gets list of SSL certificates

```php
public listCertificates(string $projectId): \Upsun\Model\Certificate[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### updateCertificate

Updates an SSL certificate

```php
public updateCertificate(string $projectId, string $certificateId, ?array $chain = null, ?bool $isInvalid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |
| `$chain`         | **?array** |             |
| `$isInvalid`     | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

### getTeamProjectAccessByTeam

Gets team access for a project

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or team ID is invalid or if the


***

### grantTeamProjectAccessToProject

Grants team access to a project for a team

```php
public grantTeamProjectAccessToProject(string $projectId, array $access): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$access`    | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided access details are not valid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### grantTeamProjectAccessToTeam

Grants project access to a team

```php
public grantTeamProjectAccessToTeam(string $teamId, array $access): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$access` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


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

Lists project team access for a project

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

Removes team access for a project

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the team ID is invalid


***

### getUserProjectAccessByProject

Get the access details of a user to a project. This method retrieves the access information for a specific user
in relation to a project, including the level of access granted to the user, the permissions they have, and any
relevant metadata about the user's access to the project.

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### grantUserProjectAccessByProject

Grants user access to a project

```php
public grantUserProjectAccessByProject(string $projectId, array $permissions): void
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### grantProjectUserAccess

Grants user access to a project

```php
public grantProjectUserAccess(string $projectId, array $permissions): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$permissions` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### revokeUserProjectAccessByProject

Revoke access to a project for a user. This method allows you to revoke the access that a user has to a project,
which will remove the user's permissions and access to the project. Once the request is accepted, the user will
no longer have access to the project.

```php
public revokeUserProjectAccessByProject(string $projectId, string $userId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### revokeProjectUserAccess

Removes user access for a project

```php
public revokeProjectUserAccess(string $projectId, string $userId): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$userId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid


***

### updateUserProjectAccessByProject

Updates user access for a project

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid or if the


***

### updateProjectUserAccess

Updates user access for a project

```php
public updateProjectUserAccess(string $projectId, string $userId, ?array $permissions = null): void
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$userId`      | **string** |             |
| `$permissions` | **?array** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or user ID is invalid or if the


***

### listUserProjectAccessByProject

Lists user access for a project

```php
public listUserProjectAccessByProject(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectUserAccess200Response
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### listUserProjectAccessByUser

List the access details of all projects to a user. This method retrieves a list of all projects that a user has
access to, along with the access details for each project, including the level of access, permissions, and any
relevant metadata about their access to the projects.

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the user ID is invalid


***

### listEnvironments

List all environments associated with a project. This method retrieves a list of all environments that are linked
to the specified project.

```php
public listEnvironments(string $projectId): \Upsun\Model\Environment[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### createIntegration

Integrates project with a third-party service

```php
public createIntegration(string $projectId, \Upsun\Model\IntegrationCreateInput $integrationCreateInput): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$integrationCreateInput` | **\Upsun\Model\IntegrationCreateInput** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid or if the provided integration details are not
valid


***

### deleteIntegration

Deletes an existing third-party integration

```php
public deleteIntegration(string $projectId, string $integrationId): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$integrationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or integration ID is invalid


***

### getIntegration

Gets information about an existing third-party integration

```php
public getIntegration(string $projectId, string $integrationId): \Upsun\Model\Integration
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$integrationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or integration ID is invalid


***

### listIntegrations

Gets list of existing integrations for a project

```php
public listIntegrations(string $projectId): \Upsun\Model\Integration[]
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID is invalid


***

### updateIntegration

Updates an existing third-party integration

```php
public updateIntegration(string $projectId, string $integrationId, \Upsun\Model\IntegrationPatch $integrationPatch): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$integrationId`    | **string**                        |             |
| `$integrationPatch` | **\Upsun\Model\IntegrationPatch** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or integration ID is invalid or if the
provided integration details are not valid


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
