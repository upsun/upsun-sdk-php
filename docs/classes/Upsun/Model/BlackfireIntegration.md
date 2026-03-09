# BlackfireIntegration

Low level BlackfireIntegration (auto-generated)

***

* Full name: `\Upsun\Model\BlackfireIntegration`
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

### environmentsCredentials

```php
private array $environmentsCredentials
```

***

### continuousProfiling

```php
private bool $continuousProfiling
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
public __construct(string $type, array $environmentsCredentials, bool $continuousProfiling, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter                  | Type           | Description |
|----------------------------|----------------|-------------|
| `$type`                    | **string**     |             |
| `$environmentsCredentials` | **array**      |             |
| `$continuousProfiling`     | **bool**       |             |
| `$createdAt`               | **?\DateTime** |             |
| `$updatedAt`               | **?\DateTime** |             |
| `$id`                      | **?string**    |             |

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

### getEnvironmentsCredentials

Blackfire environments credentials

```php
public getEnvironmentsCredentials(): \Upsun\Model\EnvironmentsCredentialsValue[]
```

***

### getContinuousProfiling

Whether continuous profiling is enabled for the project

```php
public getContinuousProfiling(): bool
```

***

### getId

The identifier of BlackfireIntegration

```php
public getId(): ?string
```

***
