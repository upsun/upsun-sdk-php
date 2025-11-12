# AddonCredential1

Low level AddonCredential1 (auto-generated)

The addon credential information (optional).

***

* Full name: `\Upsun\Model\AddonCredential1`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### addonKey

```php
private string $addonKey
```

***

### clientKey

```php
private string $clientKey
```

***

### sharedSecret

```php
private string $sharedSecret
```

***

## Methods

### __construct

```php
public __construct(string $addonKey, string $clientKey, string $sharedSecret): mixed
```

**Parameters:**

| Parameter       | Type       | Description |
|-----------------|------------|-------------|
| `$addonKey`     | **string** |             |
| `$clientKey`    | **string** |             |
| `$sharedSecret` | **string** |             |

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

### getAddonKey

The addon key (public identifier).

```php
public getAddonKey(): string
```

***

### getClientKey

The client key (public identifier).

```php
public getClientKey(): string
```

***

### getSharedSecret

The secret of the client.

```php
public getSharedSecret(): string
```

***
