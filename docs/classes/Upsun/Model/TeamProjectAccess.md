# TeamProjectAccess

Low level TeamProjectAccess (auto-generated)

***

* Full name: `\Upsun\Model\TeamProjectAccess`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### teamId

```php
private ?string $teamId
```

***

### organizationId

```php
private ?string $organizationId
```

***

### projectId

```php
private ?string $projectId
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### grantedAt

```php
private ?\DateTime $grantedAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### links

```php
private ?\Upsun\Model\TeamProjectAccessLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $teamId = null, ?string $organizationId = null, ?string $projectId = null, ?string $projectTitle = null, ?\DateTime $grantedAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\TeamProjectAccessLinks $links = null): mixed
```

**Parameters:**

| Parameter         | Type                                     | Description |
|-------------------|------------------------------------------|-------------|
| `$teamId`         | **?string**                              |             |
| `$organizationId` | **?string**                              |             |
| `$projectId`      | **?string**                              |             |
| `$projectTitle`   | **?string**                              |             |
| `$grantedAt`      | **?\DateTime**                           |             |
| `$updatedAt`      | **?\DateTime**                           |             |
| `$links`          | **?\Upsun\Model\TeamProjectAccessLinks** |             |

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

### getTeamId

The ID of the team.

```php
public getTeamId(): ?string
```

***

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
```

***

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getProjectTitle

The title of the project.

```php
public getProjectTitle(): ?string
```

***

### getGrantedAt

The date and time when the access was granted.

```php
public getGrantedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the access was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\TeamProjectAccessLinks
```

***
