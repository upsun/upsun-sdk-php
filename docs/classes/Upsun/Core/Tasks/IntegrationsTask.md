# IntegrationsTask

IntegrationsTask class.

***

* Full name: `\Upsun\Core\Tasks\IntegrationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### thirdPartyIntegrationsApi

```php
private \Upsun\Api\ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ThirdPartyIntegrationsApi $thirdPartyIntegrationsApi): mixed
```

**Parameters:**

| Parameter                    | Type                                     | Description |
|------------------------------|------------------------------------------|-------------|
| `$client`                    | **\Upsun\UpsunClient**                   |             |
| `$thirdPartyIntegrationsApi` | **\Upsun\Api\ThirdPartyIntegrationsApi** |             |

***

### createIntegration

Create an integration for a project.

```php
public createIntegration(string $projectId, \Upsun\Model\IntegrationCreateInput $integrationCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                                    | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
|---------------------------|-----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`              | **string**                              |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| `$integrationCreateInput` | **\Upsun\Model\IntegrationCreateInput** | An implementation of the IntegrationCreateInput interface.
Use one of the concrete types that implement this interface:
 - BitbucketIntegrationCreateInput
 - BitbucketServerIntegrationCreateInput
 - GitHubIntegrationCreateInput
 - GitLabIntegrationCreateInput
 - WebhookIntegrationCreateInput
 - HealthEmailIntegrationCreateInput
 - HealthPagerdutyIntegrationCreateInput
 - HealthSlackIntegrationCreateInput
 - HealthWebhookIntegrationCreateInput
 - ScriptIntegrationCreateInput
 - NewRelicIntegrationCreateInput
 - SplunkIntegrationCreateInput
 - SumoLogicIntegrationCreateInput
 - SyslogIntegrationCreateInput
 - DatadogIntegrationCreateInput
 - AppDynamicsIntegrationCreateInput
 - LogstashIntegrationCreateInput
 - DynatraceIntegrationCreateInput |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteIntegration

Delete a third-party integration from a project. This method allows you to delete an existing integration from a
project.

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
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or integration ID is invalid


***

### listIntegrations

List all third-party integrations for a project. This method retrieves a list of all integrations that are
associated with the specified project.

```php
public listIntegrations(string $projectId): \Upsun\Model\Integration[]
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

### getIntegration

Get the details of a specific third-party integration for a project. This method retrieves the details of a
specific integration that is associated with the specified project.

```php
public getIntegration(string $projectId, string $integrationId): \Upsun\Model\Integration
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$integrationId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID or integration ID is invalid
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateIntegration

Update an existing third-party integration for a project. This method allows you to update the configuration of an
existing integration for a project by specifying the new parameters for that integration.

```php
public updateIntegration(string $projectId, string $integrationId, \Upsun\Model\IntegrationPatch $integrationUpdateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                              | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
|---------------------------|-----------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$projectId`              | **string**                        |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| `$integrationId`          | **string**                        |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| `$integrationUpdateInput` | **\Upsun\Model\IntegrationPatch** | An implementation of the IntegrationPatch interface.
Use one of the concrete types that implement this interface:
 - BitbucketIntegrationPatch
 - BitbucketServerIntegrationPatch
 - GitHubIntegrationPatch
 - GitLabIntegrationPatch
 - WebhookIntegrationPatch
 - HealthEmailIntegrationPatch
 - HealthPagerdutyIntegrationPatch
 - HealthSlackIntegrationPatch
 - HealthWebhookIntegrationPatch
 - ScriptIntegrationPatch
 - NewRelicIntegrationPatch
 - SplunkIntegrationPatch
 - SumoLogicIntegrationPatch
 - SyslogIntegrationPatch
 - DatadogIntegrationPatch
 - AppDynamicsIntegrationPatch
 - LogstashIntegrationPatch
 - DynatraceIntegrationPatch |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network errors or if the request cannot be completed
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if the project ID, integration ID, or integration update input is invalid


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
