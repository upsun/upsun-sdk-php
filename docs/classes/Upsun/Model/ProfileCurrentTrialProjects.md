# ProfileCurrentTrialProjects

Low level ProfileCurrentTrialProjects (auto-generated)

Projects active under trial

***

* Full name: `\Upsun\Model\ProfileCurrentTrialProjects`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### id

```php
private ?string $id
```

***

### name

```php
private ?string $name
```

***

### total

```php
private ?\Upsun\Model\ProfileCurrentTrialProjectsTotal $total
```

***

## Methods

### __construct

```php
public __construct(?string $id = null, ?string $name = null, ?\Upsun\Model\ProfileCurrentTrialProjectsTotal $total = null): mixed
```

**Parameters:**

| Parameter | Type                                               | Description |
|-----------|----------------------------------------------------|-------------|
| `$id`     | **?string**                                        |             |
| `$name`   | **?string**                                        |             |
| `$total`  | **?\Upsun\Model\ProfileCurrentTrialProjectsTotal** |             |

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

Trial project ID

```php
public getId(): ?string
```

***

### getName

Trial project name

```php
public getName(): ?string
```

***

### getTotal

```php
public getTotal(): ?\Upsun\Model\ProfileCurrentTrialProjectsTotal
```

***
