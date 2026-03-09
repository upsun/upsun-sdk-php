# SlackIntegration

Low level SlackIntegration (auto-generated)

***

* Full name: `\Upsun\Model\SlackIntegration`
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

### channel

```php
private string $channel
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
public __construct(string $type, string $channel, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter    | Type           | Description |
|--------------|----------------|-------------|
| `$type`      | **string**     |             |
| `$channel`   | **string**     |             |
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

### getChannel

The Slack channel to post messages to

```php
public getChannel(): string
```

***

### getId

The identifier of SlackIntegration

```php
public getId(): ?string
```

***
