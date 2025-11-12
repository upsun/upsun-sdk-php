# CurrentUserCurrentTrialInner

Low level CurrentUserCurrentTrialInner (auto-generated)

***

* Full name: `\Upsun\Model\CurrentUserCurrentTrialInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### created

```php
private ?\DateTime $created
```

***

### description

```php
private ?string $description
```

***

### spendRemaining

```php
private ?string $spendRemaining
```

***

### expiration

```php
private ?\DateTime $expiration
```

***

## Methods

### __construct

```php
public __construct(?\DateTime $created = null, ?string $description = null, ?string $spendRemaining = null, ?\DateTime $expiration = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$created`        | **?\DateTime** |             |
| `$description`    | **?string**    |             |
| `$spendRemaining` | **?string**    |             |
| `$expiration`     | **?\DateTime** |             |

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

### getCreated

```php
public getCreated(): ?\DateTime
```

***

### getDescription

```php
public getDescription(): ?string
```

***

### getSpendRemaining

```php
public getSpendRemaining(): ?string
```

***

### getExpiration

```php
public getExpiration(): ?\DateTime
```

***
