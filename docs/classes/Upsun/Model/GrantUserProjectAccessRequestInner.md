# GrantUserProjectAccessRequestInner

Low level GrantUserProjectAccessRequestInner (auto-generated)

***

* Full name: `\Upsun\Model\GrantUserProjectAccessRequestInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### projectId

```php
private string $projectId
```

***

### permissions

```php
private array $permissions
```

***

## Methods

### __construct

```php
public __construct(string $projectId, array $permissions): mixed
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$permissions` | **array**  |             |

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

### getProjectId

```php
public getProjectId(): string
```

***

### getPermissions

```php
public getPermissions(): array
```

***
