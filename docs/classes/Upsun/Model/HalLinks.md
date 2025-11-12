# HalLinks

Low level HalLinks (auto-generated)

Links to _self, and previous or next page, given that they exist.

***

* Full name: `\Upsun\Model\HalLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\HalLinksSelf $self
```

***

### previous

```php
private ?\Upsun\Model\HalLinksPrevious $previous
```

***

### next

```php
private ?\Upsun\Model\HalLinksNext $next
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\HalLinksSelf $self = null, ?\Upsun\Model\HalLinksPrevious $previous = null, ?\Upsun\Model\HalLinksNext $next = null): mixed
```

**Parameters:**

| Parameter   | Type                               | Description |
|-------------|------------------------------------|-------------|
| `$self`     | **?\Upsun\Model\HalLinksSelf**     |             |
| `$previous` | **?\Upsun\Model\HalLinksPrevious** |             |
| `$next`     | **?\Upsun\Model\HalLinksNext**     |             |

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

### getSelf

The cardinal link to the self resource.

```php
public getSelf(): ?\Upsun\Model\HalLinksSelf
```

***

### getPrevious

The link to the previous resource page, given that it exists.

```php
public getPrevious(): ?\Upsun\Model\HalLinksPrevious
```

***

### getNext

The link to the next resource page, given that it exists.

```php
public getNext(): ?\Upsun\Model\HalLinksNext
```

***
