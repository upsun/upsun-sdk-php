# SystemInformation

Low level SystemInformation (auto-generated)

***

* Full name: `\Upsun\Model\SystemInformation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### version

```php
private string $version
```

***

### image

```php
private string $image
```

***

### startedAt

```php
private \DateTime $startedAt
```

***

## Methods

### __construct

```php
public __construct(string $version, string $image, \DateTime $startedAt): mixed
```

**Parameters:**

| Parameter    | Type          | Description |
|--------------|---------------|-------------|
| `$version`   | **string**    |             |
| `$image`     | **string**    |             |
| `$startedAt` | **\DateTime** |             |

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

### getVersion

The version of this project server

```php
public getVersion(): string
```

***

### getImage

The image version of the project server

```php
public getImage(): string
```

***

### getStartedAt

```php
public getStartedAt(): \DateTime
```

***
