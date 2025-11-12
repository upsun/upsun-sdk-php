# ProdDomainStorage

Low level ProdDomainStorage (auto-generated)

***

* Full name: `\Upsun\Model\ProdDomainStorage`
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

### name

```php
private string $name
```

***

### attributes

```php
private array $attributes
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

### project

```php
private ?string $project
```

***

### registeredName

```php
private ?string $registeredName
```

***

### isDefault

```php
private ?bool $isDefault
```

***

## Methods

### __construct

```php
public __construct(string $type, string $name, array $attributes, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null, ?string $project = null, ?string $registeredName = null, ?bool $isDefault = null): mixed
```

**Parameters:**

| Parameter         | Type           | Description |
|-------------------|----------------|-------------|
| `$type`           | **string**     |             |
| `$name`           | **string**     |             |
| `$attributes`     | **array**      |             |
| `$createdAt`      | **?\DateTime** |             |
| `$updatedAt`      | **?\DateTime** |             |
| `$id`             | **?string**    |             |
| `$project`        | **?string**    |             |
| `$registeredName` | **?string**    |             |
| `$isDefault`      | **?bool**      |             |

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

### getName

```php
public getName(): string
```

***

### getAttributes

```php
public getAttributes(): array
```

***

### getId

The identifier of ProdDomainStorage

```php
public getId(): ?string
```

***

### getProject

```php
public getProject(): ?string
```

***

### getRegisteredName

```php
public getRegisteredName(): ?string
```

***

### getIsDefault

Is this domain default

```php
public getIsDefault(): ?bool
```

***
