# Webhook

Low level Webhook (auto-generated)

Webhook integration configurations

***

* Full name: `\Upsun\Model\Webhook`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private ?bool $enabled
```

***

### role

```php
private ?string $role
```

***

## Methods

### __construct

```php
public __construct(?bool $enabled = null, ?string $role = null): mixed
```

**Parameters:**

| Parameter  | Type        | Description |
|------------|-------------|-------------|
| `$enabled` | **?bool**   |             |
| `$role`    | **?string** |             |

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

### getEnabled

The integration is enabled.

```php
public getEnabled(): ?bool
```

***

### getRole

Minimum required role for creating the integration.

```php
public getRole(): ?string
```

***
