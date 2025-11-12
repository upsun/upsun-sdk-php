# WorkersValue

Low level WorkersValue (auto-generated)

***

* Full name: `\Upsun\Model\WorkersValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### size

```php
private string $size
```

***

### access

```php
private array $access
```

***

### relationships

```php
private array $relationships
```

***

### additionalHosts

```php
private array $additionalHosts
```

***

### mounts

```php
private array $mounts
```

***

### variables

```php
private array $variables
```

***

### operations

```php
private array $operations
```

***

### name

```php
private string $name
```

***

### type

```php
private string $type
```

***

### preflight

```php
private \Upsun\Model\PreflightChecks $preflight
```

***

### treeId

```php
private string $treeId
```

***

### appDir

```php
private string $appDir
```

***

### runtime

```php
private object $runtime
```

***

### worker

```php
private \Upsun\Model\WorkerConfiguration $worker
```

***

### app

```php
private string $app
```

***

### slugId

```php
private string $slugId
```

***

### resources

```php
private ?\Upsun\Model\Resources $resources
```

***

### disk

```php
private ?int $disk
```

***

### timezone

```php
private ?string $timezone
```

***

### firewall

```php
private ?\Upsun\Model\Firewall $firewall
```

***

### containerProfile

```php
private ?string $containerProfile
```

***

### endpoints

```php
private ?object $endpoints
```

***

### stack

```php
private ?array $stack
```

***

### instanceCount

```php
private ?int $instanceCount
```

***

## Methods

### __construct

```php
public __construct(string $size, array $access, array $relationships, array $additionalHosts, array $mounts, array $variables, array $operations, string $name, string $type, \Upsun\Model\PreflightChecks $preflight, string $treeId, string $appDir, object $runtime, \Upsun\Model\WorkerConfiguration $worker, string $app, string $slugId, ?\Upsun\Model\Resources $resources, ?int $disk, ?string $timezone, ?\Upsun\Model\Firewall $firewall, ?string $containerProfile, ?object $endpoints, ?array $stack, ?int $instanceCount): mixed
```

**Parameters:**

| Parameter           | Type                                 | Description |
|---------------------|--------------------------------------|-------------|
| `$size`             | **string**                           |             |
| `$access`           | **array**                            |             |
| `$relationships`    | **array**                            |             |
| `$additionalHosts`  | **array**                            |             |
| `$mounts`           | **array**                            |             |
| `$variables`        | **array**                            |             |
| `$operations`       | **array**                            |             |
| `$name`             | **string**                           |             |
| `$type`             | **string**                           |             |
| `$preflight`        | **\Upsun\Model\PreflightChecks**     |             |
| `$treeId`           | **string**                           |             |
| `$appDir`           | **string**                           |             |
| `$runtime`          | **object**                           |             |
| `$worker`           | **\Upsun\Model\WorkerConfiguration** |             |
| `$app`              | **string**                           |             |
| `$slugId`           | **string**                           |             |
| `$resources`        | **?\Upsun\Model\Resources**          |             |
| `$disk`             | **?int**                             |             |
| `$timezone`         | **?string**                          |             |
| `$firewall`         | **?\Upsun\Model\Firewall**           |             |
| `$containerProfile` | **?string**                          |             |
| `$endpoints`        | **?object**                          |             |
| `$stack`            | **?array**                           |             |
| `$instanceCount`    | **?int**                             |             |

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

### getResources

```php
public getResources(): ?\Upsun\Model\Resources
```

***

### getSize

```php
public getSize(): string
```

***

### getDisk

```php
public getDisk(): ?int
```

***

### getAccess

```php
public getAccess(): array
```

***

### getRelationships

```php
public getRelationships(): \Upsun\Model\ServiceRelationshipsValue[]
```

***

### getAdditionalHosts

```php
public getAdditionalHosts(): array
```

***

### getMounts

```php
public getMounts(): \Upsun\Model\MountsValue[]
```

***

### getTimezone

```php
public getTimezone(): ?string
```

***

### getVariables

```php
public getVariables(): array
```

***

### getFirewall

```php
public getFirewall(): ?\Upsun\Model\Firewall
```

***

### getContainerProfile

```php
public getContainerProfile(): ?string
```

***

### getOperations

```php
public getOperations(): \Upsun\Model\OperationsValue[]
```

***

### getName

```php
public getName(): string
```

***

### getType

```php
public getType(): string
```

***

### getPreflight

```php
public getPreflight(): \Upsun\Model\PreflightChecks
```

***

### getTreeId

```php
public getTreeId(): string
```

***

### getAppDir

```php
public getAppDir(): string
```

***

### getEndpoints

```php
public getEndpoints(): ?object
```

***

### getRuntime

```php
public getRuntime(): object
```

***

### getWorker

```php
public getWorker(): \Upsun\Model\WorkerConfiguration
```

***

### getApp

```php
public getApp(): string
```

***

### getStack

```php
public getStack(): ?array
```

***

### getInstanceCount

```php
public getInstanceCount(): ?int
```

***

### getSlugId

```php
public getSlugId(): string
```

***
