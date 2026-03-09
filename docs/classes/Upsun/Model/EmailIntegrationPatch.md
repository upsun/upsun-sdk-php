# EmailIntegrationPatch

Low level EmailIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\EmailIntegrationPatch`
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

### recipients

```php
private array $recipients
```

***

### fromAddress

```php
private ?string $fromAddress
```

***

## Methods

### __construct

```php
public __construct(string $type, array $recipients, ?string $fromAddress = null): mixed
```

**Parameters:**

| Parameter      | Type        | Description |
|----------------|-------------|-------------|
| `$type`        | **string**  |             |
| `$recipients`  | **array**   |             |
| `$fromAddress` | **?string** |             |

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

### getRecipients

```php
public getRecipients(): array
```

***

### getFromAddress

The email address to use

```php
public getFromAddress(): ?string
```

***
