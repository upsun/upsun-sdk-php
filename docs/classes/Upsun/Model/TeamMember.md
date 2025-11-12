# TeamMember

Low level TeamMember (auto-generated)

***

* Full name: `\Upsun\Model\TeamMember`
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

### userId

```php
private ?string $userId
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
public __construct(?string $teamId = null, ?string $userId = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter    | Type           | Description |
|--------------|----------------|-------------|
| `$teamId`    | **?string**    |             |
| `$userId`    | **?string**    |             |
| `$createdAt` | **?\DateTime** |             |
| `$updatedAt` | **?\DateTime** |             |

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

### getUserId

The ID of the user.

```php
public getUserId(): ?string
```

***

### getCreatedAt

The date and time when the team member was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the team member was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***
