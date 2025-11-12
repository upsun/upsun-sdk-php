# CanCreateNewOrgSubscription200Response

Low level CanCreateNewOrgSubscription200Response (auto-generated)

***

* Full name: `\Upsun\Model\CanCreateNewOrgSubscription200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### requiredAction

```php
private ?\Upsun\Model\CanCreateNewOrgSubscription200ResponseRequiredAction $requiredAction
```

***

### canCreate

```php
private ?bool $canCreate
```

***

### message

```php
private ?string $message
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\CanCreateNewOrgSubscription200ResponseRequiredAction $requiredAction = null, ?bool $canCreate = null, ?string $message = null): mixed
```

**Parameters:**

| Parameter         | Type                                                                   | Description |
|-------------------|------------------------------------------------------------------------|-------------|
| `$requiredAction` | **?\Upsun\Model\CanCreateNewOrgSubscription200ResponseRequiredAction** |             |
| `$canCreate`      | **?bool**                                                              |             |
| `$message`        | **?string**                                                            |             |

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

### getCanCreate

```php
public getCanCreate(): ?bool
```

***

### getMessage

```php
public getMessage(): ?string
```

***

### getRequiredAction

```php
public getRequiredAction(): ?\Upsun\Model\CanCreateNewOrgSubscription200ResponseRequiredAction
```

***
