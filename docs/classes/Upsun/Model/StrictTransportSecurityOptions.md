# StrictTransportSecurityOptions

Low level StrictTransportSecurityOptions (auto-generated)

***

* Full name: `\Upsun\Model\StrictTransportSecurityOptions`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### enabled

```php
private ?bool $enabled
```

***

### includeSubdomains

```php
private ?bool $includeSubdomains
```

***

### preload

```php
private ?bool $preload
```

***

## Methods

### __construct

```php
public __construct(?bool $enabled, ?bool $includeSubdomains, ?bool $preload): mixed
```

**Parameters:**

| Parameter            | Type      | Description |
|----------------------|-----------|-------------|
| `$enabled`           | **?bool** |             |
| `$includeSubdomains` | **?bool** |             |
| `$preload`           | **?bool** |             |

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

Whether strict transport security is enabled or not.

```php
public getEnabled(): ?bool
```

***

### getIncludeSubdomains

Whether the strict transport security policy should include all subdomains.

```php
public getIncludeSubdomains(): ?bool
```

***

### getPreload

Whether the strict transport security policy should be preloaded in browsers.

```php
public getPreload(): ?bool
```

***
