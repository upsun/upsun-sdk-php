# Backup

Low level Backup (auto-generated)

***

* Full name: `\Upsun\Model\Backup`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### attributes

```php
private array $attributes
```

***

### status

```php
private string $status
```

***

### commitId

```php
private string $commitId
```

***

### environment

```php
private string $environment
```

***

### safe

```php
private bool $safe
```

***

### restorable

```php
private bool $restorable
```

***

### automated

```php
private bool $automated
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

### expiresAt

```php
private ?\DateTime $expiresAt
```

***

### index

```php
private ?int $index
```

***

### sizeOfVolumes

```php
private ?int $sizeOfVolumes
```

***

### sizeUsed

```php
private ?int $sizeUsed
```

***

### deployment

```php
private ?string $deployment
```

***

## Methods

### __construct

```php
public __construct(string $id, array $attributes, string $status, string $commitId, string $environment, bool $safe, bool $restorable, bool $automated, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?\DateTime $expiresAt, ?int $index, ?int $sizeOfVolumes, ?int $sizeUsed, ?string $deployment): mixed
```

**Parameters:**

| Parameter        | Type           | Description |
|------------------|----------------|-------------|
| `$id`            | **string**     |             |
| `$attributes`    | **array**      |             |
| `$status`        | **string**     |             |
| `$commitId`      | **string**     |             |
| `$environment`   | **string**     |             |
| `$safe`          | **bool**       |             |
| `$restorable`    | **bool**       |             |
| `$automated`     | **bool**       |             |
| `$createdAt`     | **?\DateTime** |             |
| `$updatedAt`     | **?\DateTime** |             |
| `$expiresAt`     | **?\DateTime** |             |
| `$index`         | **?int**       |             |
| `$sizeOfVolumes` | **?int**       |             |
| `$sizeUsed`      | **?int**       |             |
| `$deployment`    | **?string**    |             |

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

The identifier of Backup

```php
public getId(): string
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

### getAttributes

```php
public getAttributes(): array
```

***

### getStatus

The status of the backup

```php
public getStatus(): string
```

***

### getExpiresAt

Expiration date of the backup

```php
public getExpiresAt(): ?\DateTime
```

***

### getIndex

The index of this automated backup

```php
public getIndex(): ?int
```

***

### getCommitId

The ID of the code commit attached to the backup

```php
public getCommitId(): string
```

***

### getEnvironment

The environment the backup belongs to

```php
public getEnvironment(): string
```

***

### getSafe

Whether this backup was taken in a safe way

```php
public getSafe(): bool
```

***

### getSizeOfVolumes

Total size of volumes backed up

```php
public getSizeOfVolumes(): ?int
```

***

### getSizeUsed

Total size of space used on volumes backed up

```php
public getSizeUsed(): ?int
```

***

### getDeployment

The current deployment at the time of backup

```php
public getDeployment(): ?string
```

***

### getRestorable

Whether the backup is restorable

```php
public getRestorable(): bool
```

***

### getAutomated

Whether the backup is automated

```php
public getAutomated(): bool
```

***
