# UpdateTicketRequest

Low level UpdateTicketRequest (auto-generated)

***

* Full name: `\Upsun\Model\UpdateTicketRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant        | Visibility | Type | Value    |
|-----------------|------------|------|----------|
| `STATUS_OPEN`   | public     |      | 'open'   |
| `STATUS_SOLVED` | public     |      | 'solved' |

## Properties

### status

```php
private ?string $status
```

***

### collaboratorIds

```php
private ?array $collaboratorIds
```

***

### collaboratorsReplace

```php
private ?bool $collaboratorsReplace
```

***

## Methods

### __construct

```php
public __construct(?string $status = null, ?array $collaboratorIds = [], ?bool $collaboratorsReplace = null): mixed
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$status`               | **?string** |             |
| `$collaboratorIds`      | **?array**  |             |
| `$collaboratorsReplace` | **?bool**   |             |

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

### getStatus

```php
public getStatus(): ?string
```

***

### getCollaboratorIds

```php
public getCollaboratorIds(): ?array
```

***

### getCollaboratorsReplace

```php
public getCollaboratorsReplace(): ?bool
```

***
