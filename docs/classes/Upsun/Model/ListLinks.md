# ListLinks

Low level ListLinks (auto-generated)

***

* Full name: `\Upsun\Model\ListLinks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### self

```php
private ?\Upsun\Model\Link $self
```

***

### previous

```php
private ?\Upsun\Model\Link $previous
```

***

### next

```php
private ?\Upsun\Model\Link $next
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\Link $self = null, ?\Upsun\Model\Link $previous = null, ?\Upsun\Model\Link $next = null): mixed
```

**Parameters:**

| Parameter   | Type                   | Description |
|-------------|------------------------|-------------|
| `$self`     | **?\Upsun\Model\Link** |             |
| `$previous` | **?\Upsun\Model\Link** |             |
| `$next`     | **?\Upsun\Model\Link** |             |

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

A hypermedia link to the {current, next, previous} set of items.

```php
public getSelf(): ?\Upsun\Model\Link
```

***

### getPrevious

A hypermedia link to the {current, next, previous} set of items.

```php
public getPrevious(): ?\Upsun\Model\Link
```

***

### getNext

A hypermedia link to the {current, next, previous} set of items.

```php
public getNext(): ?\Upsun\Model\Link
```

***
