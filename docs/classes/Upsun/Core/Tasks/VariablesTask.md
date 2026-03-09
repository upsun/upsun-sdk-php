# VariablesTask

VariablesTask class.

***

* Full name: `\Upsun\Core\Tasks\VariablesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### projectVariablesApi

```php
private \Upsun\Api\ProjectVariablesApi $projectVariablesApi
```

***

### environmentVariablesApi

```php
private \Upsun\Api\EnvironmentVariablesApi $environmentVariablesApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ProjectVariablesApi $projectVariablesApi, \Upsun\Api\EnvironmentVariablesApi $environmentVariablesApi): mixed
```

**Parameters:**

| Parameter                  | Type                                   | Description |
|----------------------------|----------------------------------------|-------------|
| `$client`                  | **\Upsun\UpsunClient**                 |             |
| `$projectVariablesApi`     | **\Upsun\Api\ProjectVariablesApi**     |             |
| `$environmentVariablesApi` | **\Upsun\Api\EnvironmentVariablesApi** |             |

***

### createProjectVariable

Adds a project variable

```php
public createProjectVariable(string $projectId, string $name, string $value, ?array $attributes = [], ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = []): \Upsun\Model\AcceptedResponse
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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### deleteProjectVariable

Deletes a project variable

```php
public deleteProjectVariable(string $projectId, string $variableId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$variableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### getProjectVariable

Gets a project variable

```php
public getProjectVariable(string $projectId, string $variableId): \Upsun\Model\ProjectVariable
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$variableId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listProjectVariables

Gets list of project variables

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateProjectVariable

Updates a project variable

```php
public updateProjectVariable(string $projectId, string $variableId, ?string $name = null, ?string $value = null, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null): \Upsun\Model\AcceptedResponse
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### createEnvironmentVariable

Adds an environment variable

```php
public createEnvironmentVariable(string $projectId, string $environmentId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null): \Upsun\Model\AcceptedResponse
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

### deleteEnvironmentVariable

Deletes an environment variable

```php
public deleteEnvironmentVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\AcceptedResponse
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

### getEnvironmentVariable

Gets an environment variable

```php
public getEnvironmentVariable(string $projectId, string $environmentId, string $variableId): \Upsun\Model\EnvironmentVariable
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

### listEnvironmentVariables

Lists environment variables

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### updateEnvironmentVariable

Updates an environment variable

```php
public updateEnvironmentVariable(string $projectId, string $environmentId, string $variableId, string $name, string $value, ?array $attributes = null, ?bool $isJson = null, ?bool $isSensitive = null, ?bool $visibleBuild = null, ?bool $visibleRuntime = null, ?array $applicationScope = null, ?bool $isEnabled = null, ?bool $isInheritable = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$environmentId`    | **string** |             |
| `$variableId`       | **string** |             |
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
