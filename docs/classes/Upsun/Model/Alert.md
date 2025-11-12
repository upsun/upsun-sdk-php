# Alert

Low level Alert (auto-generated)

The alert object.

***

* Full name: `\Upsun\Model\Alert`
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

### active

```php
private ?bool $active
```

***

### alertsSent

```php
private ?int $alertsSent
```

***

### lastAlertAt

```php
private ?\DateTime $lastAlertAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### config

```php
private ?object $config
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?bool $active = null, ?int $alertsSent = null, ?\DateTime $lastAlertAt = null, ?\DateTime $updatedAt = null, ?object $config = null): mixed
```

**Parameters:**

| Parameter      | Type           | Description |
|----------------|----------------|-------------|
| `$id`          | **?string**    |             |
| `$active`      | **?bool**      |             |
| `$alertsSent`  | **?int**       |             |
| `$lastAlertAt` | **?\DateTime** |             |
| `$updatedAt`   | **?\DateTime** |             |
| `$config`      | **?object**    |             |

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

The identification of the alert type.

```php
public getId(): ?string
```

***

### getActive

Whether the alert is currently active.

```php
public getActive(): ?bool
```

***

### getAlertsSent

The amount of alerts of this type that have been sent so far.

```php
public getAlertsSent(): ?int
```

***

### getLastAlertAt

The time the last alert has been sent.

```php
public getLastAlertAt(): ?\DateTime
```

***

### getUpdatedAt

The time the alert has last been updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getConfig

The alert type specific configuration.

```php
public getConfig(): ?object
```

***
