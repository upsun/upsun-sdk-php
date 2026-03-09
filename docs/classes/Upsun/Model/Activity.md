# Activity

Low level Activity (auto-generated)

***

* Full name: `\Upsun\Model\Activity`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant            | Visibility | Type | Value         |
|---------------------|------------|------|---------------|
| `STATE_CANCELLED`   | public     |      | 'cancelled'   |
| `STATE_COMPLETE`    | public     |      | 'complete'    |
| `STATE_IN_PROGRESS` | public     |      | 'in_progress' |
| `STATE_PENDING`     | public     |      | 'pending'     |
| `STATE_SCHEDULED`   | public     |      | 'scheduled'   |
| `STATE_STAGED`      | public     |      | 'staged'      |
| `RESULT_FAILURE`    | public     |      | 'failure'     |
| `RESULT_SUCCESS`    | public     |      | 'success'     |

## Properties

### id

```php
private string $id
```

***

### type

```php
private string $type
```

***

### parameters

```php
private object $parameters
```

***

### project

```php
private string $project
```

***

### state

```php
private string $state
```

***

### completionPercent

```php
private int $completionPercent
```

***

### timings

```php
private array $timings
```

***

### log

```php
private string $log
```

***

### payload

```php
private object $payload
```

***

### commands

```php
private array $commands
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### result

```php
private ?string $result
```

***

### startedAt

```php
private ?\DateTime $startedAt
```

***

### completedAt

```php
private ?\DateTime $completedAt
```

***

### cancelledAt

```php
private ?\DateTime $cancelledAt
```

***

### description

```php
private ?string $description
```

***

### text

```php
private ?string $text
```

***

### expiresAt

```php
private ?\DateTime $expiresAt
```

***

### integration

```php
private ?string $integration
```

***

### environments

```php
private ?array $environments
```

***

## Methods

### __construct

```php
public __construct(string $id, string $type, object $parameters, string $project, string $state, int $completionPercent, array $timings, string $log, object $payload, array $commands, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $result, ?\DateTime $startedAt, ?\DateTime $completedAt, ?\DateTime $cancelledAt, ?string $description, ?string $text, ?\DateTime $expiresAt, ?string $integration = null, ?array $environments = []): mixed
```

**Parameters:**

| Parameter            | Type           | Description |
|----------------------|----------------|-------------|
| `$id`                | **string**     |             |
| `$type`              | **string**     |             |
| `$parameters`        | **object**     |             |
| `$project`           | **string**     |             |
| `$state`             | **string**     |             |
| `$completionPercent` | **int**        |             |
| `$timings`           | **array**      |             |
| `$log`               | **string**     |             |
| `$payload`           | **object**     |             |
| `$commands`          | **array**      |             |
| `$createdAt`         | **?\DateTime** |             |
| `$updatedAt`         | **?\DateTime** |             |
| `$result`            | **?string**    |             |
| `$startedAt`         | **?\DateTime** |             |
| `$completedAt`       | **?\DateTime** |             |
| `$cancelledAt`       | **?\DateTime** |             |
| `$description`       | **?string**    |             |
| `$text`              | **?string**    |             |
| `$expiresAt`         | **?\DateTime** |             |
| `$integration`       | **?string**    |             |
| `$environments`      | **?array**     |             |

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

The identifier of Activity

```php
public getId(): string
```

***

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getType

The type of the activity

```php
public getType(): string
```

***

### getParameters

The parameters of the activity

```php
public getParameters(): object
```

***

### getProject

The project the activity belongs to

```php
public getProject(): string
```

***

### getState

The state of the activity

```php
public getState(): string
```

***

### getResult

The result of the activity

```php
public getResult(): ?string
```

***

### getStartedAt

The start date of the activity

```php
public getStartedAt(): ?\DateTime
```

***

### getCompletedAt

The completion date of the activity

```php
public getCompletedAt(): ?\DateTime
```

***

### getCompletionPercent

The completion percentage of the activity

```php
public getCompletionPercent(): int
```

***

### getCancelledAt

The Cancellation date of the activity

```php
public getCancelledAt(): ?\DateTime
```

***

### getTimings

```php
public getTimings(): array
```

***

### getLog

The log of the activity

```php
public getLog(): string
```

***

### getPayload

The payload of the activity

```php
public getPayload(): object
```

***

### getDescription

The description of the activity, formatted with HTML

```php
public getDescription(): ?string
```

***

### getText

The description of the activity, formatted as plain text

```php
public getText(): ?string
```

***

### getExpiresAt

The date at which the activity will expire

```php
public getExpiresAt(): ?\DateTime
```

***

### getCommands

The commands of the activity

```php
public getCommands(): \Upsun\Model\CommandsInner[]
```

***

### getIntegration

The integration the activity belongs to

```php
public getIntegration(): ?string
```

***

### getEnvironments

```php
public getEnvironments(): ?array
```

***
