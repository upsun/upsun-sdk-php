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

### api

```php
private ?\Upsun\Model\OrganizationProjectLinksApi $api
```

***

### subscription

```php
private ?\Upsun\Model\OrganizationProjectLinksSubscription $subscription
```

***

### viewUsageAlerts

```php
private ?\Upsun\Model\OrganizationProjectLinksViewUsageAlerts $viewUsageAlerts
```

***

### update

```php
private ?\Upsun\Model\OrganizationProjectLinksUpdate $update
```

***

### planUri

```php
private ?\Upsun\Model\OrganizationProjectLinksPlanUri $planUri
```

***

### delete

```php
private ?\Upsun\Model\OrganizationProjectLinksDelete $delete
```

***

### updateUsageAlerts

```php
private ?\Upsun\Model\OrganizationProjectLinksUpdateUsageAlerts $updateUsageAlerts
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

### self

```php
private ?\Upsun\Model\OrganizationProjectLinksSelf $self
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationProjectLinksApi $api = null, ?\Upsun\Model\OrganizationProjectLinksSubscription $subscription = null, ?\Upsun\Model\OrganizationProjectLinksViewUsageAlerts $viewUsageAlerts = null, ?\Upsun\Model\OrganizationProjectLinksUpdate $update = null, ?\Upsun\Model\OrganizationProjectLinksPlanUri $planUri = null, ?\Upsun\Model\OrganizationProjectLinksDelete $delete = null, ?\Upsun\Model\OrganizationProjectLinksUpdateUsageAlerts $updateUsageAlerts = null, ?\Upsun\Model\OrganizationProjectLinksActivities $activities = null, ?\Upsun\Model\OrganizationProjectLinksAddons $addons = null, ?\Upsun\Model\OrganizationProjectLinksSelf $self = null): mixed
```

**Parameters:**

| Parameter            | Type                                                        | Description |
|----------------------|-------------------------------------------------------------|-------------|
| `$api`               | **?\Upsun\Model\OrganizationProjectLinksApi**               |             |
| `$subscription`      | **?\Upsun\Model\OrganizationProjectLinksSubscription**      |             |
| `$viewUsageAlerts`   | **?\Upsun\Model\OrganizationProjectLinksViewUsageAlerts**   |             |
| `$update`            | **?\Upsun\Model\OrganizationProjectLinksUpdate**            |             |
| `$planUri`           | **?\Upsun\Model\OrganizationProjectLinksPlanUri**           |             |
| `$delete`            | **?\Upsun\Model\OrganizationProjectLinksDelete**            |             |
| `$updateUsageAlerts` | **?\Upsun\Model\OrganizationProjectLinksUpdateUsageAlerts** |             |
| `$activities`        | **?\Upsun\Model\OrganizationProjectLinksActivities**        |             |
| `$addons`            | **?\Upsun\Model\OrganizationProjectLinksAddons**            |             |
| `$self`              | **?\Upsun\Model\OrganizationProjectLinksSelf**              |             |

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

### getApi

Link to the regional API endpoint. Only present if user has project-level access.

```php
public getApi(): ?\Upsun\Model\OrganizationProjectLinksApi
```

***

### getSubscription

Link to the subscription. Only present if project has a subscription.

```php
public getSubscription(): ?\Upsun\Model\OrganizationProjectLinksSubscription
```

***

### getViewUsageAlerts

Link to view usage alerts. Only present if user has view permission.

```php
public getViewUsageAlerts(): ?\Upsun\Model\OrganizationProjectLinksViewUsageAlerts
```

***

### getUpdate

Link for updating the current project. Only present if user has update permission.

```php
public getUpdate(): ?\Upsun\Model\OrganizationProjectLinksUpdate
```

***

### getPlanUri

Link to the billing plan page. Only present if user has manage permission.

```php
public getPlanUri(): ?\Upsun\Model\OrganizationProjectLinksPlanUri
```

***

### getDelete

Link for deleting the current project. Only present if user has delete permission.

```php
public getDelete(): ?\Upsun\Model\OrganizationProjectLinksDelete
```

***

### getUpdateUsageAlerts

Link to update usage alerts. Only present if user has billing permission.

```php
public getUpdateUsageAlerts(): ?\Upsun\Model\OrganizationProjectLinksUpdateUsageAlerts
```

***

### getActivities

Link to the project's activities. Only present if user has view permission.

```php
public getActivities(): ?\Upsun\Model\OrganizationProjectLinksActivities
```

***

### getAddons

Link to the project's add-ons. Only present if user has view permission.

```php
public getAddons(): ?\Upsun\Model\OrganizationProjectLinksAddons
```

***
