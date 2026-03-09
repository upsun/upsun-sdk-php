# CurrentUserProjectsInner

Low level CurrentUserProjectsInner (auto-generated)

***

* Full name: `\Upsun\Model\CurrentUserProjectsInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### name

```php
private ?string $name
```

***

### title

```php
private ?string $title
```

***

### cluster

```php
private ?string $cluster
```

***

### clusterLabel

```php
private ?string $clusterLabel
```

***

### region

```php
private ?string $region
```

***

### regionLabel

```php
private ?string $regionLabel
```

***

### uri

```php
private ?string $uri
```

***

### endpoint

```php
private ?string $endpoint
```

***

### licenseId

```php
private ?int $licenseId
```

***

### owner

```php
private ?string $owner
```

***

### ownerInfo

```php
private ?\Upsun\Model\OwnerInfo $ownerInfo
```

***

### plan

```php
private ?string $plan
```

***

### subscriptionId

```php
private ?int $subscriptionId
```

***

### status

```php
private ?string $status
```

***

### vendor

```php
private ?string $vendor
```

***

### vendorLabel

```php
private ?string $vendorLabel
```

***

### vendorWebsite

```php
private ?string $vendorWebsite
```

***

### vendorResources

```php
private ?string $vendorResources
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $name = null, ?string $title = null, ?string $cluster = null, ?string $clusterLabel = null, ?string $region = null, ?string $regionLabel = null, ?string $uri = null, ?string $endpoint = null, ?int $licenseId = null, ?string $owner = null, ?\Upsun\Model\OwnerInfo $ownerInfo = null, ?string $plan = null, ?int $subscriptionId = null, ?string $status = null, ?string $vendor = null, ?string $vendorLabel = null, ?string $vendorWebsite = null, ?string $vendorResources = null, ?\DateTime $createdAt = null): mixed
```

**Parameters:**

| Parameter          | Type                        | Description |
|--------------------|-----------------------------|-------------|
| `$id`              | **?string**                 |             |
| `$name`            | **?string**                 |             |
| `$title`           | **?string**                 |             |
| `$cluster`         | **?string**                 |             |
| `$clusterLabel`    | **?string**                 |             |
| `$region`          | **?string**                 |             |
| `$regionLabel`     | **?string**                 |             |
| `$uri`             | **?string**                 |             |
| `$endpoint`        | **?string**                 |             |
| `$licenseId`       | **?int**                    |             |
| `$owner`           | **?string**                 |             |
| `$ownerInfo`       | **?\Upsun\Model\OwnerInfo** |             |
| `$plan`            | **?string**                 |             |
| `$subscriptionId`  | **?int**                    |             |
| `$status`          | **?string**                 |             |
| `$vendor`          | **?string**                 |             |
| `$vendorLabel`     | **?string**                 |             |
| `$vendorWebsite`   | **?string**                 |             |
| `$vendorResources` | **?string**                 |             |
| `$createdAt`       | **?\DateTime**              |             |

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

### getId

```php
public getId(): ?string
```

***

### getName

```php
public getName(): ?string
```

***

### getTitle

```php
public getTitle(): ?string
```

***

### getCluster

```php
public getCluster(): ?string
```

***

### getClusterLabel

```php
public getClusterLabel(): ?string
```

***

### getRegion

```php
public getRegion(): ?string
```

***

### getRegionLabel

```php
public getRegionLabel(): ?string
```

***

### getUri

```php
public getUri(): ?string
```

***

### getEndpoint

```php
public getEndpoint(): ?string
```

***

### getLicenseId

```php
public getLicenseId(): ?int
```

***

### getOwner

```php
public getOwner(): ?string
```

***

### getOwnerInfo

Project owner information that can be exposed to collaborators.

```php
public getOwnerInfo(): ?\Upsun\Model\OwnerInfo
```

***

### getPlan

```php
public getPlan(): ?string
```

***

### getSubscriptionId

```php
public getSubscriptionId(): ?int
```

***

### getStatus

```php
public getStatus(): ?string
```

***

### getVendor

```php
public getVendor(): ?string
```

***

### getVendorLabel

```php
public getVendorLabel(): ?string
```

***

### getVendorWebsite

```php
public getVendorWebsite(): ?string
```

***

### getVendorResources

```php
public getVendorResources(): ?string
```

***

### getCreatedAt

```php
public getCreatedAt(): ?\DateTime
```

***
