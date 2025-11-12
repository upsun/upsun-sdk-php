# Team

Low level Team (auto-generated)

***

* Full name: `\Upsun\Model\Team`
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

### label

```php
private ?string $label
```

***

### projectPermissions

```php
private ?array $projectPermissions
```

***

### counts

```php
private ?\Upsun\Model\TeamCounts $counts
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

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $organizationId = null, ?string $label = null, ?array $projectPermissions = [], ?\Upsun\Model\TeamCounts $counts = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter             | Type                         | Description |
|-----------------------|------------------------------|-------------|
| `$id`                 | **?string**                  |             |
| `$organizationId`     | **?string**                  |             |
| `$label`              | **?string**                  |             |
| `$projectPermissions` | **?array**                   |             |
| `$counts`             | **?\Upsun\Model\TeamCounts** |             |
| `$createdAt`          | **?\DateTime**               |             |
| `$updatedAt`          | **?\DateTime**               |             |

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

The ID of the team.

```php
public getId(): ?string
```

***

### getOrganizationId

The ID of the parent organization.

```php
public getOrganizationId(): ?string
```

***

### getLabel

The human-readable label of the team.

```php
public getLabel(): ?string
```

***

### getProjectPermissions

```php
public getProjectPermissions(): ?array
```

***

### getCounts

```php
public getCounts(): ?\Upsun\Model\TeamCounts
```

***

### getCreatedAt

The date and time when the team was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the team was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***
