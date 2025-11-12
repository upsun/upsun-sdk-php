# EnvironmentsTask

EnvironmentTask class.

***

* Full name: `\Upsun\Core\Tasks\EnvironmentsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\EnvironmentApi $api
```

***

### typeApi

```php
private \Upsun\Api\EnvironmentTypeApi $typeApi
```

***

### deploymentApi

```php
private \Upsun\Api\DeploymentApi $deploymentApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\EnvironmentApi $api, \Upsun\Api\EnvironmentTypeApi $typeApi, \Upsun\Api\DeploymentApi $deploymentApi): mixed
```

**Parameters:**

| Parameter        | Type                              | Description |
|------------------|-----------------------------------|-------------|
| `$client`        | **\Upsun\UpsunClient**            |             |
| `$api`           | **\Upsun\Api\EnvironmentApi**     |             |
| `$typeApi`       | **\Upsun\Api\EnvironmentTypeApi** |             |
| `$deploymentApi` | **\Upsun\Api\DeploymentApi**      |             |

***

### activate

Activates an environment

```php
public activate(string $projectId, string $environmentId, string $init): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$init`          | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### branch

Branchs an environment

```php
public branch(string $projectId, string $environmentId, string $title, string $name, bool $cloneParent, string $type, ?string $init = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **string**  |             |
| `$title`         | **string**  |             |
| `$name`          | **string**  |             |
| `$cloneParent`   | **bool**    |             |
| `$type`          | **string**  |             |
| `$init`          | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createVersions

Creates versions associated with the environment

```php
public createVersions(string $projectId, string $environmentId, ?int $percentage = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$percentage`    | **?int**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deactivate

Deactivates an environment

```php
public deactivate(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### delete

Deletes an environment

```php
public delete(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteVersions

Deletes the version

```php
public deleteVersions(string $projectId, string $environmentId, string $versionId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets an environment

```php
public get(string $projectId, string $environmentId): \Upsun\Model\Environment
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getVersions

Lists the version

```php
public getVersions(string $projectId, string $environmentId, string $versionId): \Upsun\Model\Version
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### initialize

Initializes a new environment

```php
public initialize(string $projectId, string $environmentId, string $profile, string $repository, string $fileMode, string $filePath, string $fileContents, ?string $config = null, ?int $init = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **string**  |             |
| `$profile`       | **string**  |             |
| `$repository`    | **string**  |             |
| `$fileMode`      | **string**  |             |
| `$filePath`      | **string**  |             |
| `$fileContents`  | **string**  |             |
| `$config`        | **?string** |             |
| `$init`          | **?int**    |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

Gets list of project environments

```php
public list(string $projectId): \Upsun\Model\Environment[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### listVersions

Lists versions associated with the environment

```php
public listVersions(string $projectId, string $environmentId): \Upsun\Model\Version[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### merge

Merges an environment

```php
public merge(string $projectId, string $environmentId, ?int $init = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$init`          | **?int**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### pause

Pauses an environment

```php
public pause(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### redeploy

Redeploys an environment

```php
public redeploy(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### resume

Resume a paused environment

```php
public resume(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### synchronize

Synchronizes a child environment with its parent

```php
public synchronize(string $projectId, string $environmentId, bool $synchronizeCode, bool $rebase, bool $synchronizeData, bool $synchronizeResources): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter               | Type       | Description |
|-------------------------|------------|-------------|
| `$projectId`            | **string** |             |
| `$environmentId`        | **string** |             |
| `$synchronizeCode`      | **bool**   |             |
| `$rebase`               | **bool**   |             |
| `$synchronizeData`      | **bool**   |             |
| `$synchronizeResources` | **bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates an environment

```php
public update(string $projectId, string $environmentId, ?string $parent = null, ?string $name = null, ?string $title = null, ?array $attributes = null, ?string $type = null, ?bool $cloneParentOnCreate = null, null|array{isEnabled?: bool, addresses?: array{permission: string, address: string}, basicAuth?: array} $httpAccess = null, ?bool $enableSmtp = null, ?bool $restrictRobots = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter              | Type                                                                                                         | Description |
|------------------------|--------------------------------------------------------------------------------------------------------------|-------------|
| `$projectId`           | **string**                                                                                                   |             |
| `$environmentId`       | **string**                                                                                                   |             |
| `$parent`              | **?string**                                                                                                  |             |
| `$name`                | **?string**                                                                                                  |             |
| `$title`               | **?string**                                                                                                  |             |
| `$attributes`          | **?array**                                                                                                   |             |
| `$type`                | **?string**                                                                                                  |             |
| `$cloneParentOnCreate` | **?bool**                                                                                                    |             |
| `$httpAccess`          | **null\|array{isEnabled?: bool, addresses?: array{permission: string, address: string}, basicAuth?: array}** |             |
| `$enableSmtp`          | **?bool**                                                                                                    |             |
| `$restrictRobots`      | **?bool**                                                                                                    |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateVersions

Updates the version

```php
public updateVersions(string $projectId, string $environmentId, string $versionId, ?int $percentage = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |
| `$percentage`    | **?int**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### activityCancel

Cancels an environment activity

```php
public activityCancel(string $projectId, string $environmentId, string $activityId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$activityId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getActivities

Gets an environment activity log entry

```php
public getActivities(string $projectId, string $environmentId, string $activityId): \Upsun\Model\Activity
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$activityId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listActivities

Gets environment activity log

```php
public listActivities(string $projectId, string $environmentId): \Upsun\Model\Activity[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### backup

Creates snapshot of environment

```php
public backup(string $projectId, string $environmentId, bool $isSafe): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$isSafe`        | **bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteBackup

Deletes an environment snapshot

```php
public deleteBackup(string $projectId, string $environmentId, string $backupId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getBackup

Gets an environment snapshot's info

```php
public getBackup(string $projectId, string $environmentId, string $backupId): \Upsun\Model\Backup
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listBackups

Gets an environment's snapshot list

```php
public listBackups(string $projectId, string $environmentId): \Upsun\Model\Backup[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### restoreBackup

Restores an environment snapshot

```php
public restoreBackup(string $projectId, string $environmentId, string $backupId, bool $restoreCode, bool $restoreResources, ?string $environmentName = null, ?string $branchFrom = null, ?string $init = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$projectId`        | **string**  |             |
| `$environmentId`    | **string**  |             |
| `$backupId`         | **string**  |             |
| `$restoreCode`      | **bool**    |             |
| `$restoreResources` | **bool**    |             |
| `$environmentName`  | **?string** |             |
| `$branchFrom`       | **?string** |             |
| `$init`             | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getType

Gets environment type links

```php
public getType(string $projectId, string $environmentTypeId): \Upsun\Model\EnvironmentType
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectId`         | **string** |             |
| `$environmentTypeId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTypes

Gets environment types

```php
public listTypes(string $projectId): \Upsun\Model\EnvironmentType[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### createVariable

Adds an Environment or Project variable

```php
public createVariable(string $projectId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$projectId`        | **string**  |             |
| `$name`             | **string**  |             |
| `$value`            | **string**  |             |
| `$attributes`       | **?array**  |             |
| `$isJson`           | **?bool**   |             |
| `$isSensitive`      | **?bool**   |             |
| `$visibleBuild`     | **?bool**   |             |
| `$visibleRuntime`   | **?bool**   |             |
| `$applicationScope` | **?array**  |             |
| `$isEnabled`        | **?bool**   |             |
| `$isInheritable`    | **?bool**   |             |
| `$environmentId`    | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteVariable

Deletes an environment variable

```php
public deleteVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getVariable

Gets an environment variable

```php
public getVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\EnvironmentVariable
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$variableId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listEnvironmentVariables

Gets list of Environment variables

```php
public listEnvironmentVariables(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### listProjectVariables

Gets list of Project variables

```php
public listProjectVariables(string $projectId): \Upsun\Model\ProjectVariable[]
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

Updates an environment variable

```php
public updateVariable(string $projectId, string $environmentId, string $variableId, ?string $name = null, ?string $value = null, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$projectId`        | **string**  |             |
| `$environmentId`    | **string**  |             |
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getRoute

Gets a route's info

```php
public getRoute(string $projectId, string $environmentId, string $routeId): \Upsun\Model\Route
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$routeId`       | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listRoutes

Gets list of routes

```php
public listRoutes(string $projectId, string $environmentId): \Upsun\Model\Route[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### createDomain

Adds an environment domain

```php
public createDomain(string $projectId, string $name, ?array $attributes = null, ?bool $isDefault = null, ?string $replacementFor = null, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$projectId`      | **string**  |             |
| `$name`           | **string**  |             |
| `$attributes`     | **?array**  |             |
| `$isDefault`      | **?bool**   |             |
| `$replacementFor` | **?string** |             |
| `$environmentId`  | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteDomain

Deletes an environment domain

```php
public deleteDomain(string $projectId, string $environmentId, string $domainId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getDomain

Gets an environment domain

```php
public getDomain(string $projectId, string $environmentId, string $domainId): \Upsun\Model\Domain
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listDomains

Gets a list of environment domains

```php
public listDomains(string $projectId, string $environmentId): \Upsun\Model\Domain[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### updateDomain

Updates an environment domain

```php
public updateDomain(string $projectId, string $environmentId, string $domainId, ?array $attributes = null, ?bool $isDefault = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |
| `$attributes`    | **?array** |             |
| `$isDefault`     | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getDeployment

Gets a single environment deployment

```php
public getDeployment(string $projectId, string $environmentId, string $deploymentId): \Upsun\Model\Deployment
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listDeployments

Gets an environment's deployment information

```php
public listDeployments(string $projectId, string $environmentId): \Upsun\Model\Deployment[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### listSourceOperations

Lists source operations

```php
public listSourceOperations(string $projectId, string $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### runSourceOperation

Triggers a source operation

```php
public runSourceOperation(string $projectId, string $environmentId, string $operation, array $variables): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$operation`     | **string** |             |
| `$variables`     | **array**  |             |

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

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***
