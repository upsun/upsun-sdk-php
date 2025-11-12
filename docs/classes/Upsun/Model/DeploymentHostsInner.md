# DeploymentHostsInner

Low level DeploymentHostsInner (auto-generated)

***

* Full name: `\Upsun\Model\DeploymentHostsInner`
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

### id

```php
private ?string $id
```

***

### services

```php
private ?array $services
```

***

## Methods

### __construct

```php
public __construct(string $type, ?string $id, ?array $services = []): mixed
```

**Parameters:**

| Parameter   | Type        | Description |
|-------------|-------------|-------------|
| `$type`     | **string**  |             |
| `$id`       | **?string** |             |
| `$services` | **?array**  |             |

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
public getId(): ?string
```

***

### getType

```php
public getType(): string
```

***

### getServices

```php
public getServices(): ?array
```

***
