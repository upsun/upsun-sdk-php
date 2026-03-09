# DeploymentState

Low level DeploymentState (auto-generated)
The environment deployment state

***

* Full name: `\Upsun\Model\DeploymentState`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### lastDeploymentSuccessful

```php
private bool $lastDeploymentSuccessful
```

***

### crons

```php
private \Upsun\Model\CronsDeploymentState $crons
```

***

### lastDeploymentAt

```php
private ?\DateTime $lastDeploymentAt
```

***

### lastAutoscaleUpAt

```php
private ?\DateTime $lastAutoscaleUpAt
```

***

### lastAutoscaleDownAt

```php
private ?\DateTime $lastAutoscaleDownAt
```

***

## Methods

### __construct

```php
public __construct(bool $lastDeploymentSuccessful, \Upsun\Model\CronsDeploymentState $crons, ?\DateTime $lastDeploymentAt, ?\DateTime $lastAutoscaleUpAt, ?\DateTime $lastAutoscaleDownAt): mixed
```

**Parameters:**

| Parameter                   | Type                                  | Description |
|-----------------------------|---------------------------------------|-------------|
| `$lastDeploymentSuccessful` | **bool**                              |             |
| `$crons`                    | **\Upsun\Model\CronsDeploymentState** |             |
| `$lastDeploymentAt`         | **?\DateTime**                        |             |
| `$lastAutoscaleUpAt`        | **?\DateTime**                        |             |
| `$lastAutoscaleDownAt`      | **?\DateTime**                        |             |

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

### getLastDeploymentSuccessful

Whether the last deployment was successful

```php
public getLastDeploymentSuccessful(): bool
```

***

### getLastDeploymentAt

Datetime of the last deployment

```php
public getLastDeploymentAt(): ?\DateTime
```

***

### getLastAutoscaleUpAt

Datetime of the last autoscale up deployment

```php
public getLastAutoscaleUpAt(): ?\DateTime
```

***

### getLastAutoscaleDownAt

Datetime of the last autoscale down deployment

```php
public getLastAutoscaleDownAt(): ?\DateTime
```

***

### getCrons

The crons deployment state

```php
public getCrons(): \Upsun\Model\CronsDeploymentState
```

***
