# OrganizationEstimationObjectUserLicensesBaseList

Low level OrganizationEstimationObjectUserLicensesBaseList (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseList`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### adminUser

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser $adminUser
```

***

### viewerUser

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListViewerUser $viewerUser
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser $adminUser = null, ?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListViewerUser $viewerUser = null): mixed
```

**Parameters:**

| Parameter     | Type                                                                         | Description |
|---------------|------------------------------------------------------------------------------|-------------|
| `$adminUser`  | **?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser**  |             |
| `$viewerUser` | **?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListViewerUser** |             |

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

### getAdminUser

An estimation of admin users cost.

```php
public getAdminUser(): ?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser
```

***

### getViewerUser

An estimation of viewer users cost.

```php
public getViewerUser(): ?\Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListViewerUser
```

***
