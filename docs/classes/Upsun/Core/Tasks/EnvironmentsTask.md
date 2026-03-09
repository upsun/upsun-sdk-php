# EnvironmentsTask

EnvironmentsTask class.

***

* Full name: `\Upsun\Core\Tasks\EnvironmentsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### envApi

```php
private \Upsun\Api\EnvironmentApi $envApi
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
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\EnvironmentApi $envApi, \Upsun\Api\EnvironmentTypeApi $typeApi, \Upsun\Api\DeploymentApi $deploymentApi): mixed
```

**Parameters:**

| Parameter        | Type                              | Description |
|------------------|-----------------------------------|-------------|
| `$client`        | **\Upsun\UpsunClient**            |             |
| `$envApi`        | **\Upsun\Api\EnvironmentApi**     |             |
| `$typeApi`       | **\Upsun\Api\EnvironmentTypeApi** |             |
| `$deploymentApi` | **\Upsun\Api\DeploymentApi**      |             |

***

### activate

Activate an environment

```php
public activate(string $projectId, string $environmentId, ?string $init = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **string**  |             |
| `$init`          | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### branch

Branch an environment

```php
public branch(string $projectId, string $environmentId, string $title, string $name, bool $cloneParent = true, string $type = \Upsun\Model\Environment::TYPE_DEVELOPMENT, ?string $init = null): \Upsun\Model\AcceptedResponse
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

### deactivate

Deactivate an environment

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

Delete an environment

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

### httpAccess

Update the HTTP access permissions for the environment.

```php
public httpAccess(string $projectId, string $environmentId, ?bool $isEnabled = true, array{isEnabled?: bool, permission: string, address: string} $addresses = null, array{login: string, password: string} $basicAuth = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                                                             | Description |
|------------------|------------------------------------------------------------------|-------------|
| `$projectId`     | **string**                                                       |             |
| `$environmentId` | **string**                                                       |             |
| `$isEnabled`     | **?bool**                                                        |             |
| `$addresses`     | **array{isEnabled?: bool, permission: string, address: string}** |             |
| `$basicAuth`     | **array{login: string, password: string}**                       |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### get

Get details of a specific environment. The details include information about the environment's current status.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### info

Get or Update details of the environment. If extra parameters are provided, the environment will be updated with
the specified parameters before returning the details.

```php
public info(string $projectId, string $environmentId, ?string $parent = null, ?string $name = null, ?string $title = null, ?array $attributes = null, ?string $type = null, ?bool $cloneParentOnCreate = null, ?array $httpAccess = null, ?bool $enableSmtp = null, ?bool $restrictRobots = null): \Upsun\Model\Environment
```

**Parameters:**

| Parameter              | Type        | Description |
|------------------------|-------------|-------------|
| `$projectId`           | **string**  |             |
| `$environmentId`       | **string**  |             |
| `$parent`              | **?string** |             |
| `$name`                | **?string** |             |
| `$title`               | **?string** |             |
| `$attributes`          | **?array**  |             |
| `$type`                | **?string** |             |
| `$cloneParentOnCreate` | **?bool**   |             |
| `$httpAccess`          | **?array**  |             |
| `$enableSmtp`          | **?bool**   |             |
| `$restrictRobots`      | **?bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### init

Initialize the environment by deploying code from a specified repository and profile, with optional configuration
and initialization parameters.

```php
public init(string $projectId, string $environmentId, string $profile, string $repository, string $fileMode, string $filePath, string $fileContents, ?string $config = null, ?string $init = \Upsun\Model\Resources4::INIT__DEFAULT): \Upsun\Model\AcceptedResponse
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
| `$init`          | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### list

Get list of project environments

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### logs

```php
public logs(string $projectId, string $environmentId, string $appName): array
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$appName`       | **string** |             |

***

### merge

Merge an environment

```php
public merge(string $projectId, string $environmentId, ?string $init = \Upsun\Model\Resources5::INIT__DEFAULT): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **string**  |             |
| `$init`          | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### pause

Pause an environment

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### redeploy

Redeploy an environment

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### relationships

Get the relationships of an environment, which include the linked applications or services.

```php
public relationships(string $projectId, string $environmentId, string $applicationId): \Upsun\Model\ServiceRelationshipsValue[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$applicationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### synchronize

Synchronize a child environment with its parent

```php
public synchronize(string $projectId, string $environmentId, bool $synchronizeCode = true, bool $rebase = true, bool $synchronizeData = true, bool $synchronizeResources = true): \Upsun\Model\AcceptedResponse
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### update

Update an environment

```php
public update(string $projectId, string $environmentId, ?string $parent = null, ?string $name = null, ?string $title = null, ?array $attributes = null, ?string $type = null, ?bool $cloneParentOnCreate = null, null|array{isEnabled?: bool, addresses?: array{permission: string, address: string}, basicAuth?: array{login: string, password: string}} $httpAccess = null, ?bool $enableSmtp = null, ?bool $restrictRobots = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter              | Type                                                                                                                                          | Description |
|------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|-------------|
| `$projectId`           | **string**                                                                                                                                    |             |
| `$environmentId`       | **string**                                                                                                                                    |             |
| `$parent`              | **?string**                                                                                                                                   |             |
| `$name`                | **?string**                                                                                                                                   |             |
| `$title`               | **?string**                                                                                                                                   |             |
| `$attributes`          | **?array**                                                                                                                                    |             |
| `$type`                | **?string**                                                                                                                                   |             |
| `$cloneParentOnCreate` | **?bool**                                                                                                                                     |             |
| `$httpAccess`          | **null\|array{isEnabled?: bool, addresses?: array{permission: string, address: string}, basicAuth?: array{login: string, password: string}}** |             |
| `$enableSmtp`          | **?bool**                                                                                                                                     |             |
| `$restrictRobots`      | **?bool**                                                                                                                                     |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### activityCancel

Cancel an ongoing activity on the environment, such as deployment, synchronization, etc.

```php
public activityCancel(string $projectId, string $environmentId, string $activityId): \Upsun\Model\AcceptedResponse
```

The cancellation will be best-effort and may not succeed if the activity is too close to completion.
The API will return a 202 Accepted response if the cancellation request has been accepted,
but the client should check the environment's current activities to confirm whether the cancellation was
successful or not.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$activityId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getActivity

Get an environment activity log entry

```php
public getActivity(string $projectId, string $environmentId, string $activityId): \Upsun\Model\Activity
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getActivities

Get an environment activity log entry

```php
public getActivities(string $projectId, string $environmentId, string $activityId): \Upsun\Model\Activity
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$activityId`    | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listActivities

Get environment activity log

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### backup

Create snapshot of environment
Trigger a backup of the environment. The backup will be created asynchronously, and the API will return
a 202 Accepted response if the backup request has been accepted. The client can then check the list of backups to
monitor the progress and confirm when the backup is completed.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listBackups

List all backups of the environment.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### deleteBackup

Delete an environment snapshot

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getBackup

Get an environment snapshot's info

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### restoreBackup

Restore an environment snapshot

```php
public restoreBackup(string $projectId, string $environmentId, string $backupId, bool $restoreCode = true, bool $restoreResources = true, ?string $environmentName = null, ?string $branchFrom = null, ?string $init = \Upsun\Model\Resources6::INIT__DEFAULT): \Upsun\Model\AcceptedResponse
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getType

Get details of a specific environment type, such as development, production, etc.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listTypes

List all environment types available in the project. Environment types represent different categories or
classifications of environments, such as development, staging, production, etc. Each environment type may have
specific characteristics or configurations that differentiate it from other types.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### createVariable

Create an environment variable in the environment. Environment variables are used to store configuration values
that can be accessed by the applications running in the environment. The name of the variable must be unique
within the environment. If a variable with the same name already exists, the API will return an error.

```php
public createVariable(string $projectId, string $environmentId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$environmentId`    | **string** |             |
| `$name`             | **string** |             |
| `$value`            | **string** |             |
| `$attributes`       | **?array** |             |
| `$isJson`           | **?bool**  |             |
| `$isSensitive`      | **?bool**  |             |
| `$visibleBuild`     | **?bool**  |             |
| `$visibleRuntime`   | **?bool**  |             |
| `$applicationScope` | **?array** |             |
| `$isEnabled`        | **?bool**  |             |
| `$isInheritable`    | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### deleteVariable

Delete an environment variable

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getVariable

Get an environment variable

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listVariables

Get list of Environment variables

```php
public listVariables(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listEnvironmentVariables

Get list of Environment variables

```php
public listEnvironmentVariables(string $projectId, string $environmentId): \Upsun\Model\EnvironmentVariable[]
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listProjectVariables

Get list of Project variables

```php
public listProjectVariables(string $projectId): \Upsun\Model\ProjectVariable[]
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateVariable

Update an environment variable

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getRoute

Get a route's info

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listRoutes

Get list of routes

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### addDomain

Add an environment domain

```php
public addDomain(string $projectId, \Upsun\Model\DomainCreateInput $domainCreateInput, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** |             |
| `$environmentId`     | **?string**                        |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### deleteDomain

Delete an environment domain

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getDomain

Get an environment domain

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listDomains

Get a list of environment domains

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateDomain

Update an environment domain

```php
public updateDomain(string $projectId, string $environmentId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                         | Description                                                               |
|------------------|------------------------------|---------------------------------------------------------------------------|
| `$projectId`     | **string**                   |                                                                           |
| `$environmentId` | **string**                   |                                                                           |
| `$domainId`      | **string**                   |                                                                           |
| `$domainPatch`   | **\Upsun\Model\DomainPatch** | is an instance of ProdDomainStoragePatch or ReplacementDomainStoragePatch |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getDeployment

Get a single environment deployment

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listDeployments

Get an environment's deployment information

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

List source operations

```php
public listSourceOperations(string $projectId, string $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### runSourceOperation

Trigger a source operation

```php
public runSourceOperation(string $projectId, string $environmentId, string $operation, array $variables): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


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
