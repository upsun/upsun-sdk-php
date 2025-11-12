# Environment

Low level Environment (auto-generated)

***

* Full name: `\Upsun\Model\Environment`
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

### name

```php
private string $name
```

***

### machineName

```php
private string $machineName
```

***

### title

```php
private string $title
```

***

### attributes

```php
private array $attributes
```

***

### type

```php
private string $type
```

***

### hasDomains

```php
private bool $hasDomains
```

***

### cloneParentOnCreate

```php
private bool $cloneParentOnCreate
```

***

### isPr

```php
private bool $isPr
```

***

### hasRemote

```php
private bool $hasRemote
```

***

### status

```php
private string $status
```

***

### httpAccess

```php
private \Upsun\Model\HttpAccessPermissions1 $httpAccess
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

### edgeHostname

```php
private string $edgeHostname
```

***

### resourcesOverrides

```php
private array $resourcesOverrides
```

***

### project

```php
private string $project
```

***

### isMain

```php
private bool $isMain
```

***

### isDirty

```php
private bool $isDirty
```

***

### hasStagedActivities

```php
private bool $hasStagedActivities
```

***

### canRollingDeploy

```php
private bool $canRollingDeploy
```

***

### supportsRollingDeployments

```php
private bool $supportsRollingDeployments
```

***

### hasCode

```php
private bool $hasCode
```

***

### mergeInfo

```php
private \Upsun\Model\MergeInfo $mergeInfo
```

***

### hasDeployment

```php
private bool $hasDeployment
```

***

### supportsRestrictRobots

```php
private bool $supportsRestrictRobots
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

### parent

```php
private ?string $parent
```

***

### defaultDomain

```php
private ?string $defaultDomain
```

***

### deploymentTarget

```php
private ?string $deploymentTarget
```

***

### deploymentState

```php
private ?\Upsun\Model\DeploymentState $deploymentState
```

***

### sizing

```php
private ?\Upsun\Model\Sizing $sizing
```

***

### maxInstanceCount

```php
private ?int $maxInstanceCount
```

***

### lastActiveAt

```php
private ?\DateTime $lastActiveAt
```

***

### lastBackupAt

```php
private ?\DateTime $lastBackupAt
```

***

### headCommit

```php
private ?string $headCommit
```

***

## Methods

### __construct

```php
public __construct(string $id, string $name, string $machineName, string $title, array $attributes, string $type, bool $hasDomains, bool $cloneParentOnCreate, bool $isPr, bool $hasRemote, string $status, \Upsun\Model\HttpAccessPermissions1 $httpAccess, bool $enableSmtp, bool $restrictRobots, string $edgeHostname, array $resourcesOverrides, string $project, bool $isMain, bool $isDirty, bool $hasStagedActivities, bool $canRollingDeploy, bool $supportsRollingDeployments, bool $hasCode, \Upsun\Model\MergeInfo $mergeInfo, bool $hasDeployment, bool $supportsRestrictRobots, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $parent, ?string $defaultDomain, ?string $deploymentTarget, ?\Upsun\Model\DeploymentState $deploymentState, ?\Upsun\Model\Sizing $sizing, ?int $maxInstanceCount, ?\DateTime $lastActiveAt, ?\DateTime $lastBackupAt, ?string $headCommit): mixed
```

**Parameters:**

| Parameter                     | Type                                    | Description |
|-------------------------------|-----------------------------------------|-------------|
| `$id`                         | **string**                              |             |
| `$name`                       | **string**                              |             |
| `$machineName`                | **string**                              |             |
| `$title`                      | **string**                              |             |
| `$attributes`                 | **array**                               |             |
| `$type`                       | **string**                              |             |
| `$hasDomains`                 | **bool**                                |             |
| `$cloneParentOnCreate`        | **bool**                                |             |
| `$isPr`                       | **bool**                                |             |
| `$hasRemote`                  | **bool**                                |             |
| `$status`                     | **string**                              |             |
| `$httpAccess`                 | **\Upsun\Model\HttpAccessPermissions1** |             |
| `$enableSmtp`                 | **bool**                                |             |
| `$restrictRobots`             | **bool**                                |             |
| `$edgeHostname`               | **string**                              |             |
| `$resourcesOverrides`         | **array**                               |             |
| `$project`                    | **string**                              |             |
| `$isMain`                     | **bool**                                |             |
| `$isDirty`                    | **bool**                                |             |
| `$hasStagedActivities`        | **bool**                                |             |
| `$canRollingDeploy`           | **bool**                                |             |
| `$supportsRollingDeployments` | **bool**                                |             |
| `$hasCode`                    | **bool**                                |             |
| `$mergeInfo`                  | **\Upsun\Model\MergeInfo**              |             |
| `$hasDeployment`              | **bool**                                |             |
| `$supportsRestrictRobots`     | **bool**                                |             |
| `$createdAt`                  | **?\DateTime**                          |             |
| `$updatedAt`                  | **?\DateTime**                          |             |
| `$parent`                     | **?string**                             |             |
| `$defaultDomain`              | **?string**                             |             |
| `$deploymentTarget`           | **?string**                             |             |
| `$deploymentState`            | **?\Upsun\Model\DeploymentState**       |             |
| `$sizing`                     | **?\Upsun\Model\Sizing**                |             |
| `$maxInstanceCount`           | **?int**                                |             |
| `$lastActiveAt`               | **?\DateTime**                          |             |
| `$lastBackupAt`               | **?\DateTime**                          |             |
| `$headCommit`                 | **?string**                             |             |

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

