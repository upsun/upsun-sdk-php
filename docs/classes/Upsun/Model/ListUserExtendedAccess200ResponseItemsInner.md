# ListUserExtendedAccess200ResponseItemsInner

Low level ListUserExtendedAccess200ResponseItemsInner (auto-generated)

***

* Full name: `\Upsun\Model\ListUserExtendedAccess200ResponseItemsInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### userId

```php
private ?string $userId
```

***

### resourceId

```php
private ?string $resourceId
```

***

### resourceType

```php
private ?string $resourceType
```

***

### organizationId

```php
private ?string $organizationId
```

***

### permissions

```php
private ?array $permissions
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

## Methods

### __construct

```php
public __construct(?string $userId = null, ?string $resourceId = null, ?string $resourceType = null, ?string $organizationId = null, ?array $permissions = [], ?\DateTime $grantedAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$userId`         | **?string**    |             |
| `$resourceId`     | **?string**    |             |
| `$resourceType`   | **?string**    |             |
| `$organizationId` | **?string**    |             |
| `$permissions`    | **?array**     |             |
| `$grantedAt`      | **?\DateTime** |             |
| `$updatedAt`      | **?\DateTime** |             |

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

### getUserId

```php
public getUserId(): ?string
```

***

### getResourceId

```php
public getResourceId(): ?string
```

***

### getResourceType

```php
public getResourceType(): ?string
```

***

### getOrganizationId

```php
public getOrganizationId(): ?string
```

***

### getPermissions

```php
public getPermissions(): ?array
```

***

### getGrantedAt

```php
public getGrantedAt(): ?\DateTime
```

***

### getUpdatedAt

```php
public getUpdatedAt(): ?\DateTime
```

***
