# Tree

Low level Tree (auto-generated)

***

* Full name: `\Upsun\Model\Tree`
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

### sha

```php
private string $sha
```

***

### tree

```php
private array $tree
```

***

## Methods

### __construct

```php
public __construct(string $id, string $sha, array $tree): mixed
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$id`     | **string** |             |
| `$sha`    | **string** |             |
| `$tree`   | **array**  |             |

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

The identifier of Tree

```php
public getId(): string
```

***

### getSha

The identifier of the tree

```php
public getSha(): string
```

***

### getTree

The tree items

```php
public getTree(): \Upsun\Model\TreeItemsInner[]
```

***
