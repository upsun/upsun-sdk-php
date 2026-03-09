# CertificatePatch

Low level CertificatePatch (auto-generated)

***

* Full name: `\Upsun\Model\CertificatePatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### chain

```php
private ?array $chain
```

***

### isInvalid

```php
private ?bool $isInvalid
```

***

## Methods

### __construct

```php
public __construct(?array $chain = [], ?bool $isInvalid = null): mixed
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$chain`     | **?array** |             |
| `$isInvalid` | **?bool**  |             |

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

### getChain

```php
public getChain(): ?array
```

***

### getIsInvalid

Whether this certificate should be skipped during provisioning

```php
public getIsInvalid(): ?bool
```

***
