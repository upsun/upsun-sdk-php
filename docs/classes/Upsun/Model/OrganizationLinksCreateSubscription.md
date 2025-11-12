# OrganizationLinksCreateSubscription

Low level OrganizationLinksCreateSubscription (auto-generated)

Link for creating a new organization subscription.

***

* Full name: `\Upsun\Model\OrganizationLinksCreateSubscription`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### href

```php
private ?string $href
```

***

### method

```php
private ?string $method
```

***

## Methods

### __construct

```php
public __construct(?string $href = null, ?string $method = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$href`   | **?string** |             |
| `$method` | **?string** |             |

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

### getHref

URL of the link.

```php
public getHref(): ?string
```

***

### getMethod

The HTTP method to use.

```php
public getMethod(): ?string
```

***
