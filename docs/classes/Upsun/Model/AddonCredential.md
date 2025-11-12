# AddonCredential

Low level AddonCredential (auto-generated)

The addon credential information (optional).

***

* Full name: `\Upsun\Model\AddonCredential`
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

## Methods

### __construct

```php
public __construct(string $addonKey, string $clientKey): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$addonKey`  | **string** |             |
| `$clientKey` | **string** |             |

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
