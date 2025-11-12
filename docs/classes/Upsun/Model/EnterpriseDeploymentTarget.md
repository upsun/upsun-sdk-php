# EnterpriseDeploymentTarget

Low level EnterpriseDeploymentTarget (auto-generated)

***

* Full name: `\Upsun\Model\EnterpriseDeploymentTarget`
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

### maintenanceMode

```php
private bool $maintenanceMode
```

***

### deployHost

```php
private ?string $deployHost
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
public __construct(string $type, string $name, array $docroots, object $siteUrls, array $sshHosts, bool $maintenanceMode, ?string $deployHost, ?string $id = null, ?object $enterpriseEnvironmentsMapping = null): mixed
```

**Parameters:**

| Parameter                        | Type        | Description |
|----------------------------------|-------------|-------------|
| `$type`                          | **string**  |             |
| `$name`                          | **string**  |             |
| `$docroots`                      | **array**   |             |
| `$siteUrls`                      | **object**  |             |
| `$sshHosts`                      | **array**   |             |
| `$maintenanceMode`               | **bool**    |             |
| `$deployHost`                    | **?string** |             |
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

### getMaintenanceMode

Whether to perform deployments or not

```php
public getMaintenanceMode(): bool
```

***

### getId

The identifier of EnterpriseDeploymentTarget

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
