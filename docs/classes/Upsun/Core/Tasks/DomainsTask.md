# DomainsTask

DomainTask class.

***

* Full name: `\Upsun\Core\Tasks\DomainsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\DomainManagementApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\DomainManagementApi $api): mixed
```

**Parameters:**

| Parameter | Type                               | Description |
|-----------|------------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**             |             |
| `$api`    | **\Upsun\Api\DomainManagementApi** |             |

***

### create

Adds a project (or environment) domain

```php
public create(string $projectId, string $name, ?array $attributes = null, ?bool $isDefault = null, ?string $replacementFor = null, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$projectId`      | **string**  |             |
| `$name`           | **string**  |             |
| `$attributes`     | **?array**  |             |
| `$isDefault`      | **?bool**   |             |
| `$replacementFor` | **?string** |             |
| `$environmentId`  | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### delete

Deletes a project (or environment) domain

```php
public delete(string $projectId, string $domainId, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$domainId`      | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets a project (or environment) domain

```php
public get(string $projectId, string $domainId, ?string $environmentId = null): \Upsun\Model\Domain
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$domainId`      | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

Gets list of project (or environment) domains

```php
public list(string $projectId, ?string $environmentId = null): \Upsun\Model\Domain[]
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates a project (or environment) domain

```php
public update(string $projectId, string $domainId, ?array $attributes = null, ?bool $isDefault = null, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$domainId`      | **string**  |             |
| `$attributes`    | **?array**  |             |
| `$isDefault`     | **?bool**   |             |
| `$environmentId` | **?string** |             |

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

***
