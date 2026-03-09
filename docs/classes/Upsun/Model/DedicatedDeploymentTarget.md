# DedicatedDeploymentTarget

Low level DedicatedDeploymentTarget (auto-generated)

***

* Full name: `\Upsun\Model\DedicatedDeploymentTarget`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\DeploymentTarget`](./DeploymentTarget.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant          | Visibility | Type | Value        |
|-------------------|------------|------|--------------|
| `TYPE_DEDICATED`  | public     |      | 'dedicated'  |
| `TYPE_ENTERPRISE` | public     |      | 'enterprise' |
| `TYPE_LOCAL`      | public     |      | 'local'      |

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

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, bool $autoMounts, array $excludedMounts, object $enforcedMounts, bool $autoCrons, bool $autoNginx, bool $maintenanceMode, int $guardrailsPhase, ?string $deployHost, ?int $deployPort, ?string $sshHost, ?array $hosts, ?string $id = null): mixed
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$type`            | **string**  |             |
| `$name`            | **string**  |             |
| `$autoMounts`      | **bool**    |             |
| `$excludedMounts`  | **array**   |             |
| `$enforcedMounts`  | **object**  |             |
| `$autoCrons`       | **bool**    |             |
| `$autoNginx`       | **bool**    |             |
| `$maintenanceMode` | **bool**    |             |
| `$guardrailsPhase` | **int**     |             |
| `$deployHost`      | **?string** |             |
| `$deployPort`      | **?int**    |             |
| `$sshHost`         | **?string** |             |
| `$hosts`           | **?array**  |             |
| `$id`              | **?string** |             |

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

### getId

The identifier of DedicatedDeploymentTarget

```php
public getId(): ?string
```

***
