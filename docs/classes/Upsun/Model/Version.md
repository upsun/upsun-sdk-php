# Version

Low level Version (auto-generated)

***

* Full name: `\Upsun\Model\Version`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private string $id
```

***

### locked

```php
private bool $locked
```

***

### routing

```php
private \Upsun\Model\Routing $routing
```

***

### commit

```php
private ?string $commit
```

***

## Methods

### __construct

```php
public __construct(string $id, bool $locked, \Upsun\Model\Routing $routing, ?string $commit): mixed
```

**Parameters:**

| Parameter  | Type                     | Description |
|------------|--------------------------|-------------|
| `$id`      | **string**               |             |
| `$locked`  | **bool**                 |             |
| `$routing` | **\Upsun\Model\Routing** |             |
| `$commit`  | **?string**              |             |

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

### getId

The identifier of Version

```php
public getId(): string
```

***

### getCommit

The SHA of the commit of this version

```php
public getCommit(): ?string
```

***

### getLocked

Whether this version is locked and cannot be modified

```php
public getLocked(): bool
```

***

### getRouting

Configuration about the traffic routed to this version

```php
public getRouting(): \Upsun\Model\Routing
```

***
