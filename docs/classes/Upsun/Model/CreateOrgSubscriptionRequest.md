# CreateOrgSubscriptionRequest

Low level CreateOrgSubscriptionRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateOrgSubscriptionRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### projectRegion

```php
private string $projectRegion
```

***

### plan

```php
private ?string $plan
```

***

### projectTitle

```php
private ?string $projectTitle
```

***

### optionsUrl

```php
private ?string $optionsUrl
```

***

### defaultBranch

```php
private ?string $defaultBranch
```

***

### environments

```php
private ?int $environments
```

***

### storage

```php
private ?int $storage
```

***

## Methods

### __construct

```php
public __construct(string $projectRegion, ?string $plan = null, ?string $projectTitle = null, ?string $optionsUrl = null, ?string $defaultBranch = null, ?int $environments = null, ?int $storage = null): mixed
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectRegion` | **string**  |             |
| `$plan`          | **?string** |             |
| `$projectTitle`  | **?string** |             |
| `$optionsUrl`    | **?string** |             |
| `$defaultBranch` | **?string** |             |
| `$environments`  | **?int**    |             |
| `$storage`       | **?int**    |             |

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

### getProjectRegion

```php
public getProjectRegion(): string
```

***

### getPlan

The project plan.

```php
public getPlan(): ?string
```

***

### getProjectTitle

```php
public getProjectTitle(): ?string
```

***

### getOptionsUrl

```php
public getOptionsUrl(): ?string
```

***

### getDefaultBranch

```php
public getDefaultBranch(): ?string
```

***

### getEnvironments

```php
public getEnvironments(): ?int
```

***

### getStorage

```php
public getStorage(): ?int
```

***
