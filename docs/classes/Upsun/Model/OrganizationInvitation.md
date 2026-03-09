# OrganizationInvitation

Low level OrganizationInvitation (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationInvitation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                     | Visibility | Type | Value            |
|------------------------------|------------|------|------------------|
| `STATE_PENDING`              | public     |      | 'pending'        |
| `STATE_PROCESSING`           | public     |      | 'processing'     |
| `STATE_ACCEPTED`             | public     |      | 'accepted'       |
| `STATE_CANCELLED`            | public     |      | 'cancelled'      |
| `STATE_ERROR`                | public     |      | 'error'          |
| `PERMISSIONS_ADMIN`          | public     |      | 'admin'          |
| `PERMISSIONS_BILLING`        | public     |      | 'billing'        |
| `PERMISSIONS_PLANS`          | public     |      | 'plans'          |
| `PERMISSIONS_MEMBERS`        | public     |      | 'members'        |
| `PERMISSIONS_PROJECT_CREATE` | public     |      | 'project:create' |
| `PERMISSIONS_PROJECTS_LIST`  | public     |      | 'projects:list'  |

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

### organizationId

```php
private ?string $organizationId
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

### permissions

```php
private ?array $permissions
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $finishedAt = null, ?string $id = null, ?string $state = null, ?string $organizationId = null, ?string $email = null, ?\Upsun\Model\OrganizationInvitationOwner $owner = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?array $permissions = []): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$finishedAt`     | **?\DateTime**                                |             |
| `$id`             | **?string**                                   |             |
| `$state`          | **?string**                                   |             |
| `$organizationId` | **?string**                                   |             |
| `$email`          | **?string**                                   |             |
| `$owner`          | **?\Upsun\Model\OrganizationInvitationOwner** |             |
| `$createdAt`      | **?\DateTime**                                |             |
| `$updatedAt`      | **?\DateTime**                                |             |
| `$permissions`    | **?array**                                    |             |

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

### getOrganizationId

The ID of the organization.

```php
public getOrganizationId(): ?string
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

### getPermissions

```php
public getPermissions(): ?array
```

***
