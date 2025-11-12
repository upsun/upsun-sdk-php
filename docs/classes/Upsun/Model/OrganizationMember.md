# OrganizationMember

Low level OrganizationMember (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationMember`
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

### userId

```php
private ?string $userId
```

***

### permissions

```php
private ?array $permissions
```

***

### level

```php
private ?string $level
```

***

### owner

```php
private ?bool $owner
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
private ?\Upsun\Model\OrganizationMemberLinks $links
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $organizationId = null, ?string $userId = null, ?array $permissions = [], ?string $level = null, ?bool $owner = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\OrganizationMemberLinks $links = null): mixed
```

**Parameters:**

| Parameter         | Type                                      | Description |
|-------------------|-------------------------------------------|-------------|
| `$id`             | **?string**                               |             |
| `$organizationId` | **?string**                               |             |
| `$userId`         | **?string**                               |             |
| `$permissions`    | **?array**                                |             |
| `$level`          | **?string**                               |             |
| `$owner`          | **?bool**                                 |             |
| `$createdAt`      | **?\DateTime**                            |             |
| `$updatedAt`      | **?\DateTime**                            |             |
| `$links`          | **?\Upsun\Model\OrganizationMemberLinks** |             |

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

The ID of the user.

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

### getUserId

The ID of the user.

```php
public getUserId(): ?string
```

***

### getPermissions

```php
public getPermissions(): ?array
```

***

### getLevel

Access level of the member.

```php
public getLevel(): ?string
```

***

### getOwner

Whether the member is the organization owner.

```php
public getOwner(): ?bool
```

***

### getCreatedAt

The date and time when the member was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the member was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\OrganizationMemberLinks
```

***
