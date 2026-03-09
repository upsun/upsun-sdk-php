# RepositoryInformation

Low level RepositoryInformation (auto-generated)
The repository information of the project

***

* Full name: `\Upsun\Model\RepositoryInformation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### url

```php
private string $url
```

***

### clientSshKey

```php
private ?string $clientSshKey
```

***

## Methods

### __construct

```php
public __construct(string $url, ?string $clientSshKey): mixed
```

**Parameters:**

| Parameter       | Type        | Description |
|-----------------|-------------|-------------|
| `$url`          | **string**  |             |
| `$clientSshKey` | **?string** |             |

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

### getUrl

```php
public getUrl(): string
```

***

### getClientSshKey

SSH Key used to access external private repositories.

```php
public getClientSshKey(): ?string
```

***
