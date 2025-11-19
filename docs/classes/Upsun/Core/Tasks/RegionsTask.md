# RegionsTask

RegionTask class.

***

* Full name: `\Upsun\Core\Tasks\RegionsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### api

```php
private \Upsun\Api\RegionsApi $api
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\RegionsApi $api): mixed
```

**Parameters:**

| Parameter | Type                      | Description |
|-----------|---------------------------|-------------|
| `$client` | **\Upsun\UpsunClient**    |             |
| `$api`    | **\Upsun\Api\RegionsApi** |             |

***

### get

Gets a region

```php
public get(string $regionId): \Upsun\Model\Region
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$regionId` | **string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### list

List regions

```php
public list(?array $filterAvailable = null, ?array $filterPrivate = null, ?array $filterZone = null, ?int $pageSize = null, ?string $pageBefore = null, ?string $pageAfter = null, ?string $sort = null): \Upsun\Model\ListRegions200Response
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$filterAvailable` | **?array**  |             |
| `$filterPrivate`   | **?array**  |             |
| `$filterZone`      | **?array**  |             |
| `$pageSize`        | **?int**    |             |
| `$pageBefore`      | **?string** |             |
| `$pageAfter`       | **?string** |             |
| `$sort`            | **?string** |             |

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
