# HealthWebHookIntegrationPatch

Low level HealthWebHookIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\HealthWebHookIntegrationPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationPatch`](./IntegrationPatch.md)

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

## Methods

### __construct

```php
public __construct(string $type, string $url, ?string $sharedKey = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$type`      | **string**  |             |
| `$url`       | **string**  |             |
| `$sharedKey` | **?string** |             |

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

### getSharedKey

The JWS shared secret key

```php
public getSharedKey(): ?string
```

***
