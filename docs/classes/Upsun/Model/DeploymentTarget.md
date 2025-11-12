# DeploymentTarget

Low level DeploymentTarget (auto-generated)

***

* Full name: `\Upsun\Model\DeploymentTarget`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### name

```php
private string $name
```

***

### autoMounts

```php
private bool $autoMounts
```

***

### excludedMounts

```php
private array $excludedMounts
```

***

### enforcedMounts

```php
private object $enforcedMounts
```

***

### autoCrons

```php
private bool $autoCrons
```

***

### autoNginx

```php
private bool $autoNginx
```

***

### maintenanceMode

```php
private bool $maintenanceMode
```

***

### guardrailsPhase

```php
private int $guardrailsPhase
```

***

### docroots

```php
private array $docroots
```

***

### siteUrls

```php
private object $siteUrls
```

***

### sshHosts

```php
private array $sshHosts
```

***

### useDedicatedGrid

```php
private bool $useDedicatedGrid
```

***

### deployHost

```php
private ?string $deployHost
```

***

### deployPort

```php
private ?int $deployPort
```

***

### sshHost

```php
private ?string $sshHost
```

***

### hosts

```php
private ?array $hosts
```

***

### storageType

```php
private ?string $storageType
```

***

### id

```php
private ?string $id
```

***

### enterpriseEnvironmentsMapping

```php
private ?object $enterpriseEnvironmentsMapping
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, bool $autoMounts, array $excludedMounts, object $enforcedMounts, bool $autoCrons, bool $autoNginx, bool $maintenanceMode, int $guardrailsPhase, array $docroots, object $siteUrls, array $sshHosts, bool $useDedicatedGrid, ?string $deployHost, ?int $deployPort, ?string $sshHost, ?array $hosts, ?string $storageType, ?string $id = null, ?object $enterpriseEnvironmentsMapping = null): mixed
```

**Parameters:**

| Parameter                        | Type        | Description |
|----------------------------------|-------------|-------------|
| `$type`                          | **string**  |             |
| `$name`                          | **string**  |             |
| `$autoMounts`                    | **bool**    |             |
| `$excludedMounts`                | **array**   |             |
| `$enforcedMounts`                | **object**  |             |
| `$autoCrons`                     | **bool**    |             |
| `$autoNginx`                     | **bool**    |             |
| `$maintenanceMode`               | **bool**    |             |
| `$guardrailsPhase`               | **int**     |             |
| `$docroots`                      | **array**   |             |
| `$siteUrls`                      | **object**  |             |
| `$sshHosts`                      | **array**   |             |
| `$useDedicatedGrid`              | **bool**    |             |
| `$deployHost`                    | **?string** |             |
| `$deployPort`                    | **?int**    |             |
| `$sshHost`                       | **?string** |             |
| `$hosts`                         | **?array**  |             |
| `$storageType`                   | **?string** |             |
| `$id`                            | **?string** |             |
| `$enterpriseEnvironmentsMapping` | **?object** |             |

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

### getType

The type of the deployment target.

```php
public getType(): string
```

***

### getName

The name of the deployment target.

```php
public getName(): string
```

***

### getDeployHost

The host to deploy to.

```php
public getDeployHost(): ?string
```

***

### getDeployPort

The port to deploy to.

```php
public getDeployPort(): ?int
```

***

### getSshHost

The host to use to SSH to app containers.

```php
public getSshHost(): ?string
```

***

### getHosts

The hosts of the deployment target.

```php
public getHosts(): \Upsun\Model\HostsInner[]|null
```

***

### getAutoMounts

Whether to take application mounts from the pushed data or the deployment target.

```php
public getAutoMounts(): bool
```

***

### getExcludedMounts

```php
public getExcludedMounts(): array
```

***

### getEnforcedMounts

Mounts which are always injected into pushed (e.g. enforce /var/log to be a local mount).

```php
public getEnforcedMounts(): object
```

***

### getAutoCrons

Whether to take application crons from the pushed data or the deployment target.

```php
public getAutoCrons(): bool
```

***

### getAutoNginx

Whether to take application crons from the pushed data or the deployment target.

```php
public getAutoNginx(): bool
```

***

### getMaintenanceMode

Whether to perform deployments or not

```php
public getMaintenanceMode(): bool
```

***

### getGuardrailsPhase

which phase of guardrails are we in

```php
public getGuardrailsPhase(): int
```

***

### getDocroots

Mapping of clusters to Enterprise applications

```php
public getDocroots(): \Upsun\Model\DocrootsValue[]
```

***

### getSiteUrls

```php
public getSiteUrls(): object
```

***

### getSshHosts

```php
public getSshHosts(): array
```

***

### getUseDedicatedGrid

When true, the deployment will be pinned to Grid hosts dedicated to the environment using this deployment target.

```php
public getUseDedicatedGrid(): bool
```

Dedicated Grid hosts must be created prior to deploying the environment. The constraints that will be set are as
follows: * `cluster_type` is set to `environment-custom`. * `cluster` is set to the environment's cluster name.

***

### getStorageType

The storage type.

```php
public getStorageType(): ?string
```

***

### getId

The identifier of FoundationDeploymentTarget

```php
public getId(): ?string
```

***

### getEnterpriseEnvironmentsMapping

Mapping of clusters to Enterprise applications

```php
public getEnterpriseEnvironmentsMapping(): ?object
```

***
