# UpstreamRoute

Low level UpstreamRoute (auto-generated)

***

* Full name: `\Upsun\Model\UpstreamRoute`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Route`](./Route.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant        | Visibility | Type | Value      |
|-----------------|------------|------|------------|
| `TYPE_PROXY`    | public     |      | 'proxy'    |
| `TYPE_REDIRECT` | public     |      | 'redirect' |
| `TYPE_UPSTREAM` | public     |      | 'upstream' |

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

### redirects

```php
private ?\Upsun\Model\RedirectConfiguration $redirects
```

***

### sticky

```php
private ?\Upsun\Model\StickyConfiguration $sticky
```

***

### to

```php
private ?string $to
```

***

## Methods

### __construct

```php
public __construct(array $attributes, string $type, \Upsun\Model\TLSSettings $tls, ?string $id = null, ?bool $primary = null, ?string $productionUrl = null, ?\Upsun\Model\CacheConfiguration $cache = null, ?\Upsun\Model\SSIConfiguration $ssi = null, ?string $upstream = null, ?\Upsun\Model\RedirectConfiguration $redirects = null, ?\Upsun\Model\StickyConfiguration $sticky = null, ?string $to = null): mixed
```

**Parameters:**

| Parameter        | Type                                    | Description |
|------------------|-----------------------------------------|-------------|
| `$attributes`    | **array**                               |             |
| `$type`          | **string**                              |             |
| `$tls`           | **\Upsun\Model\TLSSettings**            |             |
| `$id`            | **?string**                             |             |
| `$primary`       | **?bool**                               |             |
| `$productionUrl` | **?string**                             |             |
| `$cache`         | **?\Upsun\Model\CacheConfiguration**    |             |
| `$ssi`           | **?\Upsun\Model\SSIConfiguration**      |             |
| `$upstream`      | **?string**                             |             |
| `$redirects`     | **?\Upsun\Model\RedirectConfiguration** |             |
| `$sticky`        | **?\Upsun\Model\StickyConfiguration**   |             |
| `$to`            | **?string**                             |             |

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

### getRedirects

The configuration of the redirects.

```php
public getRedirects(): ?\Upsun\Model\RedirectConfiguration
```

***

### getSticky

Sticky routing configuration.

```php
public getSticky(): ?\Upsun\Model\StickyConfiguration
```

***

### getTo

```php
public getTo(): ?string
```

***