The identifier of Environment

```php
public getId(): string
```

***

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getName

The name of the environment

```php
public getName(): string
```

***

### getMachineName

The machine name for the environment

```php
public getMachineName(): string
```

***

### getTitle

The title of the environment

```php
public getTitle(): string
```

***

### getAttributes

```php
public getAttributes(): array
```

***

### getType

The type of environment (`production`, `staging` or `development`), if not provided, a default will be calculated

```php
public getType(): string
```

***

### getParent

The name of the parent environment

```php
public getParent(): ?string
```

***

### getDefaultDomain

The default domain

```php
public getDefaultDomain(): ?string
```

***

### getHasDomains

Whether the environment has domains

```php
public getHasDomains(): bool
```

***

### getCloneParentOnCreate

Clone data when creating that environment

```php
public getCloneParentOnCreate(): bool
```

***

### getDeploymentTarget

Deployment target of the environment

```php
public getDeploymentTarget(): ?string
```

***

### getIsPr

Is this environment a pull request / merge request

```php
public getIsPr(): bool
```

***

### getHasRemote

Does this environment have a remote repository

```php
public getHasRemote(): bool
```

***

### getStatus

The status of the environment

```php
public getStatus(): string
```

***

### getHttpAccess

The Http access permissions for this environment

```php
public getHttpAccess(): \Upsun\Model\HttpAccessPermissions1
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

### getEdgeHostname

The hostname to use as the CNAME

```php
public getEdgeHostname(): string
```

***

### getDeploymentState

The environment deployment state

```php
public getDeploymentState(): ?\Upsun\Model\DeploymentState
```

***

### getSizing

The environment sizing configuration

```php
public getSizing(): ?\Upsun\Model\Sizing
```

***

### getResourcesOverrides

Resources overrides

```php
public getResourcesOverrides(): \Upsun\Model\ResourcesOverridesValue[]
```

***

### getMaxInstanceCount

Max number of instances for this environment

```php
public getMaxInstanceCount(): ?int
```

***

### getLastActiveAt

Last activity date

```php
public getLastActiveAt(): ?\DateTime
```

***

### getLastBackupAt

Last backup date

```php
public getLastBackupAt(): ?\DateTime
```

***

### getProject

The project the environment belongs to

```php
public getProject(): string
```

***

### getIsMain

Is this environment the main environment

```php
public getIsMain(): bool
```

***

### getIsDirty

Is there any pending activity on this environment

```php
public getIsDirty(): bool
```

***

### getHasStagedActivities

Is there any staged activity on this environment

```php
public getHasStagedActivities(): bool
```

***

### getCanRollingDeploy

If the environment has rolling deployments ready for use

```php
public getCanRollingDeploy(): bool
```

***

### getSupportsRollingDeployments

If the environment supports rolling deployments

```php
public getSupportsRollingDeployments(): bool
```

***

### getHasCode

Does this environment have code

```php
public getHasCode(): bool
```

***

### getHeadCommit

The SHA of the head commit for this environment

```php
public getHeadCommit(): ?string
```

***

### getMergeInfo

The commit distance info between parent and child environments

```php
public getMergeInfo(): \Upsun\Model\MergeInfo
```

***

### getHasDeployment

Whether this environment had a successful deployment

```php
public getHasDeployment(): bool
```

***

### getSupportsRestrictRobots

Does this environment support configuring restrict_robots

```php
public getSupportsRestrictRobots(): bool
```

***
