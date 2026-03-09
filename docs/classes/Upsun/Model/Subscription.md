# Subscription

Low level Subscription (auto-generated)
The subscription object.

***

* Full name: `\Upsun\Model\Subscription`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                      | Visibility | Type | Value                  |
|-------------------------------|------------|------|------------------------|
| `STATUS_REQUESTED`            | public     |      | 'requested'            |
| `STATUS_PROVISIONING_FAILURE` | public     |      | 'provisioning failure' |
| `STATUS_PROVISIONING`         | public     |      | 'provisioning'         |
| `STATUS_ACTIVE`               | public     |      | 'active'               |
| `STATUS_SUSPENDED`            | public     |      | 'suspended'            |
| `STATUS_DELETED`              | public     |      | 'deleted'              |

## Properties

### id

```php
private ?string $id
```

***

### status

```php
private ?string $status
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
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

### vendor

```php
private ?string $vendor
```

***

### plan

```php
private ?string $plan
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

### userLicenses

```php
private ?int $userLicenses
```

***

### projectId

```php
private ?string $projectId
```

***

### projectEndpoint

```php
private ?string $projectEndpoint
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### projectRegion

```php
private ?string $projectRegion
```

***

### projectRegionLabel

```php
private ?string $projectRegionLabel
```

***

### projectUi

```php
private ?string $projectUi
```

***

### projectOptions

```php
private ?\Upsun\Model\ProjectOptions $projectOptions
```

***

### agencySite

```php
private ?bool $agencySite
```

***

### invoiced

```php
private ?bool $invoiced
```

***

### hipaa

```php
private ?bool $hipaa
```

***

### isTrialPlan

```php
private ?bool $isTrialPlan
```

***

### services

```php
private ?array $services
```

***

### green

```php
private ?bool $green
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $status = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?string $owner = null, ?\Upsun\Model\OwnerInfo $ownerInfo = null, ?string $vendor = null, ?string $plan = null, ?int $environments = null, ?int $storage = null, ?int $userLicenses = null, ?string $projectId = null, ?string $projectEndpoint = null, ?string $projectTitle = null, ?string $projectRegion = null, ?string $projectRegionLabel = null, ?string $projectUi = null, ?\Upsun\Model\ProjectOptions $projectOptions = null, ?bool $agencySite = null, ?bool $invoiced = null, ?bool $hipaa = null, ?bool $isTrialPlan = null, ?array $services = [], ?bool $green = null): mixed
```

**Parameters:**

| Parameter             | Type                             | Description |
|-----------------------|----------------------------------|-------------|
| `$id`                 | **?string**                      |             |
| `$status`             | **?string**                      |             |
| `$createdAt`          | **?\DateTime**                   |             |
| `$updatedAt`          | **?\DateTime**                   |             |
| `$owner`              | **?string**                      |             |
| `$ownerInfo`          | **?\Upsun\Model\OwnerInfo**      |             |
| `$vendor`             | **?string**                      |             |
| `$plan`               | **?string**                      |             |
| `$environments`       | **?int**                         |             |
| `$storage`            | **?int**                         |             |
| `$userLicenses`       | **?int**                         |             |
| `$projectId`          | **?string**                      |             |
| `$projectEndpoint`    | **?string**                      |             |
| `$projectTitle`       | **?string**                      |             |
| `$projectRegion`      | **?string**                      |             |
| `$projectRegionLabel` | **?string**                      |             |
| `$projectUi`          | **?string**                      |             |
| `$projectOptions`     | **?\Upsun\Model\ProjectOptions** |             |
| `$agencySite`         | **?bool**                        |             |
| `$invoiced`           | **?bool**                        |             |
| `$hipaa`              | **?bool**                        |             |
| `$isTrialPlan`        | **?bool**                        |             |
| `$services`           | **?array**                       |             |
| `$green`              | **?bool**                        |             |

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

The internal ID of the subscription.

```php
public getId(): ?string
```

***

### getStatus

The status of the subscription.

```php
public getStatus(): ?string
```

***

### getCreatedAt

The date and time when the subscription was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the subscription was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getOwner

The UUID of the owner.

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

### getVendor

The machine name of the vendor the subscription belongs to.

```php
public getVendor(): ?string
```

***

### getPlan

The plan type of the subscription.

```php
public getPlan(): ?string
```

***

### getEnvironments

The number of environments which can be provisioned on the project.

```php
public getEnvironments(): ?int
```

***

### getStorage

The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values.

```php
public getStorage(): ?int
```

***

### getUserLicenses

The number of chargeable users who currently have access to the project. Manage this value by adding and removing
users through the Platform project API. Staff and billing/administrative contacts can be added to a project for
no charge. Contact support for questions about user licenses.

```php
public getUserLicenses(): ?int
```

***

### getProjectId

The unique ID string of the project.

```php
public getProjectId(): ?string
```

***

### getProjectEndpoint

The project API endpoint for the project.

```php
public getProjectEndpoint(): ?string
```

***

### getProjectTitle

The name given to the project. Appears as the title in the UI.

```php
public getProjectTitle(): ?string
```

***

### getProjectRegion

The machine name of the region where the project is located. Cannot be changed after project creation.

```php
public getProjectRegion(): ?string
```

***

### getProjectRegionLabel

The human-readable name of the region where the project is located.

```php
public getProjectRegionLabel(): ?string
```

***

### getProjectUi

The URL for the project's user interface.

```php
public getProjectUi(): ?string
```

***

### getProjectOptions

The project options object.

```php
public getProjectOptions(): ?\Upsun\Model\ProjectOptions
```

***

### getAgencySite

True if the project is an agency site.

```php
public getAgencySite(): ?bool
```

***

### getInvoiced

Whether the subscription is invoiced.

```php
public getInvoiced(): ?bool
```

***

### getHipaa

Whether the project is marked as HIPAA.

```php
public getHipaa(): ?bool
```

***

### getIsTrialPlan

Whether the project is currently on a trial plan.

```php
public getIsTrialPlan(): ?bool
```

***

### getServices

```php
public getServices(): ?array
```

***

### getGreen

Whether the subscription is considered green (on a green region, belonging to a green vendor) for billing
purposes.

```php
public getGreen(): ?bool
```

***
