# OrganizationEstimationObjectUserLicensesUserManagementList

Low level OrganizationEstimationObjectUserLicensesUserManagementList (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### standardManagementUser

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser $standardManagementUser
```

***

### advancedManagementUser

```php
private ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser $advancedManagementUser
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser $standardManagementUser = null, ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser $advancedManagementUser = null): mixed
```

**Parameters:**

| Parameter                 | Type                                                                                               | Description |
|---------------------------|----------------------------------------------------------------------------------------------------|-------------|
| `$standardManagementUser` | **?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser** |             |
| `$advancedManagementUser` | **?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser** |             |

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

### getStandardManagementUser

An estimation of standard_management_user cost.

```php
public getStandardManagementUser(): ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser
```

***

### getAdvancedManagementUser

An estimation of advanced_management_user cost.

```php
public getAdvancedManagementUser(): ?\Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser
```

***
