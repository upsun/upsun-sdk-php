# OrganizationInvitationOwner

Low level OrganizationInvitationOwner (auto-generated)

The inviter.

***

* Full name: `\Upsun\Model\OrganizationInvitationOwner`
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

### displayName

```php
private ?string $displayName
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $displayName = null): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$id`          | **?string** |             |
| `$displayName` | **?string** |             |

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

### getDisplayName

The user's display name.

```php
public getDisplayName(): ?string
```

***
