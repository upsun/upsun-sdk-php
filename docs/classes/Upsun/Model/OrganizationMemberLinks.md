# OrganizationMemberLinks

Low level OrganizationMemberLinks (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationMemberLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\OrganizationMemberLinksSelf $self
```

***

### update

```php
private ?\Upsun\Model\OrganizationMemberLinksUpdate $update
```

***

### delete

```php
private ?\Upsun\Model\OrganizationMemberLinksDelete $delete
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationMemberLinksSelf $self = null, ?\Upsun\Model\OrganizationMemberLinksUpdate $update = null, ?\Upsun\Model\OrganizationMemberLinksDelete $delete = null): mixed
```

**Parameters:**

| Parameter | Type                                            | Description |
|-----------|-------------------------------------------------|-------------|
| `$self`   | **?\Upsun\Model\OrganizationMemberLinksSelf**   |             |
| `$update` | **?\Upsun\Model\OrganizationMemberLinksUpdate** |             |
| `$delete` | **?\Upsun\Model\OrganizationMemberLinksDelete** |             |

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

### getSelf

Link to the current member.

```php
public getSelf(): ?\Upsun\Model\OrganizationMemberLinksSelf
```

***

### getUpdate

Link for updating the current member.

```php
public getUpdate(): ?\Upsun\Model\OrganizationMemberLinksUpdate
```

***

### getDelete

Link for deleting the current member.

```php
public getDelete(): ?\Upsun\Model\OrganizationMemberLinksDelete
```

***
