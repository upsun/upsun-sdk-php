# UpstreamConfiguration

Low level UpstreamConfiguration (auto-generated)

***

* Full name: `\Upsun\Model\UpstreamConfiguration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### socketFamily

```php
private string $socketFamily
```

***

### protocol

```php
private ?string $protocol
```

***

## Methods

### __construct

```php
public __construct(string $socketFamily, ?string $protocol): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$socketFamily` | **string**  |             |
| `$protocol`     | **?string** |             |

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

### getSocketFamily

```php
public getSocketFamily(): string
```

***

### getProtocol

```php
public getProtocol(): ?string
```

***
