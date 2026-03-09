# HealthWebHookIntegration

Low level HealthWebHookIntegration (auto-generated)

***

* Full name: `\Upsun\Model\HealthWebHookIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Integration`](./Integration.md)

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
public __construct(string $type, string $url, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter    | Type           | Description |
|--------------|----------------|-------------|
| `$type`      | **string**     |             |
| `$url`       | **string**     |             |
| `$createdAt` | **?\DateTime** |             |
| `$updatedAt` | **?\DateTime** |             |
| `$id`        | **?string**    |             |

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

### getUrl

The URL of the webhook

```php
public getUrl(): string
```

***

### getId

The identifier of HealthWebHookIntegration

```php
public getId(): ?string
```

***
