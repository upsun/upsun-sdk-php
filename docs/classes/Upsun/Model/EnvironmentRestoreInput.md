# EnvironmentRestoreInput

Low level EnvironmentRestoreInput (auto-generated)

***

* Full name: `\Upsun\Model\EnvironmentRestoreInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### restoreCode

```php
private bool $restoreCode
```

***

### restoreResources

```php
private bool $restoreResources
```

***

### environmentName

```php
private ?string $environmentName
```

***

### branchFrom

```php
private ?string $branchFrom
```

***

### resources

```php
private ?\Upsun\Model\Resources6 $resources
```

***

## Methods

### __construct

```php
public __construct(bool $restoreCode, bool $restoreResources, ?string $environmentName, ?string $branchFrom, ?\Upsun\Model\Resources6 $resources): mixed
```

**Parameters:**

| Parameter           | Type                         | Description |
|---------------------|------------------------------|-------------|
| `$restoreCode`      | **bool**                     |             |
| `$restoreResources` | **bool**                     |             |
| `$environmentName`  | **?string**                  |             |
| `$branchFrom`       | **?string**                  |             |
| `$resources`        | **?\Upsun\Model\Resources6** |             |

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

### getEnvironmentName

```php
public getEnvironmentName(): ?string
```

***

### getBranchFrom

```php
public getBranchFrom(): ?string
```

***

### getRestoreCode

Whether we should restore the code or only the data

```php
public getRestoreCode(): bool
```

***

### getRestoreResources

Whether we should restore resources configuration from the backup

```php
public getRestoreResources(): bool
```

***

### getResources

```php
public getResources(): ?\Upsun\Model\Resources6
```

***
