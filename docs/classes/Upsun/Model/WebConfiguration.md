# WebConfiguration

Low level WebConfiguration (auto-generated)

***

* Full name: `\Upsun\Model\WebConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### locations

```php
private array $locations
```

***

### moveToRoot

```php
private bool $moveToRoot
```

***

### documentRoot

```php
private ?string $documentRoot
```

***

### passthru

```php
private ?string $passthru
```

***

### indexFiles

```php
private ?array $indexFiles
```

***

### whitelist

```php
private ?array $whitelist
```

***

### blacklist

```php
private ?array $blacklist
```

***

### expires

```php
private ?string $expires
```

***

### commands

```php
private ?\Upsun\Model\Commands1 $commands
```

***

### upstream

```php
private ?\Upsun\Model\UpstreamConfiguration $upstream
```

***

## Methods

### __construct

```php
public __construct(array $locations, bool $moveToRoot, ?string $documentRoot = null, ?string $passthru = null, ?array $indexFiles = [], ?array $whitelist = [], ?array $blacklist = [], ?string $expires = null, ?\Upsun\Model\Commands1 $commands = null, ?\Upsun\Model\UpstreamConfiguration $upstream = null): mixed
```

**Parameters:**

| Parameter       | Type                                    | Description |
|-----------------|-----------------------------------------|-------------|
| `$locations`    | **array**                               |             |
| `$moveToRoot`   | **bool**                                |             |
| `$documentRoot` | **?string**                             |             |
| `$passthru`     | **?string**                             |             |
| `$indexFiles`   | **?array**                              |             |
| `$whitelist`    | **?array**                              |             |
| `$blacklist`    | **?array**                              |             |
| `$expires`      | **?string**                             |             |
| `$commands`     | **?\Upsun\Model\Commands1**             |             |
| `$upstream`     | **?\Upsun\Model\UpstreamConfiguration** |             |

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

### getLocations

```php
public getLocations(): \Upsun\Model\WebLocationsValue[]
```

***

### getMoveToRoot

```php
public getMoveToRoot(): bool
```

***

### getCommands

```php
public getCommands(): ?\Upsun\Model\Commands1
```

***

### getUpstream

```php
public getUpstream(): ?\Upsun\Model\UpstreamConfiguration
```

***

### getDocumentRoot

```php
public getDocumentRoot(): ?string
```

***

### getPassthru

```php
public getPassthru(): ?string
```

***

### getIndexFiles

```php
public getIndexFiles(): ?array
```

***

### getWhitelist

```php
public getWhitelist(): ?array
```

***

### getBlacklist

```php
public getBlacklist(): ?array
```

***

### getExpires

```php
public getExpires(): ?string
```

***
