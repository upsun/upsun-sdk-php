# ActivitiesTask

ActivitiesTask class.

***

* Full name: `\Upsun\Core\Tasks\ActivitiesTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### prjApi

```php
private \Upsun\Api\ProjectActivityApi $prjApi
```

***

### envApi

```php
private \Upsun\Api\EnvironmentActivityApi $envApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\ProjectActivityApi $prjApi, \Upsun\Api\EnvironmentActivityApi $envApi): mixed
```

**Parameters:**

| Parameter | Type                                  | Description |
|-----------|---------------------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**                |             |
| `$prjApi` | **\Upsun\Api\ProjectActivityApi**     |             |
| `$envApi` | **\Upsun\Api\EnvironmentActivityApi** |             |

***

### cancel

Cancels a project (or environment) activity

```php
public cancel(string $projectId, string $activityId, ?string $environmentId = null): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$activityId`    | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### get

Gets a project (or environment) activity log entry

```php
public get(string $projectId, string $activityId, ?string $environmentId = null): \Upsun\Model\Activity
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$activityId`    | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

Gets project (or environment) activity log

```php
public list(string $projectId, ?string $environmentId = null): \Upsun\Model\Activity[]
```

**Parameters:**

| Parameter        | Type        | Description |
|------------------|-------------|-------------|
| `$projectId`     | **string**  |             |
| `$environmentId` | **?string** |             |

**Throws:**

- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 
- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format


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
