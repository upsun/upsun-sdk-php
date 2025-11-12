# RoutesValue

Low level RoutesValue (auto-generated)

***

* Full name: `\Upsun\Model\RoutesValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### attributes

```php
private array $attributes
```

***

### type

```php
private string $type
```

***

### tls

```php
private \Upsun\Model\TLSSettings $tls
```

***

### to

```php
private ?string $to
```

***

### id

```php
private ?string $id
```

***

### primary

```php
private ?bool $primary
```

***

### productionUrl

```php
private ?string $productionUrl
```

***

### redirects

```php
private ?\Upsun\Model\RedirectConfiguration $redirects
```

***

### cache

```php
private ?\Upsun\Model\CacheConfiguration $cache
```

***

### ssi

```php
private ?\Upsun\Model\SSIConfiguration $ssi
```

***

### upstream

```php
private ?string $upstream
```

***

### sticky

```php
private ?\Upsun\Model\StickyConfiguration $sticky
```

***

## Methods

### __construct

```php
public __construct(array $attributes, string $type, \Upsun\Model\TLSSettings $tls, ?string $to, ?string $id = null, ?bool $primary = null, ?string $productionUrl = null, ?\Upsun\Model\RedirectConfiguration $redirects = null, ?\Upsun\Model\CacheConfiguration $cache = null, ?\Upsun\Model\SSIConfiguration $ssi = null, ?string $upstream = null, ?\Upsun\Model\StickyConfiguration $sticky = null): mixed
```

**Parameters:**

| Parameter        | Type                                    | Description |
|------------------|-----------------------------------------|-------------|
| `$attributes`    | **array**                               |             |
| `$type`          | **string**                              |             |
| `$tls`           | **\Upsun\Model\TLSSettings**            |             |
| `$to`            | **?string**                             |             |
| `$id`            | **?string**                             |             |
| `$primary`       | **?bool**                               |             |
| `$productionUrl` | **?string**                             |             |
| `$redirects`     | **?\Upsun\Model\RedirectConfiguration** |             |
| `$cache`         | **?\Upsun\Model\CacheConfiguration**    |             |
| `$ssi`           | **?\Upsun\Model\SSIConfiguration**      |             |
| `$upstream`      | **?string**                             |             |
| `$sticky`        | **?\Upsun\Model\StickyConfiguration**   |             |

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

### getAttributes

```php
public getAttributes(): array
```

***

### getType

Route type.

```php
public getType(): string
```

***

### getTls

TLS settings for the route.

```php
public getTls(): \Upsun\Model\TLSSettings
```

***

### getTo

```php
public getTo(): ?string
```

***

### getId

The identifier of UpstreamRoute

```php
public getId(): ?string
```

***

### getPrimary

This route is the primary route of the environment

```php
public getPrimary(): ?bool
```

***

### getProductionUrl

How this URL route would look on production environment

```php
public getProductionUrl(): ?string
```

***

### getRedirects

The configuration of the redirects.

```php
public getRedirects(): ?\Upsun\Model\RedirectConfiguration
```

***

### getCache

Cache configuration.

```php
public getCache(): ?\Upsun\Model\CacheConfiguration
```

***

### getSsi

Server-Side Include configuration.

```php
public getSsi(): ?\Upsun\Model\SSIConfiguration
```

***

### getUpstream

The upstream to use for this route.

```php
public getUpstream(): ?string
```

***

### getSticky

Sticky routing configuration.

```php
public getSticky(): ?\Upsun\Model\StickyConfiguration
```

***
