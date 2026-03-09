# DedicatedDeploymentTargetPatch

Low level DedicatedDeploymentTargetPatch (auto-generated)

***

* Full name: `\Upsun\Model\DedicatedDeploymentTargetPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\DeploymentTargetPatch`](./DeploymentTargetPatch.md)

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

### enforcedMounts

```php
private ?object $enforcedMounts
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, ?object $enforcedMounts = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$type`           | **string**  |             |
| `$name`           | **string**  |             |
| `$enforcedMounts` | **?object** |             |

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
