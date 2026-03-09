# WebHookIntegration

Low level WebHookIntegration (auto-generated)

***

* Full name: `\Upsun\Model\WebHookIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Integration`](./Integration.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant         | Visibility | Type | Value     |
|------------------|------------|------|-----------|
| `RESULT_STAR`    | public     |      | '*'       |
| `RESULT_FAILURE` | public     |      | 'failure' |
| `RESULT_SUCCESS` | public     |      | 'success' |

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

### url

```php
private string $url
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

### sharedKey

```php
private ?string $sharedKey
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
public __construct(string $type, array $events, array $environments, array $excludedEnvironments, array $states, string $result, string $url, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $sharedKey, ?string $id = null): mixed
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
| `$url`                  | **string**     |             |
| `$createdAt`            | **?\DateTime** |             |
| `$updatedAt`            | **?\DateTime** |             |
| `$sharedKey`            | **?string**    |             |
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

### getSharedKey

The JWS shared secret key

```php
public getSharedKey(): ?string
```

***

### getUrl

The URL of the webhook

```php
public getUrl(): string
```

***

### getId

The identifier of WebHookIntegration

```php
public getId(): ?string
```

***
