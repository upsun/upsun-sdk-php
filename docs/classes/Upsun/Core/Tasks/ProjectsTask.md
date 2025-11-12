# ProjectsTask

ProjectTask class.

***

* Full name: `\Upsun\Core\Tasks\ProjectsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\ProjectApi $api
```

***

### settingsApi

```php
private \Upsun\Api\ProjectSettingsApi $settingsApi
```

***

### deploymentTargetApi

```php
private \Upsun\Api\DeploymentTargetApi $deploymentTargetApi
```

***

### repositoryApi

```php
private \Upsun\Api\RepositoryApi $repositoryApi
```

***

### systemInfoApi

```php
private \Upsun\Api\SystemInformationApi $systemInfoApi
```

***

### thirdPartyIntegrationsApi

```php
private \Upsun\Api\ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi
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
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ProjectApi $api, \Upsun\Api\ProjectSettingsApi $settingsApi, \Upsun\Api\DeploymentTargetApi $deploymentTargetApi, \Upsun\Api\RepositoryApi $repositoryApi, \Upsun\Api\SystemInformationApi $systemInfoApi, \Upsun\Api\ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi, \Upsun\Api\SubscriptionsApi $subscriptionsApi): mixed
```

**Parameters:**

| Parameter                    | Type                                     | Description |
|------------------------------|------------------------------------------|-------------|
| `$client`                    | **\Upsun\UpsunClient**                   |             |
| `$api`                       | **\Upsun\Api\ProjectApi**                |             |
| `$settingsApi`               | **\Upsun\Api\ProjectSettingsApi**        |             |
| `$deploymentTargetApi`       | **\Upsun\Api\DeploymentTargetApi**       |             |
| `$repositoryApi`             | **\Upsun\Api\RepositoryApi**             |             |
| `$systemInfoApi`             | **\Upsun\Api\SystemInformationApi**      |             |
| `$thirdPartyIntegrationsApi` | **\Upsun\Api\ThirdPartyIntegrationsApi** |             |
| `$subscriptionsApi`          | **\Upsun\Api\SubscriptionsApi**          |             |

***

### delete

Deletes a project

```php
public delete(string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

- [`ApiException`](../../Api/ApiException.md) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getCapabilities

Gets a project's capabilities

```php
public getCapabilities(string $projectId): \Upsun\Model\ProjectCapabilities
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### cancelInvite

Cancels a pending invitation to a project

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createInvite

Invites user to a project by email

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listInvites

Lists invitations to a project

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

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### getSettings

Gets list of project settings

```php
public getSettings(string $projectId): \Upsun\Model\ProjectSettings
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getVariable

Get a project variable

```php
public getVariable(string $projectId, string $projectVariableId): \Upsun\Model\ProjectVariable
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteVariable

Deletes a project variable

