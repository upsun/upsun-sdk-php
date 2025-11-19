# MergeInfo

Low level MergeInfo (auto-generated)
The commit distance info between parent and child environments

***

* Full name: `\Upsun\Model\MergeInfo`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### commitsAhead

```php
private ?int $commitsAhead
```

***

### commitsBehind

```php
private ?int $commitsBehind
```

***

### parentRef

```php
private ?string $parentRef
```

***

## Methods

### __construct

```php
public __construct(?int $commitsAhead, ?int $commitsBehind, ?string $parentRef): mixed
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$commitsAhead`  | **?int**    |             |
| `$commitsBehind` | **?int**    |             |
| `$parentRef`     | **?string** |             |

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

### getCommitsAhead

The amount of commits that are in the environment but not in the parent

```php
public getCommitsAhead(): ?int
```

***

### getCommitsBehind

The amount of commits that are in the parent but not in the environment

```php
public getCommitsBehind(): ?int
```

***

### getParentRef

The reference in Git for the parent environment

```php
public getParentRef(): ?string
```

***
