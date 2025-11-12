# ProjectInvitation

Low level ProjectInvitation (auto-generated)

***

* Full name: `\Upsun\Model\ProjectInvitation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### finishedAt

```php
private ?\DateTime $finishedAt
```

***

### id

```php
private ?string $id
```

***

### state

```php
private ?string $state
```

***

### projectId

```php
private ?string $projectId
```

***

### role

```php
private ?string $role
```

***

### email

```php
private ?string $email
```

***

### owner

```php
private ?\Upsun\Model\OrganizationInvitationOwner $owner
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

### environments

```php
private ?array $environments
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $finishedAt = null, ?string $id = null, ?string $state = null, ?string $projectId = null, ?string $role = null, ?string $email = null, ?\Upsun\Model\OrganizationInvitationOwner $owner = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?array $environments = []): mixed
```

**Parameters:**

| Parameter       | Type                                          | Description |
|-----------------|-----------------------------------------------|-------------|
| `$finishedAt`   | **?\DateTime**                                |             |
| `$id`           | **?string**                                   |             |
| `$state`        | **?string**                                   |             |
| `$projectId`    | **?string**                                   |             |
| `$role`         | **?string**                                   |             |
| `$email`        | **?string**                                   |             |
| `$owner`        | **?\Upsun\Model\OrganizationInvitationOwner** |             |
| `$createdAt`    | **?\DateTime**                                |             |
| `$updatedAt`    | **?\DateTime**                                |             |
| `$environments` | **?array**                                    |             |

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

The ID of the invitation.

```php
public getId(): ?string
```

***

### getState

The invitation state.

```php
public getState(): ?string
```

***

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getRole

The project role.

```php
public getRole(): ?string
```

***

### getEmail

The email address of the invitee.

```php
public getEmail(): ?string
```

***

### getOwner

The inviter.

```php
public getOwner(): ?\Upsun\Model\OrganizationInvitationOwner
```

***

### getCreatedAt

The date and time when the invitation was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the invitation was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getFinishedAt

The date and time when the invitation was finished.

```php
public getFinishedAt(): ?\DateTime
```

***

### getEnvironments

```php
public getEnvironments(): \Upsun\Model\ProjectInvitationEnvironmentsInner[]|null
```

***
