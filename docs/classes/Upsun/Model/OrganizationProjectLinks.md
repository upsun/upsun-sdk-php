# OrganizationProjectLinks

Low level OrganizationProjectLinks (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationProjectLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\OrganizationProjectLinksSelf $self
```

***

### update

```php
private ?\Upsun\Model\OrganizationProjectLinksUpdate $update
```

***

### delete

```php
private ?\Upsun\Model\OrganizationProjectLinksDelete $delete
```

***

### activities

```php
private ?\Upsun\Model\OrganizationProjectLinksActivities $activities
```

***

### addons

```php
private ?\Upsun\Model\OrganizationProjectLinksAddons $addons
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationProjectLinksSelf $self = null, ?\Upsun\Model\OrganizationProjectLinksUpdate $update = null, ?\Upsun\Model\OrganizationProjectLinksDelete $delete = null, ?\Upsun\Model\OrganizationProjectLinksActivities $activities = null, ?\Upsun\Model\OrganizationProjectLinksAddons $addons = null): mixed
```

**Parameters:**

| Parameter     | Type                                                 | Description |
|---------------|------------------------------------------------------|-------------|
| `$self`       | **?\Upsun\Model\OrganizationProjectLinksSelf**       |             |
| `$update`     | **?\Upsun\Model\OrganizationProjectLinksUpdate**     |             |
| `$delete`     | **?\Upsun\Model\OrganizationProjectLinksDelete**     |             |
| `$activities` | **?\Upsun\Model\OrganizationProjectLinksActivities** |             |
| `$addons`     | **?\Upsun\Model\OrganizationProjectLinksAddons**     |             |

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

Link to the current project.

```php
public getSelf(): ?\Upsun\Model\OrganizationProjectLinksSelf
```

***

### getUpdate

Link for updating the current project.

```php
public getUpdate(): ?\Upsun\Model\OrganizationProjectLinksUpdate
```

***

### getDelete

Link for deleting the current project.

```php
public getDelete(): ?\Upsun\Model\OrganizationProjectLinksDelete
```

***

### getActivities

Link to the project's activities.

```php
public getActivities(): ?\Upsun\Model\OrganizationProjectLinksActivities
```

***

### getAddons

Link to the project's add-ons.

```php
public getAddons(): ?\Upsun\Model\OrganizationProjectLinksAddons
```

***
