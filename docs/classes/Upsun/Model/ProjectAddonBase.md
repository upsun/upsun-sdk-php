# ProjectAddonBase

Low level ProjectAddonBase (auto-generated)

***

* Full name: `\Upsun\Model\ProjectAddonBase`
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

### type

```php
private string $type
```

***

### projectId

```php
private ?string $projectId
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

### links

```php
private ?\Upsun\Model\ProjectAddonBaseLinks $links
```

***

## Methods

### __construct

```php
public __construct(string $id, string $type, ?string $projectId = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null, ?\Upsun\Model\ProjectAddonBaseLinks $links = null): mixed
```

**Parameters:**

| Parameter    | Type                                    | Description |
|--------------|-----------------------------------------|-------------|
| `$id`        | **string**                              |             |
| `$type`      | **string**                              |             |
| `$projectId` | **?string**                             |             |
| `$createdAt` | **?\DateTime**                          |             |
| `$updatedAt` | **?\DateTime**                          |             |
| `$links`     | **?\Upsun\Model\ProjectAddonBaseLinks** |             |

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

The ID of the add-on.

```php
public getId(): string
```

***

### getType

The type of the add-on.

```php
public getType(): string
```

***

### getProjectId

The ID of the project.

```php
public getProjectId(): ?string
```

***

### getCreatedAt

The date and time when the resource was created.

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The date and time when the resource was last updated.

```php
public getUpdatedAt(): ?\DateTime
```

***

### getLinks

```php
public getLinks(): ?\Upsun\Model\ProjectAddonBaseLinks
```

***
