# DeploymentTargetPatch

Low level DeploymentTargetPatch (auto-generated)

***

* Full name: `\Upsun\Model\DeploymentTargetPatch`
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

### hosts

```php
private ?array $hosts
```

***

### enforcedMounts

```php
private ?object $enforcedMounts
```

***

### siteUrls

```php
private ?object $siteUrls
```

***

### sshHosts

```php
private ?array $sshHosts
```

***

### enterpriseEnvironmentsMapping

```php
private ?object $enterpriseEnvironmentsMapping
```

***

### useDedicatedGrid

```php
private ?bool $useDedicatedGrid
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, ?array $hosts = [], ?object $enforcedMounts = null, ?object $siteUrls = null, ?array $sshHosts = [], ?object $enterpriseEnvironmentsMapping = null, ?bool $useDedicatedGrid = null): mixed
```

**Parameters:**

| Parameter                        | Type        | Description |
|----------------------------------|-------------|-------------|
| `$type`                          | **string**  |             |
| `$name`                          | **string**  |             |
| `$hosts`                         | **?array**  |             |
| `$enforcedMounts`                | **?object** |             |
| `$siteUrls`                      | **?object** |             |
| `$sshHosts`                      | **?array**  |             |
| `$enterpriseEnvironmentsMapping` | **?object** |             |
| `$useDedicatedGrid`              | **?bool**   |             |

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

### getEnforcedMounts

Mounts which are always injected into pushed (e.g. enforce /var/log to be a local mount).

```php
public getEnforcedMounts(): ?object
```

***

### getSiteUrls

```php
public getSiteUrls(): ?object
```

***

### getSshHosts

```php
public getSshHosts(): ?array
```

***

### getEnterpriseEnvironmentsMapping

Mapping of clusters to Enterprise applications

```php
public getEnterpriseEnvironmentsMapping(): ?object
```

***

### getHosts

The hosts of the deployment target.

```php
public getHosts(): \Upsun\Model\DeploymentHostsInner[]|null
```

***

### getUseDedicatedGrid

When true, the deployment will be pinned to Grid hosts dedicated to the environment using this deployment target.

```php
public getUseDedicatedGrid(): ?bool
```

Dedicated Grid hosts must be created prior to deploying the environment. The constraints that will be set are as
follows: * `cluster_type` is set to `environment-custom`. * `cluster` is set to the environment's cluster name.

***
