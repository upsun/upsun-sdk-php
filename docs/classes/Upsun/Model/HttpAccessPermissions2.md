# HttpAccessPermissions2

Low level HttpAccessPermissions2 (auto-generated)

The Http access permissions for this environment

***

* Full name: `\Upsun\Model\HttpAccessPermissions2`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### isEnabled

```php
private ?bool $isEnabled
```

***

### addresses

```php
private ?array $addresses
```

***

### basicAuth

```php
private ?array $basicAuth
```

***

## Methods

### __construct

```php
public __construct(?bool $isEnabled = null, ?array $addresses = [], ?array $basicAuth = []): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$isEnabled` | **?bool**  |             |
| `$addresses` | **?array** |             |
| `$basicAuth` | **?array** |             |

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

### getIsEnabled

Whether http_access control is enabled

```php
public getIsEnabled(): ?bool
```

***

### getAddresses

```php
public getAddresses(): \Upsun\Model\AddressGrantsInner[]|null
```

***

### getBasicAuth

```php
public getBasicAuth(): ?array
```

***
