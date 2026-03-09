# SupportTicketsTask

SupportTicketTask class.

***

* Full name: `\Upsun\Core\Tasks\SupportTicketsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### defaultApi

```php
private \Upsun\Api\DefaultApi $defaultApi
```

***

### supportApi

```php
private \Upsun\Api\SupportApi $supportApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\DefaultApi $defaultApi, \Upsun\Api\SupportApi $supportApi): mixed
```

**Parameters:**

| Parameter     | Type                      | Description |
|---------------|---------------------------|-------------|
| `$client`     | **\Upsun\UpsunClient**    |             |
| `$defaultApi` | **\Upsun\Api\DefaultApi** |             |
| `$supportApi` | **\Upsun\Api\SupportApi** |             |

***

### list

Lists support tickets

```php
public list(?int $filterTicketId = null, ?\DateTime $filterCreated = null, ?\DateTime $filterUpdated = null, ?string $filterType = null, ?string $filterPriority = null, ?string $filterStatus = null, ?string $filterRequesterId = null, ?string $filterSubmitterId = null, ?string $filterAssigneeId = null, ?bool $filterHasIncidents = null, ?\DateTime $filterDue = null, ?string $search = null, ?int $page = null): \Upsun\Model\ListTickets200Response
```

**Parameters:**

| Parameter             | Type           | Description |
|-----------------------|----------------|-------------|
| `$filterTicketId`     | **?int**       |             |
| `$filterCreated`      | **?\DateTime** |             |
| `$filterUpdated`      | **?\DateTime** |             |
| `$filterType`         | **?string**    |             |
| `$filterPriority`     | **?string**    |             |
| `$filterStatus`       | **?string**    |             |
| `$filterRequesterId`  | **?string**    |             |
| `$filterSubmitterId`  | **?string**    |             |
| `$filterAssigneeId`   | **?string**    |             |
| `$filterHasIncidents` | **?bool**      |             |
| `$filterDue`          | **?\DateTime** |             |
| `$search`             | **?string**    |             |
| `$page`               | **?int**       |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### create

Creates a new support ticket

```php
public create(string $subject, string $description, ?string $requesterId = null, ?string $priority = null, ?string $subscriptionId = null, ?string $organizationId = null, ?string $affectedUrl = null, ?string $followupTid = null, ?string $category = null, ?array $attachments = [], ?array $collaboratorIds = []): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$subject`         | **string**  |             |
| `$description`     | **string**  |             |
| `$requesterId`     | **?string** |             |
| `$priority`        | **?string** |             |
| `$subscriptionId`  | **?string** |             |
| `$organizationId`  | **?string** |             |
| `$affectedUrl`     | **?string** |             |
| `$followupTid`     | **?string** |             |
| `$category`        | **?string** |             |
| `$attachments`     | **?array**  |             |
| `$collaboratorIds` | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listCategories

Lists support ticket categories

```php
public listCategories(?string $organizationId = null, ?string $projectId = null): \Upsun\Model\ListTicketCategories200ResponseInner[]
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **?string** |             |
| `$projectId`      | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listPriorities

Lists support ticket priorities

```php
public listPriorities(?string $projectId = null, ?string $category = null): \Upsun\Model\ListTicketPriorities200ResponseInner[]
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$projectId` | **?string** |             |
| `$category`  | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### update

Updates a ticket

```php
public update(string $ticketId, ?string $status = null, ?array $collaboratorIds = [], ?bool $collaboratorsReplace = null): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$ticketId`             | **string**  |             |
| `$status`               | **?string** |             |
| `$collaboratorIds`      | **?array**  |             |
| `$collaboratorsReplace` | **?bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
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
