# SourceOperationsTask

SourceOperationTask class.

***

* Full name: `\Upsun\Core\Tasks\SourceOperationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\SourceOperationsApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\SourceOperationsApi $api): mixed
```

**Parameters:**

| Parameter | Type                               | Description |
|-----------|------------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**             |             |
| `$api`    | **\Upsun\Api\SourceOperationsApi** |             |

***

### list

Lists source operations

```php
public list(string $projectId, string $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### run

Trigger a source operation

```php
public run(string $projectId, string $environmentId, string $operation, array $variables): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$operation`     | **string** |             |
| `$variables`     | **array**  |             |

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
