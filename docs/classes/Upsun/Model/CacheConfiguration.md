# CacheConfiguration

Low level CacheConfiguration (auto-generated)
Cache configuration.

***

* Full name: `\Upsun\Model\CacheConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private bool $enabled
```

***

### defaultTtl

```php
private int $defaultTtl
```

***

### cookies

```php
private array $cookies
```

***

### headers

```php
private array $headers
```

***

## Methods

### __construct

```php
public __construct(bool $enabled, int $defaultTtl, array $cookies, array $headers): mixed
```

**Parameters:**

| Parameter     | Type      | Description |
|---------------|-----------|-------------|
| `$enabled`    | **bool**  |             |
| `$defaultTtl` | **int**   |             |
| `$cookies`    | **array** |             |
| `$headers`    | **array** |             |

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

### getEnabled

Whether the cache is enabled.

```php
public getEnabled(): bool
```

***

### getDefaultTtl

The TTL to apply when the response doesn't specify one. Only applies to static files.

```php
public getDefaultTtl(): int
```

***

### getCookies

```php
public getCookies(): array
```

***

### getHeaders

```php
public getHeaders(): array
```

***
