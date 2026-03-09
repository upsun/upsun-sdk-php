# VersionPatch

Low level VersionPatch (auto-generated)

***

* Full name: `\Upsun\Model\VersionPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### routing

```php
private ?\Upsun\Model\Routing1 $routing
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\Routing1 $routing = null): mixed
```

**Parameters:**

| Parameter  | Type                       | Description |
|------------|----------------------------|-------------|
| `$routing` | **?\Upsun\Model\Routing1** |             |

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

### getRouting

Configuration about the traffic routed to this version

```php
public getRouting(): ?\Upsun\Model\Routing1
```

***
