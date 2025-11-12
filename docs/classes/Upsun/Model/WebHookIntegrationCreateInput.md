# WebHookIntegrationCreateInput

Low level WebHookIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\WebHookIntegrationCreateInput`
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

### url

```php
private string $url
```

***

### sharedKey

```php
private ?string $sharedKey
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
public __construct(string $type, string $url, ?string $sharedKey = null, ?array $events = [], ?array $environments = [], ?array $excludedEnvironments = [], ?array $states = [], ?string $result = null): mixed
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$type`                 | **string**  |             |
| `$url`                  | **string**  |             |
| `$sharedKey`            | **?string** |             |
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

### getUrl

The URL of the webhook

```php
public getUrl(): string
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

### getSharedKey

The JWS shared secret key

```php
public getSharedKey(): ?string
```

***
