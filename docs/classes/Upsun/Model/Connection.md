# Connection

Low level Connection (auto-generated)

***

* Full name: `\Upsun\Model\Connection`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### provider

```php
private ?string $provider
```

***

### providerType

```php
private ?string $providerType
```

***

### isMandatory

```php
private ?bool $isMandatory
```

***

### subject

```php
private ?string $subject
```

***

### emailAddress

```php
private ?string $emailAddress
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

## Methods

### __construct

```php
public __construct(?string $provider = null, ?string $providerType = null, ?bool $isMandatory = null, ?string $subject = null, ?string $emailAddress = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null): mixed
```

**Parameters:**

| Parameter       | Type           | Description |
|-----------------|----------------|-------------|
| `$provider`     | **?string**    |             |
| `$providerType` | **?string**    |             |
| `$isMandatory`  | **?bool**      |             |
| `$subject`      | **?string**    |             |
| `$emailAddress` | **?string**    |             |
| `$createdAt`    | **?\DateTime** |             |
| `$updatedAt`    | **?\DateTime** |             |

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

### getProvider

The name of the federation provider.

```php
public getProvider(): ?string
```

***

### getProviderType

The type of the federation provider.

```php
public getProviderType(): ?string
```

***

### getIsMandatory

Whether the federated login connection is mandatory.

```php
public getIsMandatory(): ?bool
```

***

### getSubject

The identity on the federation provider.

```php
public getSubject(): ?string
```

***

### getEmailAddress

The email address presented on the federated login connection.

```php
public getEmailAddress(): ?string
```

***

### getCreatedAt

The date and time when the connection was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the connection was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***
