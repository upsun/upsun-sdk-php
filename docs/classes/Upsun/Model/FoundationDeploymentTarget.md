# FoundationDeploymentTarget

Low level FoundationDeploymentTarget (auto-generated)

***

* Full name: `\Upsun\Model\FoundationDeploymentTarget`
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

### useDedicatedGrid

```php
private bool $useDedicatedGrid
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

## Methods

### __construct

```php
public __construct(string $type, string $name, bool $useDedicatedGrid, ?array $hosts, ?string $storageType, ?string $id = null): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$type`             | **string**  |             |
| `$name`             | **string**  |             |
| `$useDedicatedGrid` | **bool**    |             |
| `$hosts`            | **?array**  |             |
| `$storageType`      | **?string** |             |
| `$id`               | **?string** |             |

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

### getHosts

The hosts of the deployment target.

```php
public getHosts(): \Upsun\Model\HostsInner[]|null
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
