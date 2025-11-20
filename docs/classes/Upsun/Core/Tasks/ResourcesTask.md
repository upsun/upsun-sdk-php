# ResourcesTask

ResourcesTask class.

***

* Full name: `\Upsun\Core\Tasks\ResourcesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\DeploymentApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\DeploymentApi $api): mixed
```

**Parameters:**

| Parameter | Type                         | Description |
|-----------|------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**       |             |
| `$api`    | **\Upsun\Api\DeploymentApi** |             |

***

### update

Update resources for a deployment

```php
public update(string $projectId, string $environmentId, ?array $webapps = [], null|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}> $services = [], null|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}> $workers = []): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                                                                                                      | Description |
|------------------|-----------------------------------------------------------------------------------------------------------|-------------|
| `$projectId`     | **string**                                                                                                |             |
| `$environmentId` | **string**                                                                                                |             |
| `$webapps`       | **?array**                                                                                                |             |
| `$services`      | **null\|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}>** |             |
| `$workers`       | **null\|array<string,array{resources?: array{profile_size?: string}, disk?: int, instance_count?: int}>** |             |

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
