# ProfileCurrentTrial

Low level ProfileCurrentTrial (auto-generated)
The current trial for the profile.

***

* Full name: `\Upsun\Model\ProfileCurrentTrial`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### pendingVerification

```php
private ?string $pendingVerification
```

***

### active

```php
private ?bool $active
```

***

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

### expiration

```php
private ?\DateTime $expiration
```

***

### current

```php
private ?\Upsun\Model\ProfileCurrentTrialCurrent $current
```

***

### spend

```php
private ?\Upsun\Model\ProfileCurrentTrialSpend $spend
```

***

### spendRemaining

```php
private ?\Upsun\Model\ProfileCurrentTrialSpendRemaining $spendRemaining
```

***

### projects

```php
private ?\Upsun\Model\ProfileCurrentTrialProjects $projects
```

***

### model

```php
private ?string $model
```

***

### daysRemaining

```php
private ?int $daysRemaining
```

***

## Methods

### __construct

```php
public __construct(?string $pendingVerification = null, ?bool $active = null, ?\DateTime $created = null, ?string $description = null, ?\DateTime $expiration = null, ?\Upsun\Model\ProfileCurrentTrialCurrent $current = null, ?\Upsun\Model\ProfileCurrentTrialSpend $spend = null, ?\Upsun\Model\ProfileCurrentTrialSpendRemaining $spendRemaining = null, ?\Upsun\Model\ProfileCurrentTrialProjects $projects = null, ?string $model = null, ?int $daysRemaining = null): mixed
```

**Parameters:**

| Parameter              | Type                                                | Description |
|------------------------|-----------------------------------------------------|-------------|
| `$pendingVerification` | **?string**                                         |             |
| `$active`              | **?bool**                                           |             |
| `$created`             | **?\DateTime**                                      |             |
| `$description`         | **?string**                                         |             |
| `$expiration`          | **?\DateTime**                                      |             |
| `$current`             | **?\Upsun\Model\ProfileCurrentTrialCurrent**        |             |
| `$spend`               | **?\Upsun\Model\ProfileCurrentTrialSpend**          |             |
| `$spendRemaining`      | **?\Upsun\Model\ProfileCurrentTrialSpendRemaining** |             |
| `$projects`            | **?\Upsun\Model\ProfileCurrentTrialProjects**       |             |
| `$model`               | **?string**                                         |             |
| `$daysRemaining`       | **?int**                                            |             |

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

### getActive

The trial active status.

```php
public getActive(): ?bool
```

***

### getCreated

The trial creation date.

```php
public getCreated(): ?\DateTime
```

***

### getDescription

The trial description.

```php
public getDescription(): ?string
```

***

### getExpiration

The trial expiration-date.

```php
public getExpiration(): ?\DateTime
```

***

### getCurrent

The total amount spent by the trial user at this point in time.

```php
public getCurrent(): ?\Upsun\Model\ProfileCurrentTrialCurrent
```

***

### getSpend

The total amount available for the trial.

```php
public getSpend(): ?\Upsun\Model\ProfileCurrentTrialSpend
```

***

### getSpendRemaining

The remaining amount available for the trial.

```php
public getSpendRemaining(): ?\Upsun\Model\ProfileCurrentTrialSpendRemaining
```

***

### getProjects

Projects active under trial

```php
public getProjects(): ?\Upsun\Model\ProfileCurrentTrialProjects
```

***

### getPendingVerification

Required verification method (if applicable).

```php
public getPendingVerification(): ?string
```

***

### getModel

The trial trial model.

```php
public getModel(): ?string
```

***

### getDaysRemaining

The amount of days until the trial expires.

```php
public getDaysRemaining(): ?int
```

***
