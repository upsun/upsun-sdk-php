# Deployment

Low level Deployment (auto-generated)

***

* Full name: `\Upsun\Model\Deployment`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### clusterName

```php
private string $clusterName
```

***

### projectInfo

```php
private \Upsun\Model\ProjectInfo $projectInfo
```

***

### environmentInfo

```php
private \Upsun\Model\EnvironmentInfo $environmentInfo
```

***

### deploymentTarget

```php
private string $deploymentTarget
```

***

### httpAccess

```php
private \Upsun\Model\HttpAccessPermissions $httpAccess
```

***

### enableSmtp

```php
private bool $enableSmtp
```

***

### restrictRobots

```php
private bool $restrictRobots
```

***

### variables

```php
private array $variables
```

***

### access

```php
private array $access
```

***

### subscription

```php
private \Upsun\Model\Subscription1 $subscription
```

***

### services

```php
private array $services
```

***

### routes

```php
private array $routes
```

***

### webapps

```php
private array $webapps
```

***

### workers

```php
private array $workers
```

***

### containerProfiles

```php
private string $containerProfiles
```

***

### vpn

```php
private ?\Upsun\Model\VPNConfiguration $vpn
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### fingerprint

```php
private ?string $fingerprint
```

***

## Methods

### __construct

```php
public __construct(string $id, string $clusterName, \Upsun\Model\ProjectInfo $projectInfo, \Upsun\Model\EnvironmentInfo $environmentInfo, string $deploymentTarget, \Upsun\Model\HttpAccessPermissions $httpAccess, bool $enableSmtp, bool $restrictRobots, array $variables, array $access, \Upsun\Model\Subscription1 $subscription, array $services, array $routes, array $webapps, array $workers, string $containerProfiles, ?\Upsun\Model\VPNConfiguration $vpn, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?string $fingerprint = null): mixed
```

**Parameters:**

| Parameter            | Type                                   | Description |
|----------------------|----------------------------------------|-------------|
| `$id`                | **string**                             |             |
| `$clusterName`       | **string**                             |             |
| `$projectInfo`       | **\Upsun\Model\ProjectInfo**           |             |
| `$environmentInfo`   | **\Upsun\Model\EnvironmentInfo**       |             |
| `$deploymentTarget`  | **string**                             |             |
| `$httpAccess`        | **\Upsun\Model\HttpAccessPermissions** |             |
| `$enableSmtp`        | **bool**                               |             |
| `$restrictRobots`    | **bool**                               |             |
| `$variables`         | **array**                              |             |
| `$access`            | **array**                              |             |
| `$subscription`      | **\Upsun\Model\Subscription1**         |             |
| `$services`          | **array**                              |             |
| `$routes`            | **array**                              |             |
| `$webapps`           | **array**                              |             |
| `$workers`           | **array**                              |             |
| `$containerProfiles` | **string**                             |             |
| `$vpn`               | **?\Upsun\Model\VPNConfiguration**     |             |
| `$createdAt`         | **?\DateTime**                         |             |
| `$updatedAt`         | **?\DateTime**                         |             |
| `$fingerprint`       | **?string**                            |             |

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getId

The identifier of Deployment

```php
public getId(): string
```

***

### getClusterName

The name of the cluster

```php
public getClusterName(): string
```

***

### getProjectInfo

The project information

```php
public getProjectInfo(): \Upsun\Model\ProjectInfo
```

***

### getEnvironmentInfo

The environment information

```php
public getEnvironmentInfo(): \Upsun\Model\EnvironmentInfo
```

***

### getDeploymentTarget

The deployment target

```php
public getDeploymentTarget(): string
```

***

### getVpn

The configuration of the VPN

```php
public getVpn(): ?\Upsun\Model\VPNConfiguration
```

***

### getHttpAccess

The permissions of the HTTP access

```php
public getHttpAccess(): \Upsun\Model\HttpAccessPermissions
```

***

### getEnableSmtp

Whether to configure SMTP for this environment

```php
public getEnableSmtp(): bool
```

***

### getRestrictRobots

Whether to restrict robots for this environment

```php
public getRestrictRobots(): bool
```

***

### getVariables

The variables applying to this environment

```php
public getVariables(): \Upsun\Model\EnvironmentVariablesInner[]
```

***

### getAccess

Access control definition for this enviroment

```php
public getAccess(): \Upsun\Model\AccessControlInner[]
```

***

### getSubscription

Subscription

```php
public getSubscription(): \Upsun\Model\Subscription1
```

***

### getServices

The services

```php
public getServices(): \Upsun\Model\ServicesValue[]
```

***

### getRoutes

The routes

```php
public getRoutes(): \Upsun\Model\RoutesValue[]
```

***

### getWebapps

The Web applications

```php
public getWebapps(): \Upsun\Model\WebApplicationsValue[]
```

***

### getWorkers

The workers

```php
public getWorkers(): \Upsun\Model\WorkersValue[]
```

***

### getContainerProfiles

```php
public getContainerProfiles(): string
```

***

### getCreatedAt

The creation date of the deployment

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date of the deployment

```php
public getUpdatedAt(): ?\DateTime
```

***

### getFingerprint

The fingerprint of the deployment

```php
public getFingerprint(): ?string
```

***
