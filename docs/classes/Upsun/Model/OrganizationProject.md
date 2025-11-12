# OrganizationProject

Low level OrganizationProject (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationProject`
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

### organizationId

```php
private ?string $organizationId
```

***

### subscriptionId

```php
private ?string $subscriptionId
```

***

### vendor

```php
private ?string $vendor
```

***

### region

```php
private ?string $region
```

***

### title

```php
private ?string $title
```

***

### type

```php
private ?\Upsun\Model\ProjectType $type
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

### defaultBranch

```php
private ?string $defaultBranch
```

***

### status

```php
private ?\Upsun\Model\ProjectStatus $status
```

***

### trialPlan

```php
private ?bool $trialPlan
```

***

### projectUi

```php
private ?string $projectUi
```

***

### locked

```php
private ?bool $locked
```

***

### cseNotes

```php
private ?string $cseNotes
```

***

### dedicatedTag

```php
private ?string $dedicatedTag
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

### links

```php
private ?\Upsun\Model\OrganizationProjectLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $organizationId = null, ?string $subscriptionId = null, ?string $vendor = null, ?string $region = null, ?string $title = null, ?\Upsun\Model\ProjectType $type = null, ?string $plan = null, ?string $timezone = null, ?string $defaultBranch = null, ?\Upsun\Model\ProjectStatus $status = null, ?bool $trialPlan = null, ?string $projectUi = null, ?bool $locked = null, ?string $cseNotes = null, ?string $dedicatedTag = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\OrganizationProjectLinks $links = null): mixed
```

**Parameters:**

| Parameter         | Type                                       | Description |
|-------------------|--------------------------------------------|-------------|
| `$id`             | **?string**                                |             |
| `$organizationId` | **?string**                                |             |
| `$subscriptionId` | **?string**                                |             |
| `$vendor`         | **?string**                                |             |
| `$region`         | **?string**                                |             |
| `$title`          | **?string**                                |             |
| `$type`           | **?\Upsun\Model\ProjectType**              |             |
| `$plan`           | **?string**                                |             |
| `$timezone`       | **?string**                                |             |
| `$defaultBranch`  | **?string**                                |             |
| `$status`         | **?\Upsun\Model\ProjectStatus**            |             |
| `$trialPlan`      | **?bool**                                  |             |
| `$projectUi`      | **?string**                                |             |
| `$locked`         | **?bool**                                  |             |
| `$cseNotes`       | **?string**                                |             |
| `$dedicatedTag`   | **?string**                                |             |
| `$createdAt`      | **?\DateTime**                             |             |
| `$updatedAt`      | **?\DateTime**                             |             |
| `$links`          | **?\Upsun\Model\OrganizationProjectLinks** |             |

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

The ID of the project.

```php
public getId(): ?string
```

***

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
```

***

### getSubscriptionId

The ID of the subscription.

```php
public getSubscriptionId(): ?string
```

***

### getVendor

Vendor of the project.

```php
public getVendor(): ?string
```

***

### getRegion

The machine name of the region where the project is located.

```php
public getRegion(): ?string
```

***

### getTitle

The title of the project.

```php
public getTitle(): ?string
```

***

### getType

The type of projects.

```php
public getType(): ?\Upsun\Model\ProjectType
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

### getDefaultBranch

Default branch.

```php
public getDefaultBranch(): ?string
```

***

### getStatus

The status of the project.

```php
public getStatus(): ?\Upsun\Model\ProjectStatus
```

***

### getTrialPlan

Whether the project is currently on a trial plan.

```php
public getTrialPlan(): ?bool
```

***

### getProjectUi

The URL for the project's user interface.

```php
public getProjectUi(): ?string
```

***

### getLocked

Locked

```php
public getLocked(): ?bool
```

***

### getCseNotes

CSE notes.

```php
public getCseNotes(): ?string
```

***

### getDedicatedTag

Dedicated tag.

```php
public getDedicatedTag(): ?string
```

***

### getCreatedAt

The date and time when the resource was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the resource was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\OrganizationProjectLinks
```

***
