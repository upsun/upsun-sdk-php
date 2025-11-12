# OperationsTask

OperationTask class.

***

* Full name: `\Upsun\Core\Tasks\OperationsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\RuntimeOperationsApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\RuntimeOperationsApi $api): mixed
```

**Parameters:**

| Parameter | Type                                | Description |
|-----------|-------------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**              |             |
| `$api`    | **\Upsun\Api\RuntimeOperationsApi** |             |

***

### run

Executes a runtime operation

```php
public run(string $projectId, string $environmentId, string $deploymentId, string $service, string $operation, array $parameters): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$deploymentId`  | **string** |             |
| `$service`       | **string** |             |
| `$operation`     | **string** |             |
| `$parameters`    | **array**  |             |

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
