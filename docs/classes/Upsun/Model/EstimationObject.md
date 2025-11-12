# EstimationObject

Low level EstimationObject (auto-generated)

A price estimate object.

***

* Full name: `\Upsun\Model\EstimationObject`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### plan

```php
private ?string $plan
```

***

### userLicenses

```php
private ?string $userLicenses
```

***

### environments

```php
private ?string $environments
```

***

### storage

```php
private ?string $storage
```

***

### total

```php
private ?string $total
```

***

### options

```php
private ?object $options
```

***

## Methods

### __construct

```php
public __construct(?string $plan = null, ?string $userLicenses = null, ?string $environments = null, ?string $storage = null, ?string $total = null, ?object $options = null): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$plan`         | **?string** |             |
| `$userLicenses` | **?string** |             |
| `$environments` | **?string** |             |
| `$storage`      | **?string** |             |
| `$total`        | **?string** |             |
| `$options`      | **?object** |             |

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

### getPlan

The monthly price of the plan.

```php
public getPlan(): ?string
```

***

### getUserLicenses

The monthly price of the user licenses.

```php
public getUserLicenses(): ?string
```

***

### getEnvironments

The monthly price of the environments.

```php
public getEnvironments(): ?string
```

***

### getStorage

The monthly price of the storage.

```php
public getStorage(): ?string
```

***

### getTotal

The total monthly price.

```php
public getTotal(): ?string
```

***

### getOptions

The unit prices of the options.

```php
public getOptions(): ?object
```

***
