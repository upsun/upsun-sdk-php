# RedirectConfiguration

Low level RedirectConfiguration (auto-generated)
The configuration of the redirects.

***

* Full name: `\Upsun\Model\RedirectConfiguration`
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

### paths

```php
private array $paths
```

***

## Methods

### __construct

```php
public __construct(string $expires, array $paths): mixed
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$expires` | **string** |             |
| `$paths`   | **array**  |             |

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

The amount of time, in seconds, to cache the redirects.

```php
public getExpires(): string
```

***

### getPaths

The paths to redirect

```php
public getPaths(): \Upsun\Model\PathValue[]
```

***