```php
public deleteVariable(string $projectId, string $projectVariableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$projectVariableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
public updateVariable(string $projectId, string $projectVariableId, ?string $name = null, ?string $value = null, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type        | Description |
|----------------------|-------------|-------------|
| `$projectId`         | **string**  |             |
| `$projectVariableId` | **string**  |             |
| `$name`              | **?string** |             |
| `$value`             | **?string** |             |
| `$attributes`        | **?array**  |             |
| `$isJson`            | **?bool**   |             |
| `$isSensitive`       | **?bool**   |             |
| `$visibleBuild`      | **?bool**   |             |
| `$visibleRuntime`    | **?bool**   |             |
| `$applicationScope`  | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createDeployment

Creates a project deployment target

```php
public createDeployment(string $projectId, string $type, string $name, ?array $hosts = [], ?array $enforcedMounts = null, ?array $siteUrls = null, ?array $sshHosts = [], ?array $enterpriseEnvironmentsMapping = null, ?bool $useDedicatedGrid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                        | Type       | Description |
|----------------------------------|------------|-------------|
| `$projectId`                     | **string** |             |
| `$type`                          | **string** |             |
| `$name`                          | **string** |             |
| `$hosts`                         | **?array** |             |
| `$enforcedMounts`                | **?array** |             |
| `$siteUrls`                      | **?array** |             |
| `$sshHosts`                      | **?array** |             |
| `$enterpriseEnvironmentsMapping` | **?array** |             |
| `$useDedicatedGrid`              | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteDeployment

Deletes a single project deployment target

```php
public deleteDeployment(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getDeployment

Gets a single project deployment target

```php
public getDeployment(string $projectId, string $deploymentTargetConfigurationId): \Upsun\Model\DeploymentTarget
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listDeployments

Gets project deployment target info

```php
public listDeployments(string $projectId): \Upsun\Model\DeploymentTarget[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateDeployment

Updates a project deployment

```php
public updateDeployment(string $projectId, string $deploymentTargetConfigurationId, string $type, string $name, ?array $hosts = [], ?array $enforcedMounts = null, ?array $siteUrls = null, ?array $sshHosts = [], ?array $enterpriseEnvironmentsMapping = null, ?bool $useDedicatedGrid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                          | Type       | Description |
|------------------------------------|------------|-------------|
| `$projectId`                       | **string** |             |
| `$deploymentTargetConfigurationId` | **string** |             |
| `$type`                            | **string** |             |
| `$name`                            | **string** |             |
| `$hosts`                           | **?array** |             |
| `$enforcedMounts`                  | **?array** |             |
| `$siteUrls`                        | **?array** |             |
| `$sshHosts`                        | **?array** |             |
| `$enterpriseEnvironmentsMapping`   | **?array** |             |
| `$useDedicatedGrid`                | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getGitBlob

Gets a blob object

```php
public getGitBlob(string $projectId, string $repositoryBlobId): \Upsun\Model\Blob
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryBlobId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getGitCommit

Gets a commit object

```php
public getGitCommit(string $projectId, string $repositoryCommitId): \Upsun\Model\Commit
```

**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$projectId`          | **string** |             |
| `$repositoryCommitId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getGitRef

Gets a Git ref object

```php
public getGitRef(string $projectId, string $repositoryRefId): \Upsun\Model\Ref
```

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$repositoryRefId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getGitTree

Gets a Git tree object

```php
public getGitTree(string $projectId, string $repositoryTreeId): \Upsun\Model\Tree
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryTreeId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listGitRefs

Gets list of repository refs

```php
public listGitRefs(string $projectId): \Upsun\Model\Ref[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### restartGitServer

Restarts the Git server

```php
public restartGitServer(string $projectId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getGitInfo

Get information about the Git server.

```php
public getGitInfo(string $projectId): \Upsun\Model\SystemInformation
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createIntegration

Integrates project with a third-party service

```php
public createIntegration(string $projectId, string $type, string $repository, string $url, string $username, string $token, string $project, string $serviceId, array $recipients, string $routingKey, string $channel, string $licenseKey, string $script, string $index, ?array $appCredentials = null, ?array $addonCredentials = null, ?string $fromAddress = null, ?string $sharedKey = null, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $pullRequestsCloneParentData = null, ?bool $resyncPullRequests = null, ?array $events = [], ?array $environments = [], ?array $excludedEnvironments = [], ?array $states = [], ?string $result = null, ?string $baseUrl = null, ?bool $buildDraftPullRequests = null, ?bool $buildPullRequestsPostMerge = null, ?bool $rotateToken = null, ?int $rotateTokenValidityInWeeks = null, ?bool $buildMergeRequests = null, ?bool $buildWipMergeRequests = null, ?bool $mergeRequestsCloneParentData = null, ?array $extra = [], ?array $headers = [], ?bool $tlsVerify = null, ?array $excludedServices = [], ?string $sourceType = null, ?string $category = null, ?string $host = null, ?int $port = null, ?string $protocol = null, ?int $facility = null, ?string $messageFormat = null, ?string $authToken = null, ?string $authMode = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                       | Type        | Description |
|---------------------------------|-------------|-------------|
| `$projectId`                    | **string**  |             |
| `$type`                         | **string**  |             |
| `$repository`                   | **string**  |             |
| `$url`                          | **string**  |             |
| `$username`                     | **string**  |             |
| `$token`                        | **string**  |             |
| `$project`                      | **string**  |             |
| `$serviceId`                    | **string**  |             |
| `$recipients`                   | **array**   |             |
| `$routingKey`                   | **string**  |             |
| `$channel`                      | **string**  |             |
| `$licenseKey`                   | **string**  |             |
| `$script`                       | **string**  |             |
| `$index`                        | **string**  |             |
| `$appCredentials`               | **?array**  |             |
| `$addonCredentials`             | **?array**  |             |
| `$fromAddress`                  | **?string** |             |
| `$sharedKey`                    | **?string** |             |
| `$fetchBranches`                | **?bool**   |             |
| `$pruneBranches`                | **?bool**   |             |
| `$environmentInitResources`     | **?string** |             |
| `$buildPullRequests`            | **?bool**   |             |
| `$pullRequestsCloneParentData`  | **?bool**   |             |
| `$resyncPullRequests`           | **?bool**   |             |
| `$events`                       | **?array**  |             |
| `$environments`                 | **?array**  |             |
| `$excludedEnvironments`         | **?array**  |             |
| `$states`                       | **?array**  |             |
| `$result`                       | **?string** |             |
| `$baseUrl`                      | **?string** |             |
| `$buildDraftPullRequests`       | **?bool**   |             |
| `$buildPullRequestsPostMerge`   | **?bool**   |             |
| `$rotateToken`                  | **?bool**   |             |
| `$rotateTokenValidityInWeeks`   | **?int**    |             |
| `$buildMergeRequests`           | **?bool**   |             |
| `$buildWipMergeRequests`        | **?bool**   |             |
| `$mergeRequestsCloneParentData` | **?bool**   |             |
| `$extra`                        | **?array**  |             |
| `$headers`                      | **?array**  |             |
| `$tlsVerify`                    | **?bool**   |             |
| `$excludedServices`             | **?array**  |             |
| `$sourceType`                   | **?string** |             |
| `$category`                     | **?string** |             |
| `$host`                         | **?string** |             |
| `$port`                         | **?int**    |             |
| `$protocol`                     | **?string** |             |
| `$facility`                     | **?int**    |             |
| `$messageFormat`                | **?string** |             |
| `$authToken`                    | **?string** |             |
| `$authMode`                     | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteIntegration

Deletes an existing third-party integration

```php
public deleteIntegration(string $projectId, string $integrationId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$integrationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getIntegration

Gets information about an existing third-party integration

```php
public getIntegration(string $projectId, string $integrationId): \Upsun\Model\Integration
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$integrationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listIntegrations

Gets list of existing integrations for a project

```php
public listIntegrations(string $projectId): \Upsun\Model\Integration[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateIntegration

Updates an existing third-party integration

```php
public updateIntegration(string $projectId, string $integrationId, string $type, string $repository, string $url, string $username, string $token, string $project, string $serviceId, array $recipients, string $routingKey, string $channel, string $licenseKey, string $script, string $index, ?array $appCredentials = null, ?array $addonCredentials = null, ?string $fromAddress = null, ?string $sharedKey = null, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $pullRequestsCloneParentData = null, ?bool $resyncPullRequests = null, ?array $events = [], ?array $environments = [], ?array $excludedEnvironments = [], ?array $states = [], ?string $result = null, ?string $baseUrl = null, ?bool $buildDraftPullRequests = null, ?bool $buildPullRequestsPostMerge = null, ?bool $rotateToken = null, ?int $rotateTokenValidityInWeeks = null, ?bool $buildMergeRequests = null, ?bool $buildWipMergeRequests = null, ?bool $mergeRequestsCloneParentData = null, ?array $extra = [], ?array $headers = [], ?bool $tlsVerify = null, ?array $excludedServices = [], ?string $sourceType = null, ?string $category = null, ?string $host = null, ?int $port = null, ?string $protocol = null, ?int $facility = null, ?string $messageFormat = null, ?string $authToken = null, ?string $authMode = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                       | Type        | Description |
|---------------------------------|-------------|-------------|
| `$projectId`                    | **string**  |             |
| `$integrationId`                | **string**  |             |
| `$type`                         | **string**  |             |
| `$repository`                   | **string**  |             |
| `$url`                          | **string**  |             |
| `$username`                     | **string**  |             |
| `$token`                        | **string**  |             |
| `$project`                      | **string**  |             |
| `$serviceId`                    | **string**  |             |
| `$recipients`                   | **array**   |             |
| `$routingKey`                   | **string**  |             |
| `$channel`                      | **string**  |             |
| `$licenseKey`                   | **string**  |             |
| `$script`                       | **string**  |             |
| `$index`                        | **string**  |             |
| `$appCredentials`               | **?array**  |             |
| `$addonCredentials`             | **?array**  |             |
| `$fromAddress`                  | **?string** |             |
| `$sharedKey`                    | **?string** |             |
| `$fetchBranches`                | **?bool**   |             |
| `$pruneBranches`                | **?bool**   |             |
| `$environmentInitResources`     | **?string** |             |
| `$buildPullRequests`            | **?bool**   |             |
| `$pullRequestsCloneParentData`  | **?bool**   |             |
| `$resyncPullRequests`           | **?bool**   |             |
| `$events`                       | **?array**  |             |
| `$environments`                 | **?array**  |             |
| `$excludedEnvironments`         | **?array**  |             |
| `$states`                       | **?array**  |             |
| `$result`                       | **?string** |             |
| `$baseUrl`                      | **?string** |             |
| `$buildDraftPullRequests`       | **?bool**   |             |
| `$buildPullRequestsPostMerge`   | **?bool**   |             |
| `$rotateToken`                  | **?bool**   |             |
| `$rotateTokenValidityInWeeks`   | **?int**    |             |
| `$buildMergeRequests`           | **?bool**   |             |
| `$buildWipMergeRequests`        | **?bool**   |             |
| `$mergeRequestsCloneParentData` | **?bool**   |             |
| `$extra`                        | **?array**  |             |
| `$headers`                      | **?array**  |             |
| `$tlsVerify`                    | **?bool**   |             |
| `$excludedServices`             | **?array**  |             |
| `$sourceType`                   | **?string** |             |
| `$category`                     | **?string** |             |
| `$host`                         | **?string** |             |
| `$port`                         | **?int**    |             |
| `$protocol`                     | **?string** |             |
| `$facility`                     | **?int**    |             |
| `$messageFormat`                | **?string** |             |
| `$authToken`                    | **?string** |             |
| `$authMode`                     | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createDomain

Adds a project domain

```php
public createDomain(string $projectId, string $name, ?array $attributes = null, ?bool $isDefault = null, ?string $replacementFor = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$projectId`      | **string**  |             |
| `$name`           | **string**  |             |
| `$attributes`     | **?array**  |             |
| `$isDefault`      | **?bool**   |             |
| `$replacementFor` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateDomain

Updates a project domain

```php
public updateDomain(string $projectId, string $domainId, ?array $attributes, ?bool $isDefault): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$domainId`   | **string** |             |
| `$attributes` | **?array** |             |
| `$isDefault`  | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createCertificate

Adds an SSL certificate

```php
public createCertificate(string $projectId, string $certificate, string $key, ?array $chain = null, ?bool $isInvalid = null): \Upsun\Model\AcceptedResponse
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


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

### runOperation

Executes a runtime operation

```php
public runOperation(string $projectId, string $environmentId, string $deploymentId, string $service, string $operation, array $parameters): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |
| `$service`       | **string** |             |
| `$operation`     | **string** |             |
| `$parameters`    | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectTeamAccess

Gets team access for a project

```php
public getProjectTeamAccess(string $projectId, string $teamId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTeamProjectAccess

Gets project access for a team

```php
public getTeamProjectAccess(string $teamId, string $projectId): \Upsun\Model\TeamProjectAccess
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantProjectTeamAccess

Grants team access to a project

```php
public grantProjectTeamAccess(string $projectId, array $grantProjectTeamAccessRequestInner): void
```

**Parameters:**

| Parameter                             | Type       | Description |
|---------------------------------------|------------|-------------|
| `$projectId`                          | **string** |             |
| `$grantProjectTeamAccessRequestInner` | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### grantTeamProjectAccess

Grants project access to a team

```php
public grantTeamProjectAccess(string $teamId, array $data): void
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$data`   | **array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectTeamAccess

Lists team access for a project

```php
public listProjectTeamAccess(string $projectId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
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

### listTeamProjectAccess

Lists project access for a team

```php
public listTeamProjectAccess(string $teamId, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListProjectTeamAccess200Response
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeProjectTeamAccess

Removes team access for a project

```php
public removeProjectTeamAccess(string $projectId, string $teamId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$teamId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### removeTeamProjectAccess

Removes project access for a team

```php
public removeTeamProjectAccess(string $teamId, string $projectId): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$teamId`    | **string** |             |
| `$projectId` | **string** |             |

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

### grantProjectUserAccess

Grants user access to a project

```php
public grantProjectUserAccess(string $projectId, array $data): void
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$data`      | **array**  |             |

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

### listEnvironments

Lists environments of a project

```php
public listEnvironments(string $projectId): \Upsun\Model\Environment[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


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

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***
