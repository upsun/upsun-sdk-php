# FastlyIntegration

Low level FastlyIntegration (auto-generated)

***

* Full name: `\Upsun\Model\FastlyIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### events

```php
private array $events
```

***

### environments

```php
private array $environments
```

***

### excludedEnvironments

```php
private array $excludedEnvironments
```

***

### states

```php
private array $states
```

***

### result

```php
private string $result
```

***

### serviceId

```php
private string $serviceId
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

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, array $events, array $environments, array $excludedEnvironments, array $states, string $result, string $serviceId, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter               | Type           | Description |
|-------------------------|----------------|-------------|
| `$type`                 | **string**     |             |
| `$events`               | **array**      |             |
| `$environments`         | **array**      |             |
| `$excludedEnvironments` | **array**      |             |
| `$states`               | **array**      |             |
| `$result`               | **string**     |             |
| `$serviceId`            | **string**     |             |
| `$createdAt`            | **?\DateTime** |             |
| `$updatedAt`            | **?\DateTime** |             |
| `$id`                   | **?string**    |             |

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

```php
public getType(): string
```

***

### getEvents

```php
public getEvents(): array
```

***

### getEnvironments

```php
public getEnvironments(): array
```

***

### getExcludedEnvironments

```php
public getExcludedEnvironments(): array
```

***

### getStates

```php
public getStates(): array
```

***

### getResult

Result to execute the hook on

```php
public getResult(): string
```

***

### getServiceId

```php
public getServiceId(): string
```

***

### getId

The identifier of FastlyIntegration

```php
public getId(): ?string
```

***
