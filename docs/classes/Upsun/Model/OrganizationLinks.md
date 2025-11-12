# OrganizationLinks

Low level OrganizationLinks (auto-generated)

***

* Full name: `\Upsun\Model\OrganizationLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\OrganizationLinksSelf $self
```

***

### update

```php
private ?\Upsun\Model\OrganizationLinksUpdate $update
```

***

### delete

```php
private ?\Upsun\Model\OrganizationLinksDelete $delete
```

***

### members

```php
private ?\Upsun\Model\OrganizationLinksMembers $members
```

***

### createMember

```php
private ?\Upsun\Model\OrganizationLinksCreateMember $createMember
```

***

### address

```php
private ?\Upsun\Model\OrganizationLinksAddress $address
```

***

### profile

```php
private ?\Upsun\Model\OrganizationLinksProfile $profile
```

***

### paymentSource

```php
private ?\Upsun\Model\OrganizationLinksPaymentSource $paymentSource
```

***

### orders

```php
private ?\Upsun\Model\OrganizationLinksOrders $orders
```

***

### vouchers

```php
private ?\Upsun\Model\OrganizationLinksVouchers $vouchers
```

***

### applyVoucher

```php
private ?\Upsun\Model\OrganizationLinksApplyVoucher $applyVoucher
```

***

### subscriptions

```php
private ?\Upsun\Model\OrganizationLinksSubscriptions $subscriptions
```

***

### createSubscription

```php
private ?\Upsun\Model\OrganizationLinksCreateSubscription $createSubscription
```

***

### estimateSubscription

```php
private ?\Upsun\Model\OrganizationLinksEstimateSubscription $estimateSubscription
```

***

### mfaEnforcement

```php
private ?\Upsun\Model\OrganizationLinksMfaEnforcement $mfaEnforcement
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\OrganizationLinksSelf $self = null, ?\Upsun\Model\OrganizationLinksUpdate $update = null, ?\Upsun\Model\OrganizationLinksDelete $delete = null, ?\Upsun\Model\OrganizationLinksMembers $members = null, ?\Upsun\Model\OrganizationLinksCreateMember $createMember = null, ?\Upsun\Model\OrganizationLinksAddress $address = null, ?\Upsun\Model\OrganizationLinksProfile $profile = null, ?\Upsun\Model\OrganizationLinksPaymentSource $paymentSource = null, ?\Upsun\Model\OrganizationLinksOrders $orders = null, ?\Upsun\Model\OrganizationLinksVouchers $vouchers = null, ?\Upsun\Model\OrganizationLinksApplyVoucher $applyVoucher = null, ?\Upsun\Model\OrganizationLinksSubscriptions $subscriptions = null, ?\Upsun\Model\OrganizationLinksCreateSubscription $createSubscription = null, ?\Upsun\Model\OrganizationLinksEstimateSubscription $estimateSubscription = null, ?\Upsun\Model\OrganizationLinksMfaEnforcement $mfaEnforcement = null): mixed
```

**Parameters:**

| Parameter               | Type                                                    | Description |
|-------------------------|---------------------------------------------------------|-------------|
| `$self`                 | **?\Upsun\Model\OrganizationLinksSelf**                 |             |
| `$update`               | **?\Upsun\Model\OrganizationLinksUpdate**               |             |
| `$delete`               | **?\Upsun\Model\OrganizationLinksDelete**               |             |
| `$members`              | **?\Upsun\Model\OrganizationLinksMembers**              |             |
| `$createMember`         | **?\Upsun\Model\OrganizationLinksCreateMember**         |             |
| `$address`              | **?\Upsun\Model\OrganizationLinksAddress**              |             |
| `$profile`              | **?\Upsun\Model\OrganizationLinksProfile**              |             |
| `$paymentSource`        | **?\Upsun\Model\OrganizationLinksPaymentSource**        |             |
| `$orders`               | **?\Upsun\Model\OrganizationLinksOrders**               |             |
| `$vouchers`             | **?\Upsun\Model\OrganizationLinksVouchers**             |             |
| `$applyVoucher`         | **?\Upsun\Model\OrganizationLinksApplyVoucher**         |             |
| `$subscriptions`        | **?\Upsun\Model\OrganizationLinksSubscriptions**        |             |
| `$createSubscription`   | **?\Upsun\Model\OrganizationLinksCreateSubscription**   |             |
| `$estimateSubscription` | **?\Upsun\Model\OrganizationLinksEstimateSubscription** |             |
| `$mfaEnforcement`       | **?\Upsun\Model\OrganizationLinksMfaEnforcement**       |             |

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

Link to the current organization.

```php
public getSelf(): ?\Upsun\Model\OrganizationLinksSelf
```

***

### getUpdate

Link for updating the current organization.

```php
public getUpdate(): ?\Upsun\Model\OrganizationLinksUpdate
```

***

### getDelete

Link for deleting the current organization.

```php
public getDelete(): ?\Upsun\Model\OrganizationLinksDelete
```

***

### getMembers

Link to the current organization's members.

```php
public getMembers(): ?\Upsun\Model\OrganizationLinksMembers
```

***

### getCreateMember

Link for creating a new organization member.

```php
public getCreateMember(): ?\Upsun\Model\OrganizationLinksCreateMember
```

***

### getAddress

Link to the current organization's address.

```php
public getAddress(): ?\Upsun\Model\OrganizationLinksAddress
```

***

### getProfile

Link to the current organization's profile.

```php
public getProfile(): ?\Upsun\Model\OrganizationLinksProfile
```

***

### getPaymentSource

Link to the current organization's payment source.

```php
public getPaymentSource(): ?\Upsun\Model\OrganizationLinksPaymentSource
```

***

### getOrders

Link to the current organization's orders.

```php
public getOrders(): ?\Upsun\Model\OrganizationLinksOrders
```

***

### getVouchers

Link to the current organization's vouchers.

```php
public getVouchers(): ?\Upsun\Model\OrganizationLinksVouchers
```

***

### getApplyVoucher

Link for applying a voucher for the current organization.

```php
public getApplyVoucher(): ?\Upsun\Model\OrganizationLinksApplyVoucher
```

***

### getSubscriptions

Link to the current organization's subscriptions.

```php
public getSubscriptions(): ?\Upsun\Model\OrganizationLinksSubscriptions
```

***

### getCreateSubscription

Link for creating a new organization subscription.

```php
public getCreateSubscription(): ?\Upsun\Model\OrganizationLinksCreateSubscription
```

***

### getEstimateSubscription

Link for estimating the price of a new subscription.

```php
public getEstimateSubscription(): ?\Upsun\Model\OrganizationLinksEstimateSubscription
```

***

### getMfaEnforcement

Link to the current organization's MFA enforcement settings.

```php
public getMfaEnforcement(): ?\Upsun\Model\OrganizationLinksMfaEnforcement
```

***
