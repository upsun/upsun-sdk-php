# UsageAlert

Low level UsageAlert (auto-generated)

The usage alert for a subscription.

***

* Full name: `\Upsun\Model\UsageAlert`
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
private ?\Upsun\Model\UsageAlertConfig $config
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
public __construct(?string $lastAlertAt = null, ?string $updatedAt = null, ?\Upsun\Model\UsageAlertConfig $config = null, ?string $id = null, ?bool $active = null, ?float $alertsSent = null): mixed
```

**Parameters:**

| Parameter      | Type                               | Description |
|----------------|------------------------------------|-------------|
| `$lastAlertAt` | **?string**                        |             |
| `$updatedAt`   | **?string**                        |             |
| `$config`      | **?\Upsun\Model\UsageAlertConfig** |             |
| `$id`          | **?string**                        |             |
| `$active`      | **?bool**                          |             |
| `$alertsSent`  | **?float**                         |             |

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

Tidentifier of the alert.

```php
public getId(): ?string
```

***

### getActive

Whether the usage alert is activated.

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

Configuration for the usage alert.

```php
public getConfig(): ?\Upsun\Model\UsageAlertConfig
```

***
