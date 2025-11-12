# UpsunClient

Upsun Client to interact with the API.

***

* Full name: `\Upsun\UpsunClient`

**See Also:**

* https://docs.upsun.com

## Properties

### apiClient

```php
public \Psr\Http\Client\ClientInterface $apiClient
```

***

### apiConfig

```php
public \Upsun\Api\ApiConfiguration $apiConfig
```

***

### auth

```php
public \Upsun\Core\OAuthProvider $auth
```

***

### userId

```php
public ?string $userId
```

***

### activities

```php
public \Upsun\Core\Tasks\ActivitiesTask $activities
```

***

### applications

```php
public \Upsun\Core\Tasks\ApplicationsTask $applications
```

***

### backups

```php
public \Upsun\Core\Tasks\BackupsTask $backups
```

***

### certificates

```php
public \Upsun\Core\Tasks\CertificatesTask $certificates
```

***

### domains

```php
public \Upsun\Core\Tasks\DomainsTask $domains
```

***

### environments

```php
public \Upsun\Core\Tasks\EnvironmentsTask $environments
```

***

### invitations

```php
public \Upsun\Core\Tasks\InvitationsTask $invitations
```

***

### metrics

```php
public \Upsun\Core\Tasks\MetricsTask $metrics
```

***

### mounts

```php
public \Upsun\Core\Tasks\MountsTask $mounts
```

***

### operations

```php
public \Upsun\Core\Tasks\OperationsTask $operations
```

***

### organizations

```php
public \Upsun\Core\Tasks\OrganizationsTask $organizations
```

***

### projects

```php
public \Upsun\Core\Tasks\ProjectsTask $projects
```

***

### regions

```php
public \Upsun\Core\Tasks\RegionsTask $regions
```

***

### resources

```php
public \Upsun\Core\Tasks\ResourcesTask $resources
```

***

### routes

```php
public \Upsun\Core\Tasks\RoutesTask $routes
```

***

### sourceOperations

```php
public \Upsun\Core\Tasks\SourceOperationsTask $sourceOperations
```

***

### teams

```php
public \Upsun\Core\Tasks\TeamsTask $teams
```

***

### supportTickets

```php
public \Upsun\Core\Tasks\SupportTicketsTask $supportTickets
```

***

### users

```php
public \Upsun\Core\Tasks\UsersTask $users
```

***

### variables

```php
public \Upsun\Core\Tasks\VariablesTask $variables
```

***

### workers

```php
public \Upsun\Core\Tasks\WorkersTask $workers
```

***

### upsunConfig

```php
protected \Upsun\UpsunConfig $upsunConfig
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunConfig $upsunConfig): mixed
```

**Parameters:**

| Parameter      | Type                   | Description |
|----------------|------------------------|-------------|
| `$upsunConfig` | **\Upsun\UpsunConfig** |             |

***

### getToken

```php
public getToken(): string
```

***
