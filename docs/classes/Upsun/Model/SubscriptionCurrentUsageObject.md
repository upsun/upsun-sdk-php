# SubscriptionCurrentUsageObject

Low level SubscriptionCurrentUsageObject (auto-generated)

A subscription's usage group current usage object.

***

* Full name: `\Upsun\Model\SubscriptionCurrentUsageObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### cpuApp

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $cpuApp
```

***

### storageAppServices

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $storageAppServices
```

***

### memoryApp

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $memoryApp
```

***

### cpuServices

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $cpuServices
```

***

### memoryServices

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $memoryServices
```

***

### backupStorage

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $backupStorage
```

***

### buildCpu

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $buildCpu
```

***

### buildMemory

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $buildMemory
```

***

### egressBandwidth

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $egressBandwidth
```

***

### ingressRequests

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $ingressRequests
```

***

### logsFwdContentSize

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $logsFwdContentSize
```

***

### fastlyBandwidth

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $fastlyBandwidth
```

***

### fastlyRequests

```php
private ?\Upsun\Model\UsageGroupCurrentUsageProperties $fastlyRequests
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\UsageGroupCurrentUsageProperties $cpuApp = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $storageAppServices = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $memoryApp = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $cpuServices = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $memoryServices = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $backupStorage = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $buildCpu = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $buildMemory = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $egressBandwidth = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $ingressRequests = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $logsFwdContentSize = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $fastlyBandwidth = null, ?\Upsun\Model\UsageGroupCurrentUsageProperties $fastlyRequests = null): mixed
```

**Parameters:**

| Parameter             | Type                                               | Description |
|-----------------------|----------------------------------------------------|-------------|
| `$cpuApp`             | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$storageAppServices` | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$memoryApp`          | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$cpuServices`        | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$memoryServices`     | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$backupStorage`      | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$buildCpu`           | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$buildMemory`        | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$egressBandwidth`    | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$ingressRequests`    | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$logsFwdContentSize` | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$fastlyBandwidth`    | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |
| `$fastlyRequests`     | **?\Upsun\Model\UsageGroupCurrentUsageProperties** |             |

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

### getCpuApp

Current usage info for a usage group.

```php
public getCpuApp(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getStorageAppServices

Current usage info for a usage group.

```php
public getStorageAppServices(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getMemoryApp

Current usage info for a usage group.

```php
public getMemoryApp(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getCpuServices

Current usage info for a usage group.

```php
public getCpuServices(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getMemoryServices

Current usage info for a usage group.

```php
public getMemoryServices(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getBackupStorage

Current usage info for a usage group.

```php
public getBackupStorage(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getBuildCpu

Current usage info for a usage group.

```php
public getBuildCpu(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getBuildMemory

Current usage info for a usage group.

```php
public getBuildMemory(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getEgressBandwidth

Current usage info for a usage group.

```php
public getEgressBandwidth(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getIngressRequests

Current usage info for a usage group.

```php
public getIngressRequests(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getLogsFwdContentSize

Current usage info for a usage group.

```php
public getLogsFwdContentSize(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getFastlyBandwidth

Current usage info for a usage group.

```php
public getFastlyBandwidth(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***

### getFastlyRequests

Current usage info for a usage group.

```php
public getFastlyRequests(): ?\Upsun\Model\UsageGroupCurrentUsageProperties
```

***
