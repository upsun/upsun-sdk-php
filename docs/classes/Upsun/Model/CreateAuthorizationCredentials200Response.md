# CreateAuthorizationCredentials200Response

Low level CreateAuthorizationCredentials200Response (auto-generated)

***

* Full name: `\Upsun\Model\CreateAuthorizationCredentials200Response`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### redirectToUrl

```php
private ?\Upsun\Model\CreateAuthorizationCredentials200ResponseRedirectToUrl $redirectToUrl
```

***

### type

```php
private ?string $type
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\CreateAuthorizationCredentials200ResponseRedirectToUrl $redirectToUrl = null, ?string $type = null): mixed
```

**Parameters:**

| Parameter        | Type                                                                     | Description |
|------------------|--------------------------------------------------------------------------|-------------|
| `$redirectToUrl` | **?\Upsun\Model\CreateAuthorizationCredentials200ResponseRedirectToUrl** |             |
| `$type`          | **?string**                                                              |             |

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

### getRedirectToUrl

```php
public getRedirectToUrl(): ?\Upsun\Model\CreateAuthorizationCredentials200ResponseRedirectToUrl
```

***

### getType

```php
public getType(): ?string
```

***
