# UpdateOrgSubscriptionRequest

Low level UpdateOrgSubscriptionRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateOrgSubscriptionRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### projectTitle

```php
private ?string $projectTitle
```

***

### plan

```php
private ?string $plan
```

***

### timezone

```php
private ?string $timezone
```

***

### environments

```php
private ?int $environments
```

***

### storage

```php
private ?int $storage
```

***

### bigDev

```php
private ?string $bigDev
```

***

### bigDevService

```php
private ?string $bigDevService
```

***

### backups

```php
private ?string $backups
```

***

### observabilitySuite

```php
private ?string $observabilitySuite
```

***

### blackfire

```php
private ?string $blackfire
```

***

### continuousProfiling

```php
private ?string $continuousProfiling
```

***

### projectSupportLevel

```php
private ?string $projectSupportLevel
```

***

## Methods

### __construct

```php
public __construct(?string $projectTitle = null, ?string $plan = null, ?string $timezone = null, ?int $environments = null, ?int $storage = null, ?string $bigDev = null, ?string $bigDevService = null, ?string $backups = null, ?string $observabilitySuite = null, ?string $blackfire = null, ?string $continuousProfiling = null, ?string $projectSupportLevel = null): mixed
```

**Parameters:**

| Parameter              | Type        | Description |
|------------------------|-------------|-------------|
| `$projectTitle`        | **?string** |             |
| `$plan`                | **?string** |             |
| `$timezone`            | **?string** |             |
| `$environments`        | **?int**    |             |
| `$storage`             | **?int**    |             |
| `$bigDev`              | **?string** |             |
| `$bigDevService`       | **?string** |             |
| `$backups`             | **?string** |             |
| `$observabilitySuite`  | **?string** |             |
| `$blackfire`           | **?string** |             |
| `$continuousProfiling` | **?string** |             |
| `$projectSupportLevel` | **?string** |             |

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

### getProjectTitle

The title of the project.

```php
public getProjectTitle(): ?string
```

***

### getPlan

The project plan.

```php
public getPlan(): ?string
```

***

### getTimezone

Timezone of the project.

```php
public getTimezone(): ?string
```

***

### getEnvironments

```php
public getEnvironments(): ?int
```

***

### getStorage

```php
public getStorage(): ?int
```

***

### getBigDev

```php
public getBigDev(): ?string
```

***

### getBigDevService

```php
public getBigDevService(): ?string
```

***

### getBackups

```php
public getBackups(): ?string
```

***

### getObservabilitySuite

```php
public getObservabilitySuite(): ?string
```

***

### getBlackfire

```php
public getBlackfire(): ?string
```

***

### getContinuousProfiling

```php
public getContinuousProfiling(): ?string
```

***

### getProjectSupportLevel

```php
public getProjectSupportLevel(): ?string
```

***
