# TeamsApi

Low level TeamsApi (auto-generated)

***

* Full name: `\Upsun\Api\TeamsApi`
* Parent class: [`\Upsun\Api\AbstractApi`](./AbstractApi.md)
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### headerSelector

```php
private \Upsun\Api\ApiHeaderSelector $headerSelector
```

***

### config

```php
private \Upsun\Api\APIConfiguration $config
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, ?\Psr\Http\Client\ClientInterface $httpClient = null, ?\Psr\Http\Message\RequestFactoryInterface $requestFactory = null, ?\Upsun\Api\APIConfiguration $config = null, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null, ?\Upsun\Api\ApiHeaderSelector $selector = null): mixed
```

**Parameters:**

| Parameter         | Type                                           | Description |
|-------------------|------------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                  |             |
| `$httpClient`     | **?\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **?\Psr\Http\Message\RequestFactoryInterface** |             |
| `$config`         | **?\Upsun\Api\APIConfiguration**               |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface**  |             |
| `$selector`       | **?\Upsun\Api\ApiHeaderSelector**              |             |

***

### createTeam

Create team

```php
public createTeam(\Upsun\Model\CreateTeamRequest $createTeamRequest): \Upsun\Model\Team
```

Creates a new team.

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$createTeamRequest` | **\Upsun\Model\CreateTeamRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/create-team

***

### createTeamWithHttpInfo

Create team with HTTP Info

```php
private createTeamWithHttpInfo(\Upsun\Model\CreateTeamRequest $createTeamRequest): \Upsun\Model\Team
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$createTeamRequest` | **\Upsun\Model\CreateTeamRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createTeamRequest

Create request for operation 'createTeam'

```php
private createTeamRequest(\Upsun\Model\CreateTeamRequest $createTeamRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$createTeamRequest` | **\Upsun\Model\CreateTeamRequest** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### createTeamMember

Create team member

```php
public createTeamMember(string $teamId, \Upsun\Model\CreateTeamMemberRequest $createTeamMemberRequest): \Upsun\Model\TeamMember
```

Creates a new team member.

**Parameters:**

| Parameter                  | Type                                     | Description                    |
|----------------------------|------------------------------------------|--------------------------------|
| `$teamId`                  | **string**                               | The ID of the team. (required) |
| `$createTeamMemberRequest` | **\Upsun\Model\CreateTeamMemberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/create-team-member

***

### createTeamMemberWithHttpInfo

Create team member with HTTP Info

```php
private createTeamMemberWithHttpInfo(string $teamId, \Upsun\Model\CreateTeamMemberRequest $createTeamMemberRequest): \Upsun\Model\TeamMember
```

**Parameters:**

| Parameter                  | Type                                     | Description                    |
|----------------------------|------------------------------------------|--------------------------------|
| `$teamId`                  | **string**                               | The ID of the team. (required) |
| `$createTeamMemberRequest` | **\Upsun\Model\CreateTeamMemberRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createTeamMemberRequest

Create request for operation 'createTeamMember'

```php
private createTeamMemberRequest(string $teamId, \Upsun\Model\CreateTeamMemberRequest $createTeamMemberRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                  | Type                                     | Description                    |
|----------------------------|------------------------------------------|--------------------------------|
| `$teamId`                  | **string**                               | The ID of the team. (required) |
| `$createTeamMemberRequest` | **\Upsun\Model\CreateTeamMemberRequest** |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteTeam

Delete team

```php
public deleteTeam(string $teamId): void
```

Deletes the specified team.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/delete-team

***

### deleteTeamWithHttpInfo

Delete team with HTTP Info

```php
private deleteTeamWithHttpInfo(string $teamId): void
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteTeamRequest

Create request for operation 'deleteTeam'

```php
private deleteTeamRequest(string $teamId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteTeamMember

Delete team member

```php
public deleteTeamMember(string $teamId, string $userId): void
```

Deletes the specified team member.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/delete-team-member

***

### deleteTeamMemberWithHttpInfo

Delete team member with HTTP Info

```php
private deleteTeamMemberWithHttpInfo(string $teamId, string $userId): void
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteTeamMemberRequest

Create request for operation 'deleteTeamMember'

```php
private deleteTeamMemberRequest(string $teamId, string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getTeam

Get team

```php
public getTeam(string $teamId): \Upsun\Model\Team
```

Retrieves the specified team.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/get-team

***

### getTeamWithHttpInfo

Get team with HTTP Info

```php
private getTeamWithHttpInfo(string $teamId): \Upsun\Model\Team
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTeamRequest

Create request for operation 'getTeam'

```php
private getTeamRequest(string $teamId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getTeamMember

Get team member

```php
public getTeamMember(string $teamId, string $userId): \Upsun\Model\TeamMember
```

Retrieves the specified team member.

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/get-team-member

***

### getTeamMemberWithHttpInfo

Get team member with HTTP Info

```php
private getTeamMemberWithHttpInfo(string $teamId, string $userId): \Upsun\Model\TeamMember
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getTeamMemberRequest

Create request for operation 'getTeamMember'

```php
private getTeamMemberRequest(string $teamId, string $userId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$teamId` | **string** | The ID of the team. (required) |
| `$userId` | **string** | The ID of the user. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listTeamMembers

List team members

```php
public listTeamMembers(string $teamId, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeamMembers200Response
```

Retrieves a list of users associated with a single team.

**Parameters:**

| Parameter     | Type             | Description                    |
|---------------|------------------|--------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required) |
| `$pageBefore` | **string\|null** | (optional)                     |
| `$pageAfter`  | **string\|null** | (optional)                     |
| `$sort`       | **string\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/list-team-members

***

### listTeamMembersWithHttpInfo

List team members with HTTP Info

```php
private listTeamMembersWithHttpInfo(string $teamId, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeamMembers200Response
```

**Parameters:**

| Parameter     | Type             | Description                    |
|---------------|------------------|--------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required) |
| `$pageBefore` | **string\|null** | (optional)                     |
| `$pageAfter`  | **string\|null** | (optional)                     |
| `$sort`       | **string\|null** | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTeamMembersRequest

Create request for operation 'listTeamMembers'

```php
private listTeamMembersRequest(string $teamId, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type             | Description                    |
|---------------|------------------|--------------------------------|
| `$teamId`     | **string**       | The ID of the team. (required) |
| `$pageBefore` | **string\|null** | (optional)                     |
| `$pageAfter`  | **string\|null** | (optional)                     |
| `$sort`       | **string\|null** | (optional)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listTeams

List teams

```php
public listTeams(\Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeams200Response
```

Retrieves a list of teams.

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterId`             | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)  |
| `$pageSize`             | **int\|null**                         | (optional)  |
| `$pageBefore`           | **string\|null**                      | (optional)  |
| `$pageAfter`            | **string\|null**                      | (optional)  |
| `$sort`                 | **string\|null**                      | (optional)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/list-teams

***

### listTeamsWithHttpInfo

List teams with HTTP Info

```php
private listTeamsWithHttpInfo(\Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterId`             | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)  |
| `$pageSize`             | **int\|null**                         | (optional)  |
| `$pageBefore`           | **string\|null**                      | (optional)  |
| `$pageAfter`            | **string\|null**                      | (optional)  |
| `$sort`                 | **string\|null**                      | (optional)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTeamsRequest

Create request for operation 'listTeams'

```php
private listTeamsRequest(\Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\StringFilter|null $filterId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                                  | Description |
|-------------------------|---------------------------------------|-------------|
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterId`             | **\Upsun\Model\StringFilter\|null**   | (optional)  |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)  |
| `$pageSize`             | **int\|null**                         | (optional)  |
| `$pageBefore`           | **string\|null**                      | (optional)  |
| `$pageAfter`            | **string\|null**                      | (optional)  |
| `$sort`                 | **string\|null**                      | (optional)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listUserTeams

User teams

```php
public listUserTeams(string $userId, \Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeams200Response
```

Retrieves teams that the specified user is a member of.

**Parameters:**

| Parameter               | Type                                  | Description                    |
|-------------------------|---------------------------------------|--------------------------------|
| `$userId`               | **string**                            | The ID of the user. (required) |
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)                     |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)                     |
| `$pageSize`             | **int\|null**                         | (optional)                     |
| `$pageBefore`           | **string\|null**                      | (optional)                     |
| `$pageAfter`            | **string\|null**                      | (optional)                     |
| `$sort`                 | **string\|null**                      | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/list-user-teams

***

### listUserTeamsWithHttpInfo

User teams with HTTP Info

```php
private listUserTeamsWithHttpInfo(string $userId, \Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListTeams200Response
```

**Parameters:**

| Parameter               | Type                                  | Description                    |
|-------------------------|---------------------------------------|--------------------------------|
| `$userId`               | **string**                            | The ID of the user. (required) |
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)                     |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)                     |
| `$pageSize`             | **int\|null**                         | (optional)                     |
| `$pageBefore`           | **string\|null**                      | (optional)                     |
| `$pageAfter`            | **string\|null**                      | (optional)                     |
| `$sort`                 | **string\|null**                      | (optional)                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listUserTeamsRequest

Create request for operation 'listUserTeams'

```php
private listUserTeamsRequest(string $userId, \Upsun\Model\StringFilter|null $filterOrganizationId = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                                  | Description                    |
|-------------------------|---------------------------------------|--------------------------------|
| `$userId`               | **string**                            | The ID of the user. (required) |
| `$filterOrganizationId` | **\Upsun\Model\StringFilter\|null**   | (optional)                     |
| `$filterUpdatedAt`      | **\Upsun\Model\DateTimeFilter\|null** | (optional)                     |
| `$pageSize`             | **int\|null**                         | (optional)                     |
| `$pageBefore`           | **string\|null**                      | (optional)                     |
| `$pageAfter`            | **string\|null**                      | (optional)                     |
| `$sort`                 | **string\|null**                      | (optional)                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateTeam

Update team

```php
public updateTeam(string $teamId, ?\Upsun\Model\UpdateTeamRequest $updateTeamRequest = null): \Upsun\Model\Team
```

Updates the specified team.

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$teamId`            | **string**                          | The ID of the team. (required) |
| `$updateTeamRequest` | **?\Upsun\Model\UpdateTeamRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Teams/operation/update-team

***

### updateTeamWithHttpInfo

Update team with HTTP Info

```php
private updateTeamWithHttpInfo(string $teamId, ?\Upsun\Model\UpdateTeamRequest $updateTeamRequest = null): \Upsun\Model\Team
```

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$teamId`            | **string**                          | The ID of the team. (required) |
| `$updateTeamRequest` | **?\Upsun\Model\UpdateTeamRequest** |                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateTeamRequest

Create request for operation 'updateTeam'

```php
private updateTeamRequest(string $teamId, ?\Upsun\Model\UpdateTeamRequest $updateTeamRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type                                | Description                    |
|----------------------|-------------------------------------|--------------------------------|
| `$teamId`            | **string**                          | The ID of the team. (required) |
| `$updateTeamRequest` | **?\Upsun\Model\UpdateTeamRequest** |                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, \Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $baseUri, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                 |             |
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$baseUri`        | **string**                                    |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface** |             |

***

### getAuthorizationHeader

```php
protected getAuthorizationHeader(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createAuthenticatedRequest

```php
protected createAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### sendAuthenticatedRequest

```php
protected sendAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\ResponseInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### refreshToken

```php
public refreshToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createRequest

Create request

```php
protected createRequest(string $method, string|\Psr\Http\Message\UriInterface $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string\|\Psr\Http\Message\UriInterface**          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

***

### createUri

```php
protected createUri(string $operationHost, string $resourcePath, array $queryParams): \Psr\Http\Message\UriInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$operationHost` | **string** |             |
| `$resourcePath`  | **string** |             |
| `$queryParams`   | **array**  |             |

***

### handleResponseWithDataType

```php
protected handleResponseWithDataType(class-string<\Upsun\Api\T>|string $dataType, \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Upsun\Api\T
```

**Parameters:**

| Parameter   | Type                                    | Description                                                       |
|-------------|-----------------------------------------|-------------------------------------------------------------------|
| `$dataType` | **class-string<\Upsun\Api\T>\|string**  | Fully-qualified class name, or scalar type like "string", "array" |
| `$request`  | **\Psr\Http\Message\RequestInterface**  |                                                                   |
| `$response` | **\Psr\Http\Message\ResponseInterface** |                                                                   |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserializeGenericArray

Deserialize generic types array<key,value>

```php
protected deserializeGenericArray(mixed $content, string $dataType, \Psr\Http\Message\RequestInterface $request): array
```

**Parameters:**

| Parameter   | Type                                   | Description |
|-------------|----------------------------------------|-------------|
| `$content`  | **mixed**                              |             |
| `$dataType` | **string**                             |             |
| `$request`  | **\Psr\Http\Message\RequestInterface** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
