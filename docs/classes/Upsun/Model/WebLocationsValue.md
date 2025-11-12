# WebLocationsValue

Low level WebLocationsValue (auto-generated)

***

* Full name: `\Upsun\Model\WebLocationsValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### expires

```php
private string $expires
```

***

### passthru

```php
private string $passthru
```

***

### scripts

```php
private bool $scripts
```

***

### allow

```php
private bool $allow
```

***

### headers

```php
private array $headers
```

***

### rules

```php
private array $rules
```

***

### root

```php
private ?string $root
```

***

### index

```php
private ?array $index
```

***

### requestBuffering

```php
private ?\Upsun\Model\RequestBuffering $requestBuffering
```

***

## Methods

### __construct

```php
public __construct(string $expires, string $passthru, bool $scripts, bool $allow, array $headers, array $rules, ?string $root, ?array $index = [], ?\Upsun\Model\RequestBuffering $requestBuffering = null): mixed
```

**Parameters:**

| Parameter           | Type                               | Description |
|---------------------|------------------------------------|-------------|
| `$expires`          | **string**                         |             |
| `$passthru`         | **string**                         |             |
| `$scripts`          | **bool**                           |             |
| `$allow`            | **bool**                           |             |
| `$headers`          | **array**                          |             |
| `$rules`            | **array**                          |             |
| `$root`             | **?string**                        |             |
| `$index`            | **?array**                         |             |
| `$requestBuffering` | **?\Upsun\Model\RequestBuffering** |             |

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

### getRoot

```php
public getRoot(): ?string
```

***

### getExpires

```php
public getExpires(): string
```

***

### getPassthru

```php
public getPassthru(): string
```

***

### getScripts

```php
public getScripts(): bool
```

***

### getAllow

```php
public getAllow(): bool
```

***

### getHeaders

```php
public getHeaders(): array
```

***

### getRules

```php
public getRules(): \Upsun\Model\SpecificOverridesValue[]
```

***

### getIndex

```php
public getIndex(): ?array
```

***

### getRequestBuffering

```php
public getRequestBuffering(): ?\Upsun\Model\RequestBuffering
```

***
