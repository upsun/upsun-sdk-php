# EmailIntegration

Low level EmailIntegration (auto-generated)

***

* Full name: `\Upsun\Model\EmailIntegration`
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

### recipients

```php
private array $recipients
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

### fromAddress

```php
private ?string $fromAddress
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
public __construct(string $type, array $recipients, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $fromAddress, ?string $id = null): mixed
```

**Parameters:**

| Parameter      | Type           | Description |
|----------------|----------------|-------------|
| `$type`        | **string**     |             |
| `$recipients`  | **array**      |             |
| `$createdAt`   | **?\DateTime** |             |
| `$updatedAt`   | **?\DateTime** |             |
| `$fromAddress` | **?string**    |             |
| `$id`          | **?string**    |             |

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

### getFromAddress

The email address to use

```php
public getFromAddress(): ?string
```

***

### getRecipients

```php
public getRecipients(): array
```

***

### getId

The identifier of EmailIntegration

```php
public getId(): ?string
```

***
