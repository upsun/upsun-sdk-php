# ProjectAddonBase

Low level ProjectAddonBase (auto-generated)

***

* Full name: `\Upsun\Model\ProjectAddonBase`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant           | Visibility | Type | Value       |
|--------------------|------------|------|-------------|
| `STATUS_REQUESTED` | public     |      | 'requested' |
| `STATUS_ACTIVE`    | public     |      | 'active'    |
| `STATUS_FAILED`    | public     |      | 'failed'    |

## Properties

### id

```php
private string $id
```

***

### type

```php
private string $type
```

***

### unit

```php
private ?string $unit
```

***

### allowedValues

```php
private ?array $allowedValues
```

***

### activities

```php
private ?array $activities
```

***

### projectId

```php
private ?string $projectId
```

***

### status

```php
private ?string $status
```

***

### title

```php
private ?string $title
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
private ?\Upsun\Model\ProjectAddonBaseLinks $links
```

***

## Methods

### __construct

```php
public __construct(string $id, string $type, ?string $unit = null, ?array $allowedValues = [], ?array $activities = [], ?string $projectId = null, ?string $status = null, ?string $title = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\ProjectAddonBaseLinks $links = null): mixed
```

**Parameters:**

| Parameter        | Type                                    | Description |
|------------------|-----------------------------------------|-------------|
| `$id`            | **string**                              |             |
| `$type`          | **string**                              |             |
| `$unit`          | **?string**                             |             |
| `$allowedValues` | **?array**                              |             |
| `$activities`    | **?array**                              |             |
| `$projectId`     | **?string**                             |             |
| `$status`        | **?string**                             |             |
| `$title`         | **?string**                             |             |
| `$createdAt`     | **?\DateTime**                          |             |
| `$updatedAt`     | **?\DateTime**                          |             |
| `$links`         | **?\Upsun\Model\ProjectAddonBaseLinks** |             |

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

The ID of the add-on.

```php
public getId(): string
```

***

### getType

The type of the add-on.

```php
public getType(): string
```

***

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getStatus

Lifecycle status of the add-on.

```php
public getStatus(): ?string
```

***

### getTitle

Human-friendly title of the add-on or SKU.

```php
public getTitle(): ?string
```

***

### getUnit

Unit for quantity-based add-ons when applicable.

```php
public getUnit(): ?string
```

***

### getAllowedValues

Allowed values for the add-on depending on user role and options.

```php
public getAllowedValues(): \Upsun\Model\ProjectAddonBaseAllowedValuesInner[]|null
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

### getActivities

Activities related to the add-on.

```php
public getActivities(): \Upsun\Model\Activity[]|null
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ProjectAddonBaseLinks
```

***
