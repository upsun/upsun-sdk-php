# Commit

Low level Commit (auto-generated)

***

* Full name: `\Upsun\Model\Commit`
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

### author

```php
private \Upsun\Model\Author $author
```

***

### committer

```php
private \Upsun\Model\Committer $committer
```

***

### message

```php
private string $message
```

***

### tree

```php
private string $tree
```

***

### parents

```php
private array $parents
```

***

## Methods

### __construct

```php
public __construct(string $id, string $sha, \Upsun\Model\Author $author, \Upsun\Model\Committer $committer, string $message, string $tree, array $parents): mixed
```

**Parameters:**

| Parameter    | Type                       | Description |
|--------------|----------------------------|-------------|
| `$id`        | **string**                 |             |
| `$sha`       | **string**                 |             |
| `$author`    | **\Upsun\Model\Author**    |             |
| `$committer` | **\Upsun\Model\Committer** |             |
| `$message`   | **string**                 |             |
| `$tree`      | **string**                 |             |
| `$parents`   | **array**                  |             |

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

The identifier of Commit

```php
public getId(): string
```

***

### getSha

The identifier of the commit

```php
public getSha(): string
```

***

### getAuthor

The information about the author

```php
public getAuthor(): \Upsun\Model\Author
```

***

### getCommitter

The information about the committer

```php
public getCommitter(): \Upsun\Model\Committer
```

***

### getMessage

The commit message

```php
public getMessage(): string
```

***

### getTree

The identifier of the tree

```php
public getTree(): string
```

***

### getParents

```php
public getParents(): array
```

***
