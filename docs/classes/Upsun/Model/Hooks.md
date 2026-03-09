# Hooks

Low level Hooks (auto-generated)

***

* Full name: `\Upsun\Model\Hooks`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### build

```php
private ?string $build
```

***

### deploy

```php
private ?string $deploy
```

***

### postDeploy

```php
private ?string $postDeploy
```

***

## Methods

### __construct

```php
public __construct(?string $build, ?string $deploy, ?string $postDeploy): mixed
```

**Parameters:**

| Parameter     | Type        | Description |
|---------------|-------------|-------------|
| `$build`      | **?string** |             |
| `$deploy`     | **?string** |             |
| `$postDeploy` | **?string** |             |

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

### getBuild

```php
public getBuild(): ?string
```

***

### getDeploy

```php
public getDeploy(): ?string
```

***

### getPostDeploy

```php
public getPostDeploy(): ?string
```

***
