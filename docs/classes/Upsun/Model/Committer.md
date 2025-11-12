# Committer

Low level Committer (auto-generated)

The information about the committer

***

* Full name: `\Upsun\Model\Committer`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### date

```php
private \DateTime $date
```

***

### name

```php
private string $name
```

***

### email

```php
private string $email
```

***

## Methods

### __construct

```php
public __construct(\DateTime $date, string $name, string $email): mixed
```

**Parameters:**

| Parameter | Type          | Description |
|-----------|---------------|-------------|
| `$date`   | **\DateTime** |             |
| `$name`   | **string**    |             |
| `$email`  | **string**    |             |

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

### getDate

The time of the author or committer

```php
public getDate(): \DateTime
```

***

### getName

The name of the author or committer

```php
public getName(): string
```

***

### getEmail

The email of the author or committer

```php
public getEmail(): string
```

***
