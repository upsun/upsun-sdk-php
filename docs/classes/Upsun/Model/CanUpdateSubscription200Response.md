# CanUpdateSubscription200Response

Low level CanUpdateSubscription200Response (auto-generated)

***

* Full name: `\Upsun\Model\CanUpdateSubscription200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### canUpdate

```php
private ?bool $canUpdate
```

***

### message

```php
private ?string $message
```

***

### requiredAction

```php
private ?object $requiredAction
```

***

## Methods

### __construct

```php
public __construct(?bool $canUpdate = null, ?string $message = null, ?object $requiredAction = null): mixed
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$canUpdate`      | **?bool**   |             |
| `$message`        | **?string** |             |
| `$requiredAction` | **?object** |             |

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

### getCanUpdate

```php
public getCanUpdate(): ?bool
```

***

### getMessage

```php
public getMessage(): ?string
```

***

### getRequiredAction

```php
public getRequiredAction(): ?object
```

***
