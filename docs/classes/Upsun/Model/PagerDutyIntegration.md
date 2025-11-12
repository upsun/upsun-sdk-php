# PagerDutyIntegration

Low level PagerDutyIntegration (auto-generated)

***

* Full name: `\Upsun\Model\PagerDutyIntegration`
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

### routingKey

```php
private string $routingKey
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
public __construct(string $type, string $routingKey, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter     | Type           | Description |
|---------------|----------------|-------------|
| `$type`       | **string**     |             |
| `$routingKey` | **string**     |             |
| `$createdAt`  | **?\DateTime** |             |
| `$updatedAt`  | **?\DateTime** |             |
| `$id`         | **?string**    |             |

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

### getRoutingKey

The PagerDuty routing key

```php
public getRoutingKey(): string
```

***

### getId

The identifier of PagerDutyIntegration

```php
public getId(): ?string
```

***
