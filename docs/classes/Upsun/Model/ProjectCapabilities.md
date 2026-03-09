# ProjectCapabilities

Low level ProjectCapabilities (auto-generated)

***

* Full name: `\Upsun\Model\ProjectCapabilities`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### metrics

```php
private \Upsun\Model\Metrics $metrics
```

***

### logsForwarding

```php
private \Upsun\Model\LogsForwarding $logsForwarding
```

***

### guaranteedResources

```php
private \Upsun\Model\GuaranteedResources $guaranteedResources
```

***

### images

```php
private array $images
```

***

### instanceLimit

```php
private int $instanceLimit
```

***

### buildResources

```php
private \Upsun\Model\BuildResources $buildResources
```

***

### dataRetention

```php
private \Upsun\Model\DataRetention $dataRetention
```

***

### autoscaling

```php
private \Upsun\Model\Autoscaling $autoscaling
```

***

### customDomains

```php
private ?\Upsun\Model\CustomDomains $customDomains
```

***

### sourceOperations

```php
private ?\Upsun\Model\SourceOperations $sourceOperations
```

***

### runtimeOperations

```php
private ?\Upsun\Model\RuntimeOperations $runtimeOperations
```

***

### outboundFirewall

```php
private ?\Upsun\Model\OutboundFirewall $outboundFirewall
```

***

### integrations

```php
private ?\Upsun\Model\Integrations $integrations
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Model\Metrics $metrics, \Upsun\Model\LogsForwarding $logsForwarding, \Upsun\Model\GuaranteedResources $guaranteedResources, array $images, int $instanceLimit, \Upsun\Model\BuildResources $buildResources, \Upsun\Model\DataRetention $dataRetention, \Upsun\Model\Autoscaling $autoscaling, ?\Upsun\Model\CustomDomains $customDomains = null, ?\Upsun\Model\SourceOperations $sourceOperations = null, ?\Upsun\Model\RuntimeOperations $runtimeOperations = null, ?\Upsun\Model\OutboundFirewall $outboundFirewall = null, ?\Upsun\Model\Integrations $integrations = null): mixed
```

**Parameters:**

| Parameter              | Type                                 | Description |
|------------------------|--------------------------------------|-------------|
| `$metrics`             | **\Upsun\Model\Metrics**             |             |
| `$logsForwarding`      | **\Upsun\Model\LogsForwarding**      |             |
| `$guaranteedResources` | **\Upsun\Model\GuaranteedResources** |             |
| `$images`              | **array**                            |             |
| `$instanceLimit`       | **int**                              |             |
| `$buildResources`      | **\Upsun\Model\BuildResources**      |             |
| `$dataRetention`       | **\Upsun\Model\DataRetention**       |             |
| `$autoscaling`         | **\Upsun\Model\Autoscaling**         |             |
| `$customDomains`       | **?\Upsun\Model\CustomDomains**      |             |
| `$sourceOperations`    | **?\Upsun\Model\SourceOperations**   |             |
| `$runtimeOperations`   | **?\Upsun\Model\RuntimeOperations**  |             |
| `$outboundFirewall`    | **?\Upsun\Model\OutboundFirewall**   |             |
| `$integrations`        | **?\Upsun\Model\Integrations**       |             |

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

### getMetrics

```php
public getMetrics(): \Upsun\Model\Metrics
```

***

### getLogsForwarding

```php
public getLogsForwarding(): \Upsun\Model\LogsForwarding
```

***

### getGuaranteedResources

```php
public getGuaranteedResources(): \Upsun\Model\GuaranteedResources
```

***

### getImages

```php
public getImages(): array
```

***

### getInstanceLimit

Maximum number of instance per service

```php
public getInstanceLimit(): int
```

***

### getBuildResources

```php
public getBuildResources(): \Upsun\Model\BuildResources
```

***

### getDataRetention

```php
public getDataRetention(): \Upsun\Model\DataRetention
```

***

### getAutoscaling

```php
public getAutoscaling(): \Upsun\Model\Autoscaling
```

***

### getCustomDomains

```php
public getCustomDomains(): ?\Upsun\Model\CustomDomains
```

***

### getSourceOperations

```php
public getSourceOperations(): ?\Upsun\Model\SourceOperations
```

***

### getRuntimeOperations

```php
public getRuntimeOperations(): ?\Upsun\Model\RuntimeOperations
```

***

### getOutboundFirewall

```php
public getOutboundFirewall(): ?\Upsun\Model\OutboundFirewall
```

***

### getIntegrations

```php
public getIntegrations(): ?\Upsun\Model\Integrations
```

***
