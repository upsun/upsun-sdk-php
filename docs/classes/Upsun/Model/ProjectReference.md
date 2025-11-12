# ProjectReference

Low level ProjectReference (auto-generated)

The referenced project, or null if it no longer exists.

***

* Full name: `\Upsun\Model\ProjectReference`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### organizationId

```php
private string $organizationId
```

***

### subscriptionId

```php
private string $subscriptionId
```

***

### region

```php
private string $region
```

***

### title

```php
private string $title
```

***

### type

```php
private \Upsun\Model\ProjectType $type
```

***

### plan

```php
private string $plan
```

***

### status

```php
private \Upsun\Model\ProjectStatus $status
```

***

### createdAt

```php
private \DateTime $createdAt
```

***

### updatedAt

```php
private \DateTime $updatedAt
```

***

## Methods

### __construct

```php
public __construct(string $id, string $organizationId, string $subscriptionId, string $region, string $title, \Upsun\Model\ProjectType $type, string $plan, \Upsun\Model\ProjectStatus $status, \DateTime $createdAt, \DateTime $updatedAt): mixed
```

**Parameters:**

| Parameter         | Type                           | Description |
|-------------------|--------------------------------|-------------|
| `$id`             | **string**                     |             |
| `$organizationId` | **string**                     |             |
| `$subscriptionId` | **string**                     |             |
| `$region`         | **string**                     |             |
| `$title`          | **string**                     |             |
| `$type`           | **\Upsun\Model\ProjectType**   |             |
| `$plan`           | **string**                     |             |
| `$status`         | **\Upsun\Model\ProjectStatus** |             |
| `$createdAt`      | **\DateTime**                  |             |
| `$updatedAt`      | **\DateTime**                  |             |

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
public getId(): string
```

***

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): string
```

***

### getSubscriptionId

The ID of the subscription.

```php
public getSubscriptionId(): string
```

***

### getRegion

The machine name of the region where the project is located.

```php
public getRegion(): string
```

***

### getTitle

The title of the project.

```php
public getTitle(): string
```

***

### getType

The type of projects.

```php
public getType(): \Upsun\Model\ProjectType
```

***

### getPlan

The project plan.

```php
public getPlan(): string
```

***

### getStatus

The status of the project.

```php
public getStatus(): \Upsun\Model\ProjectStatus
```

***

### getCreatedAt

The date and time when the resource was created.

```php
public getCreatedAt(): \DateTime
```

***

### getUpdatedAt

The date and time when the resource was last updated.

```php
public getUpdatedAt(): \DateTime
```

***
