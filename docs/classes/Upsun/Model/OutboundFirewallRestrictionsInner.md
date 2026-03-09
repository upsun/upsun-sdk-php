# OutboundFirewallRestrictionsInner

Low level OutboundFirewallRestrictionsInner (auto-generated)

***

* Full name: `\Upsun\Model\OutboundFirewallRestrictionsInner`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant       | Visibility | Type | Value |
|----------------|------------|------|-------|
| `PROTOCOL_TCP` | public     |      | 'tcp' |

## Properties

### protocol

```php
private string $protocol
```

***

### ips

```php
private array $ips
```

***

### domains

```php
private array $domains
```

***

### ports

```php
private array $ports
```

***

## Methods

### __construct

```php
public __construct(string $protocol, array $ips, array $domains, array $ports): mixed
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$protocol` | **string** |             |
| `$ips`      | **array**  |             |
| `$domains`  | **array**  |             |
| `$ports`    | **array**  |             |

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

### getProtocol

```php
public getProtocol(): string
```

***

### getIps

```php
public getIps(): array
```

***

### getDomains

```php
public getDomains(): array
```

***

### getPorts

```php
public getPorts(): array
```

***
