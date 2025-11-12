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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createMember

Creates team member

```php
public createMember(string $teamId, string $userId): \Upsun\Model\TeamMember
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |
| `$userId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets team

```php
public get(string $teamId): \Upsun\Model\Team
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$teamId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


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

### list

Lists teams

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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserTeams

Lists User teams

```php
public listUserTeams(string $userId, ?array $filterOrganizationId = null, ?array $filterUpdatedAt = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListTeams200Response
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
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates team

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
