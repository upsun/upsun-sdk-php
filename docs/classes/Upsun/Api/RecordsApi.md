# RecordsApi

Low level RecordsApi (auto-generated)

***

* Full name: `\Upsun\Api\RecordsApi`
* Parent class: [`\Upsun\Api\AbstractApi`](./AbstractApi.md)
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### headerSelector

```php
private \Upsun\Api\ApiHeaderSelector $headerSelector
```

***

### config

```php
private \Upsun\Api\APIConfiguration $config
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, ?\Psr\Http\Client\ClientInterface $httpClient = null, ?\Psr\Http\Message\RequestFactoryInterface $requestFactory = null, ?\Upsun\Api\APIConfiguration $config = null, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null, ?\Upsun\Api\ApiHeaderSelector $selector = null): mixed
```

**Parameters:**

| Parameter         | Type                                           | Description |
|-------------------|------------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                  |             |
| `$httpClient`     | **?\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **?\Psr\Http\Message\RequestFactoryInterface** |             |
| `$config`         | **?\Upsun\Api\APIConfiguration**               |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface**  |             |
| `$selector`       | **?\Upsun\Api\ApiHeaderSelector**              |             |

***

### listOrgPlanRecords

List plan records

```php
public listOrgPlanRecords(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterPlan = null, string|null $filterStatus = null, \DateTime|null $filterStart = null, \DateTime|null $filterEnd = null, \DateTime|null $filterStartedAt = null, \DateTime|null $filterEndedAt = null, int|null $page = null): \Upsun\Model\ListOrgPlanRecords200Response
```

Retrieves plan records for the specified organization.

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterPlan`           | **string\|null**    | The plan type of the subscription. (optional)                                                                                                                                                      |
| `$filterStatus`         | **string\|null**    | The status of the plan record. (optional)                                                                                                                                                          |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterEnd`            | **\DateTime\|null** | The end of the observation period for the record. E.g. filter[end]=2018-01-01
will display all records that were active on (i.e. they started before)
2018-01-01 (optional)                        |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$filterEndedAt`        | **\DateTime\|null** | The record's end timestamp. You can use this filter to list records ended after,
or before a certain time. E.g.
filter[ended_at][value]=2020-01-01&filter[ended_at][operator]=> (optional)         |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Records/operation/list-org-plan-records

***

### listOrgPlanRecordsWithHttpInfo

List plan records with HTTP Info

```php
private listOrgPlanRecordsWithHttpInfo(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterPlan = null, string|null $filterStatus = null, \DateTime|null $filterStart = null, \DateTime|null $filterEnd = null, \DateTime|null $filterStartedAt = null, \DateTime|null $filterEndedAt = null, int|null $page = null): \Upsun\Model\ListOrgPlanRecords200Response
```

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterPlan`           | **string\|null**    | The plan type of the subscription. (optional)                                                                                                                                                      |
| `$filterStatus`         | **string\|null**    | The status of the plan record. (optional)                                                                                                                                                          |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterEnd`            | **\DateTime\|null** | The end of the observation period for the record. E.g. filter[end]=2018-01-01
will display all records that were active on (i.e. they started before)
2018-01-01 (optional)                        |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$filterEndedAt`        | **\DateTime\|null** | The record's end timestamp. You can use this filter to list records ended after,
or before a certain time. E.g.
filter[ended_at][value]=2020-01-01&filter[ended_at][operator]=> (optional)         |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgPlanRecordsRequest

Create request for operation 'listOrgPlanRecords'

```php
private listOrgPlanRecordsRequest(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterPlan = null, string|null $filterStatus = null, \DateTime|null $filterStart = null, \DateTime|null $filterEnd = null, \DateTime|null $filterStartedAt = null, \DateTime|null $filterEndedAt = null, int|null $page = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterPlan`           | **string\|null**    | The plan type of the subscription. (optional)                                                                                                                                                      |
| `$filterStatus`         | **string\|null**    | The status of the plan record. (optional)                                                                                                                                                          |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterEnd`            | **\DateTime\|null** | The end of the observation period for the record. E.g. filter[end]=2018-01-01
will display all records that were active on (i.e. they started before)
2018-01-01 (optional)                        |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$filterEndedAt`        | **\DateTime\|null** | The record's end timestamp. You can use this filter to list records ended after,
or before a certain time. E.g.
filter[ended_at][value]=2020-01-01&filter[ended_at][operator]=> (optional)         |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgUsageRecords

