# SpecificOverridesValue

Low level SpecificOverridesValue (auto-generated)

***

* Full name: `\Upsun\Model\SpecificOverridesValue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### expires

```php
private ?string $expires
```

***

### passthru

```php
private ?string $passthru
```

***

### scripts

```php
private ?bool $scripts
```

***

### allow

```php
private ?bool $allow
```

***

### headers

```php
private ?array $headers
```

***

## Methods

### __construct

```php
public __construct(?string $expires = null, ?string $passthru = null, ?bool $scripts = null, ?bool $allow = null, ?array $headers = []): mixed
```

**Parameters:**

| Parameter   | Type        | Description |
|-------------|-------------|-------------|
| `$expires`  | **?string** |             |
| `$passthru` | **?string** |             |
| `$scripts`  | **?bool**   |             |
| `$allow`    | **?bool**   |             |
| `$headers`  | **?array**  |             |

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

### getExpires

```php
public getExpires(): ?string
```

***

### getPassthru

```php
public getPassthru(): ?string
```

***

### getScripts

```php
public getScripts(): ?bool
```

***

### getAllow

```php
public getAllow(): ?bool
```

***

### getHeaders

```php
public getHeaders(): ?array
```

***
