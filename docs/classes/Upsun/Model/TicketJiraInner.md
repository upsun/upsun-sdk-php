# TicketJiraInner

Low level TicketJiraInner (auto-generated)

***

* Full name: `\Upsun\Model\TicketJiraInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?int $id
```

***

### ticketId

```php
private ?int $ticketId
```

***

### issueId

```php
private ?int $issueId
```

***

### issueKey

```php
private ?string $issueKey
```

***

### createdAt

```php
private ?float $createdAt
```

***

### updatedAt

```php
private ?float $updatedAt
```

***

## Methods

### __construct

```php
public __construct(?int $id = null, ?int $ticketId = null, ?int $issueId = null, ?string $issueKey = null, ?float $createdAt = null, ?float $updatedAt = null): mixed
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$id`        | **?int**    |             |
| `$ticketId`  | **?int**    |             |
| `$issueId`   | **?int**    |             |
| `$issueKey`  | **?string** |             |
| `$createdAt` | **?float**  |             |
| `$updatedAt` | **?float**  |             |

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

```php
public getId(): ?int
```

***

### getTicketId

```php
public getTicketId(): ?int
```

***

### getIssueId

```php
public getIssueId(): ?int
```

***

### getIssueKey

```php
public getIssueKey(): ?string
```

***

### getCreatedAt

```php
public getCreatedAt(): ?float
```

***

### getUpdatedAt

```php
public getUpdatedAt(): ?float
```

***
