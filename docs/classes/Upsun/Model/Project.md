# Project

Low level Project (auto-generated)

***

* Full name: `\Upsun\Model\Project`
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

### attributes

```php
private array $attributes
```

***

### title

```php
private string $title
```

***

### description

```php
private string $description
```

***

### owner

```php
private string $owner
```

***

### status

```php
private \Upsun\Model\Status $status
```

***

### timezone

```php
private string $timezone
```

***

### region

```php
private string $region
```

***

### repository

```php
private \Upsun\Model\RepositoryInformation $repository
```

***

### subscription

```php
private \Upsun\Model\SubscriptionInformation $subscription
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

### namespace

```php
private ?string $namespace
```

***

### organization

```php
private ?string $organization
```

***

### defaultBranch

```php
private ?string $defaultBranch
```

***

### defaultDomain

```php
private ?string $defaultDomain
```

***

## Methods

### __construct

```php
public __construct(string $id, array $attributes, string $title, string $description, string $owner, \Upsun\Model\Status $status, string $timezone, string $region, \Upsun\Model\RepositoryInformation $repository, \Upsun\Model\SubscriptionInformation $subscription, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $namespace, ?string $organization, ?string $defaultBranch, ?string $defaultDomain): mixed
```

**Parameters:**

| Parameter        | Type                                     | Description |
|------------------|------------------------------------------|-------------|
| `$id`            | **string**                               |             |
| `$attributes`    | **array**                                |             |
| `$title`         | **string**                               |             |
| `$description`   | **string**                               |             |
| `$owner`         | **string**                               |             |
| `$status`        | **\Upsun\Model\Status**                  |             |
| `$timezone`      | **string**                               |             |
| `$region`        | **string**                               |             |
| `$repository`    | **\Upsun\Model\RepositoryInformation**   |             |
| `$subscription`  | **\Upsun\Model\SubscriptionInformation** |             |
| `$createdAt`     | **?\DateTime**                           |             |
| `$updatedAt`     | **?\DateTime**                           |             |
| `$namespace`     | **?string**                              |             |
| `$organization`  | **?string**                              |             |
| `$defaultBranch` | **?string**                              |             |
| `$defaultDomain` | **?string**                              |             |

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

The identifier of Project

```php
public getId(): string
```

***

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getAttributes

```php
public getAttributes(): array
```

***

### getTitle

The title of the project

```php
public getTitle(): string
```

***

### getDescription

The description of the project

```php
public getDescription(): string
```

***

### getOwner

The owner of the project

```php
public getOwner(): string
```

***

### getNamespace

The namespace the project belongs in

```php
public getNamespace(): ?string
```

***

### getOrganization

The organization the project belongs in

```php
public getOrganization(): ?string
```

***

### getDefaultBranch

The default branch of the project

```php
public getDefaultBranch(): ?string
```

***

### getStatus

The status of the project

```php
public getStatus(): \Upsun\Model\Status
```

***

### getTimezone

Timezone of the project

```php
public getTimezone(): string
```

***

### getRegion

The region of the project

```php
public getRegion(): string
```

***

### getRepository

The repository information of the project

```php
public getRepository(): \Upsun\Model\RepositoryInformation
```

***

### getDefaultDomain

The default domain of the project

```php
public getDefaultDomain(): ?string
```

***

### getSubscription

The subscription information of the project

```php
public getSubscription(): \Upsun\Model\SubscriptionInformation
```

***
