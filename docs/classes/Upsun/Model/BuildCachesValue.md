# BuildCachesValue

Low level BuildCachesValue (auto-generated)

***

* Full name: `\Upsun\Model\BuildCachesValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### watch

```php
private array $watch
```

***

### allowStale

```php
private bool $allowStale
```

***

### shareBetweenApps

```php
private bool $shareBetweenApps
```

***

### directory

```php
private ?string $directory
```

***

## Methods

### __construct

```php
public __construct(array $watch, bool $allowStale, bool $shareBetweenApps, ?string $directory): mixed
```

**Parameters:**

| Parameter           | Type        | Description |
|---------------------|-------------|-------------|
| `$watch`            | **array**   |             |
| `$allowStale`       | **bool**    |             |
| `$shareBetweenApps` | **bool**    |             |
| `$directory`        | **?string** |             |

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

### getDirectory

```php
public getDirectory(): ?string
```

***

### getWatch

```php
public getWatch(): array
```

***

### getAllowStale

```php
public getAllowStale(): bool
```

***

### getShareBetweenApps

```php
public getShareBetweenApps(): bool
```

***
