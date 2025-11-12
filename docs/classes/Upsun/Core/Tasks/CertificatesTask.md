# CertificatesTask

CertificateTask class.

***

* Full name: `\Upsun\Core\Tasks\CertificatesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\CertManagementApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\CertManagementApi $api): mixed
```

**Parameters:**

| Parameter | Type                             | Description |
|-----------|----------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**           |             |
| `$api`    | **\Upsun\Api\CertManagementApi** |             |

***

### create

Adds an SSL certificate

```php
public create(string $projectId, string $certificate, string $key, ?array $chain = null, ?bool $isInvalid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter      | Type       | Description |
|----------------|------------|-------------|
| `$projectId`   | **string** |             |
| `$certificate` | **string** |             |
| `$key`         | **string** |             |
| `$chain`       | **?array** |             |
| `$isInvalid`   | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### delete

Deletes an SSL certificate

```php
public delete(string $projectId, string $certificateId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets an SSL certificate

```php
public get(string $projectId, string $certificateId): \Upsun\Model\Certificate
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

Gets list of SSL certificates

```php
public list(string $projectId): \Upsun\Model\Certificate[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


***

### update

Updates an SSL certificate

```php
public update(string $projectId, string $certificateId, ?array $chain = null, ?bool $isInvalid = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |
| `$chain`         | **?array** |             |
| `$isInvalid`     | **?bool**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client): mixed
```

**Parameters:**

| Parameter | Type                   | Description |
|-----------|------------------------|-------------|
| `$client` | **\Upsun\UpsunClient** |             |

***

### normalizeFilter

```php
protected normalizeFilter(array|string|int|\DateTime|null $value): array
```

**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **array\|string\|int\|\DateTime\|null** |             |

***

### extractSubscriptionId

Get SubscriptionId of a Project Licence Uri

```php
protected extractSubscriptionId(string $projectLicenceUri): string
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectLicenceUri` | **string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***