List usage records

```php
public listOrgUsageRecords(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterUsageGroup = null, \DateTime|null $filterStart = null, \DateTime|null $filterStartedAt = null, int|null $page = null): \Upsun\Model\ListOrgUsageRecords200Response
```

Retrieves usage records for the specified organization.

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterUsageGroup`     | **string\|null**    | Filter records by the type of usage. (optional)                                                                                                                                                    |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Records/operation/list-org-usage-records

***

### listOrgUsageRecordsWithHttpInfo

List usage records with HTTP Info

```php
private listOrgUsageRecordsWithHttpInfo(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterUsageGroup = null, \DateTime|null $filterStart = null, \DateTime|null $filterStartedAt = null, int|null $page = null): \Upsun\Model\ListOrgUsageRecords200Response
```

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterUsageGroup`     | **string\|null**    | Filter records by the type of usage. (optional)                                                                                                                                                    |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgUsageRecordsRequest

Create request for operation 'listOrgUsageRecords'

```php
private listOrgUsageRecordsRequest(string $organizationId, string|null $filterSubscriptionId = null, string|null $filterUsageGroup = null, \DateTime|null $filterStart = null, \DateTime|null $filterStartedAt = null, int|null $page = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter               | Type                | Description                                                                                                                                                                                        |
|-------------------------|---------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`       | **string**          | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)                                                                                             |
| `$filterSubscriptionId` | **string\|null**    | The ID of the subscription (optional)                                                                                                                                                              |
| `$filterUsageGroup`     | **string\|null**    | Filter records by the type of usage. (optional)                                                                                                                                                    |
| `$filterStart`          | **\DateTime\|null** | The start of the observation period for the record. E.g.
filter[start]=2018-01-01 will display all records that were active (i.e. did not
end) on 2018-01-01 (optional)                            |
| `$filterStartedAt`      | **\DateTime\|null** | The record's start timestamp. You can use this filter to list records started
after, or before a certain time. E.g.
filter[started_at][value]=2020-01-01&filter[started_at][operator]=> (optional) |
| `$page`                 | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                                                                                                                                    |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, \Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $baseUri, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                 |             |
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$baseUri`        | **string**                                    |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface** |             |

***

### getAuthorizationHeader

```php
protected getAuthorizationHeader(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createAuthenticatedRequest

```php
protected createAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### sendAuthenticatedRequest

```php
protected sendAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\ResponseInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### refreshToken

```php
public refreshToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createRequest

Create request

```php
protected createRequest(string $method, string|\Psr\Http\Message\UriInterface $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string\|\Psr\Http\Message\UriInterface**          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

***

### createUri

```php
protected createUri(string $operationHost, string $resourcePath, array $queryParams): \Psr\Http\Message\UriInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$operationHost` | **string** |             |
| `$resourcePath`  | **string** |             |
| `$queryParams`   | **array**  |             |

***

### handleResponseWithDataType

```php
protected handleResponseWithDataType(class-string<\Upsun\Api\T>|string $dataType, \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Upsun\Api\T
```

**Parameters:**

| Parameter   | Type                                    | Description                                                       |
|-------------|-----------------------------------------|-------------------------------------------------------------------|
| `$dataType` | **class-string<\Upsun\Api\T>\|string**  | Fully-qualified class name, or scalar type like "string", "array" |
| `$request`  | **\Psr\Http\Message\RequestInterface**  |                                                                   |
| `$response` | **\Psr\Http\Message\ResponseInterface** |                                                                   |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserializeGenericArray

Deserialize generic types array<key,value>

```php
protected deserializeGenericArray(mixed $content, string $dataType, \Psr\Http\Message\RequestInterface $request): array
```

**Parameters:**

| Parameter   | Type                                   | Description |
|-------------|----------------------------------------|-------------|
| `$content`  | **mixed**                              |             |
| `$dataType` | **string**                             |             |
| `$request`  | **\Psr\Http\Message\RequestInterface** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
