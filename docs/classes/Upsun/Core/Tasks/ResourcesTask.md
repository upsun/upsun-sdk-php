# ResourcesTask

ResourcesTask class.

***

* Full name: `\Upsun\Core\Tasks\ResourcesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### deploymentApi

```php
private \Upsun\Api\DeploymentApi $deploymentApi
```

***

### autoscalingApi

```php
private \Upsun\Api\AutoscalingApi $autoscalingApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\DeploymentApi $deploymentApi, \Upsun\Api\AutoscalingApi $autoscalingApi): mixed
```

**Parameters:**

| Parameter         | Type                          | Description |
|-------------------|-------------------------------|-------------|
| `$client`         | **\Upsun\UpsunClient**        |             |
| `$deploymentApi`  | **\Upsun\Api\DeploymentApi**  |             |
| `$autoscalingApi` | **\Upsun\Api\AutoscalingApi** |             |

***

### get

Get the resource configuration for a specific application in the current deployment of an environment.

```php
public get(string $projectId, string $environmentId, string $type = "webapps", string $app = 'app'): \Upsun\Model\Resources|null
```

This method retrieves the resource configuration for a specific application (webapp, service, or worker) in the
current deployment of an environment.

**Parameters:**

| Parameter        | Type       | Description                                                                                     |
|------------------|------------|-------------------------------------------------------------------------------------------------|
| `$projectId`     | **string** |                                                                                                 |
| `$environmentId` | **string** |                                                                                                 |
| `$type`          | **string** | - the application type, e.g. "webapps", "services", or "workers"                                |
| `$app`           | **string** | - the application name, e.g. "app" for webapps, or the service/worker name for
services/workers |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the projectId or environmentId is invalid


***

### set

Update resources for a deployment

```php
public set(string $projectId, string $environmentId, ?array $webapps = [], null|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}> $services = [], null|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}> $workers = []): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                                                                                                      | Description |
|------------------|-----------------------------------------------------------------------------------------------------------|-------------|
| `$projectId`     | **string**                                                                                                |             |
| `$environmentId` | **string**                                                                                                |             |
| `$webapps`       | **?array**                                                                                                |             |
| `$services`      | **null\|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}>** |             |
| `$workers`       | **null\|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}>** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the projectId or environmentId is invalid


***

### update

```php
public update(string $projectId, string $environmentId, ?array $webapps = [], ?array $services = [], ?array $workers = []): \Upsun\Model\AcceptedResponse
```

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.
**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$webapps`       | **?array** |             |
| `$services`      | **?array** |             |
| `$workers`       | **?array** |             |

***

### getAutoscalerSettings

Get the autoscaler settings for the environment. Autoscaling allows the environment to automatically scale its
resources up or down based on the current load and traffic. The autoscaler settings include information about
whether autoscaling is enabled, the addresses that are being autoscaled, and any authentication settings for the
autoscaler services.

```php
public getAutoscalerSettings(string $projectId, string $environmentId): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the projectId or environmentId is invalid


***

### updateAutoscalerSettings

Update the autoscaler settings for the environment. Autoscaling allows the environment to automatically scale its
resources up or down based on the current load and traffic. The autoscaler settings include information about
whether autoscaling is enabled, the addresses that are being autoscaled, and any authentication settings for the
autoscaler services. Updating the autoscaler settings will allow you to enable or disable autoscaling, change the
addresses that are being autoscaled, and update the authentication settings for the autoscaler services.

```php
public updateAutoscalerSettings(string $projectId, string $environmentId, array{services?: array<string,array<string,array{triggers?: array{cpu?: array<string,array<string,mixed>>|null, memory?: array<string,array<string,mixed>>|null, cpuPressure?: array<string,array<string,mixed>>|null, memoryPressure?: array<string,array<string,mixed>>|null}, instances?: array{min?: int|float, max?: int|float}, resources?: array{cpu?: array<string,array<string,mixed>>|null, memory?: array<string,array<string,mixed>>|null}, scaleFactor?: array{up?: int|float, down?: int|float}, scaleCooldown?: array{up?: int|float, down?: int|float}}>|null>|null} $services = null): \Upsun\Model\AutoscalerSettings
```

**Parameters:**

| Parameter        | Type                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   | Description |
|------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------|
| `$projectId`     | **string**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |             |
| `$environmentId` | **string**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |             |
| `$services`      | **array{services?: array<string,array<string,array{triggers?: array{cpu?: array<string,array<string,mixed>>\|null, memory?: array<string,array<string,mixed>>\|null, cpuPressure?: array<string,array<string,mixed>>\|null, memoryPressure?: array<string,array<string,mixed>>\|null}, instances?: array{min?: int\|float, max?: int\|float}, resources?: array{cpu?: array<string,array<string,mixed>>\|null, memory?: array<string,array<string,mixed>>\|null}, scaleFactor?: array{up?: int\|float, down?: int\|float}, scaleCooldown?: array{up?: int\|float, down?: int\|float}}>\|null>\|null}** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the projectId or environmentId is invalid


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
