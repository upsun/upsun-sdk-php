# HalLinksSelf

Low level HalLinksSelf (auto-generated)
The cardinal link to the self resource.

***

* Full name: `\Upsun\Model\HalLinksSelf`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### title

```php
private ?string $title
```

***

### href

```php
private ?string $href
```

***

## Methods

### __construct

```php
public __construct(?string $title = null, ?string $href = null): mixed
```

**Parameters:**

| Parameter | Type        | Description |
|-----------|-------------|-------------|
| `$title`  | **?string** |             |
| `$href`   | **?string** |             |

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

### getTitle

Title of the link

```php
public getTitle(): ?string
```

***

### getHref

URL of the link

```php
public getHref(): ?string
```

***
