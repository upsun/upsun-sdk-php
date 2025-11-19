# OrganizationAlertConfig

Low level OrganizationAlertConfig (auto-generated)
The alert configuration for an organization.

***

* Full name: `\Upsun\Model\OrganizationAlertConfig`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### lastAlertAt

```php
private ?string $lastAlertAt
```

***

### updatedAt

```php
private ?string $updatedAt
```

***

### config

```php
private ?\Upsun\Model\OrganizationAlertConfigConfig $config
```

***

### id

```php
private ?string $id
```

***

### active

```php
private ?bool $active
```

***

### alertsSent

```php
private ?float $alertsSent
```

***

## Methods

### __construct

```php
public __construct(?string $lastAlertAt = null, ?string $updatedAt = null, ?\Upsun\Model\OrganizationAlertConfigConfig $config = null, ?string $id = null, ?bool $active = null, ?float $alertsSent = null): mixed
```

**Parameters:**

| Parameter      | Type                                            | Description |
|----------------|-------------------------------------------------|-------------|
| `$lastAlertAt` | **?string**                                     |             |
| `$updatedAt`   | **?string**                                     |             |
| `$config`      | **?\Upsun\Model\OrganizationAlertConfigConfig** |             |
| `$id`          | **?string**                                     |             |
| `$active`      | **?bool**                                       |             |
| `$alertsSent`  | **?float**                                      |             |

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

Type of alert (e.g. "billing")

```php
public getId(): ?string
```

***

### getActive

Whether the billing alert should be active or not.

```php
public getActive(): ?bool
```

***

### getAlertsSent

Number of alerts sent.

```php
public getAlertsSent(): ?float
```

***

### getLastAlertAt

The datetime the alert was last sent.

```php
public getLastAlertAt(): ?string
```

***

### getUpdatedAt

The datetime the alert was last updated.

```php
public getUpdatedAt(): ?string
```

***

### getConfig

Configuration for threshold and mode.

```php
public getConfig(): ?\Upsun\Model\OrganizationAlertConfigConfig
```

***
