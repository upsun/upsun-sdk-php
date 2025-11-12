# FastlyIntegrationPatch

Low level FastlyIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\FastlyIntegrationPatch`
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

### token

```php
private string $token
```

***

### serviceId

```php
private string $serviceId
```

***

### events

```php
private ?array $events
```

***

### environments

```php
private ?array $environments
```

***

### excludedEnvironments

```php
private ?array $excludedEnvironments
```

***

### states

```php
private ?array $states
```

***

### result

```php
private ?string $result
```

***

## Methods

### __construct

```php
public __construct(string $type, string $token, string $serviceId, ?array $events = [], ?array $environments = [], ?array $excludedEnvironments = [], ?array $states = [], ?string $result = null): mixed
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$type`                 | **string**  |             |
| `$token`                | **string**  |             |
| `$serviceId`            | **string**  |             |
| `$events`               | **?array**  |             |
| `$environments`         | **?array**  |             |
| `$excludedEnvironments` | **?array**  |             |
| `$states`               | **?array**  |             |
| `$result`               | **?string** |             |

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

### getType

```php
public getType(): string
```

***

### getToken

Fastly API Token

```php
public getToken(): string
```

***

### getServiceId

```php
public getServiceId(): string
```

***

### getEvents

```php
public getEvents(): ?array
```

***

### getEnvironments

```php
public getEnvironments(): ?array
```

***

### getExcludedEnvironments

```php
public getExcludedEnvironments(): ?array
```

***

### getStates

```php
public getStates(): ?array
```

***

### getResult

Result to execute the hook on

```php
public getResult(): ?string
```

***
