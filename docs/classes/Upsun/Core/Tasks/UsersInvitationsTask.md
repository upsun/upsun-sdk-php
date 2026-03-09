# UsersInvitationsTask

UsersInvitationsTask class.

***

* Full name: `\Upsun\Core\Tasks\UsersInvitationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### orgInvApi

```php
private \Upsun\Api\OrganizationInvitationsApi $orgInvApi
```

***

### prjInvApi

```php
private \Upsun\Api\ProjectInvitationsApi $prjInvApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\OrganizationInvitationsApi $orgInvApi, \Upsun\Api\ProjectInvitationsApi $prjInvApi): mixed
```

**Parameters:**

| Parameter    | Type                                      | Description |
|--------------|-------------------------------------------|-------------|
| `$client`    | **\Upsun\UpsunClient**                    |             |
| `$orgInvApi` | **\Upsun\Api\OrganizationInvitationsApi** |             |
| `$prjInvApi` | **\Upsun\Api\ProjectInvitationsApi**      |             |

***

### cancelOrgInvite

Cancels a pending invitation to an organization

```php
public cancelOrgInvite(string $organizationId, string $invitationId): void
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$invitationId`   | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### createOrgInvite

Invites user to an organization by email

```php
public createOrgInvite(string $organizationId, string $email, array $permissions, ?bool $force = true): \Upsun\Model\OrganizationInvitation
```

**Parameters:**

| Parameter         | Type       | Description |
|-------------------|------------|-------------|
| `$organizationId` | **string** |             |
| `$email`          | **string** |             |
| `$permissions`    | **array**  |             |
| `$force`          | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listOrgInvites

Lists invitations to an organization

```php
public listOrgInvites(string $organizationId, ?array $filterState = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\OrganizationInvitation[]
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **string**  |             |
| `$filterState`    | **?array**  |             |
| `$pageSize`       | **?int**    |             |
| `$pageBefore`     | **?string** |             |
| `$pageAfter`      | **?string** |             |
| `$sort`           | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### cancelProjectInvite

Cancels a pending invitation to a project

```php
public cancelProjectInvite(string $projectId, string $invitationId): void
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$projectId`    | **string** |             |
| `$invitationId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### createProjectInvite

Invites user to a project by email

```php
public createProjectInvite(string $projectId, string $email, ?string $role = null, array<int,"read"|"write"|"admin">|null $permissions = null, array<int,array{id: string, name: string}>|null $environments = null, ?bool $force = null): \Upsun\Model\ProjectInvitation
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) on network error
- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) if required parameters are missing or invalid


***

### listProjectInvites

Lists invitations to a project

```php
public listProjectInvites(string $projectId, ?array $filterState = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ProjectInvitation[]
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
