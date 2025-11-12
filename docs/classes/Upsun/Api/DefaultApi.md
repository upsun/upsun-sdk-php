# DefaultApi

Low level DefaultApi (auto-generated)

***

* Full name: `\Upsun\Api\DefaultApi`
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

### listTickets

List support tickets

```php
public listTickets(int|null $filterTicketId = null, \DateTime|null $filterCreated = null, \DateTime|null $filterUpdated = null, string|null $filterType = null, string|null $filterPriority = null, string|null $filterStatus = null, string|null $filterRequesterId = null, string|null $filterSubmitterId = null, string|null $filterAssigneeId = null, bool|null $filterHasIncidents = null, \DateTime|null $filterDue = null, string|null $search = null, int|null $page = null): \Upsun\Model\ListTickets200Response
```

**Parameters:**

| Parameter             | Type                | Description                                                                       |
|-----------------------|---------------------|-----------------------------------------------------------------------------------|
| `$filterTicketId`     | **int\|null**       | The ID of the ticket. (optional)                                                  |
| `$filterCreated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was created. (optional) |
| `$filterUpdated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was updated. (optional) |
| `$filterType`         | **string\|null**    | The type of the support ticket. (optional)                                        |
| `$filterPriority`     | **string\|null**    | The priority of the support ticket. (optional)                                    |
| `$filterStatus`       | **string\|null**    | The status of the support ticket. (optional)                                      |
| `$filterRequesterId`  | **string\|null**    | UUID of the ticket requester. Converted from the ZID value. (optional)            |
| `$filterSubmitterId`  | **string\|null**    | UUID of the ticket submitter. Converted from the ZID value. (optional)            |
| `$filterAssigneeId`   | **string\|null**    | UUID of the ticket assignee. Converted from the ZID value. (optional)             |
| `$filterHasIncidents` | **bool\|null**      | Whether or not this ticket has incidents. (optional)                              |
| `$filterDue`          | **\DateTime\|null** | ISO dateformat expected. A time that the ticket is due at. (optional)             |
| `$search`             | **string\|null**    | Search string for the ticket subject and description. (optional)                  |
| `$page`               | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag//operation/list-tickets

***

### listTicketsWithHttpInfo

List support tickets with HTTP Info

```php
private listTicketsWithHttpInfo(int|null $filterTicketId = null, \DateTime|null $filterCreated = null, \DateTime|null $filterUpdated = null, string|null $filterType = null, string|null $filterPriority = null, string|null $filterStatus = null, string|null $filterRequesterId = null, string|null $filterSubmitterId = null, string|null $filterAssigneeId = null, bool|null $filterHasIncidents = null, \DateTime|null $filterDue = null, string|null $search = null, int|null $page = null): \Upsun\Model\ListTickets200Response
```

**Parameters:**

| Parameter             | Type                | Description                                                                       |
|-----------------------|---------------------|-----------------------------------------------------------------------------------|
| `$filterTicketId`     | **int\|null**       | The ID of the ticket. (optional)                                                  |
| `$filterCreated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was created. (optional) |
| `$filterUpdated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was updated. (optional) |
| `$filterType`         | **string\|null**    | The type of the support ticket. (optional)                                        |
| `$filterPriority`     | **string\|null**    | The priority of the support ticket. (optional)                                    |
| `$filterStatus`       | **string\|null**    | The status of the support ticket. (optional)                                      |
| `$filterRequesterId`  | **string\|null**    | UUID of the ticket requester. Converted from the ZID value. (optional)            |
| `$filterSubmitterId`  | **string\|null**    | UUID of the ticket submitter. Converted from the ZID value. (optional)            |
| `$filterAssigneeId`   | **string\|null**    | UUID of the ticket assignee. Converted from the ZID value. (optional)             |
| `$filterHasIncidents` | **bool\|null**      | Whether or not this ticket has incidents. (optional)                              |
| `$filterDue`          | **\DateTime\|null** | ISO dateformat expected. A time that the ticket is due at. (optional)             |
| `$search`             | **string\|null**    | Search string for the ticket subject and description. (optional)                  |
| `$page`               | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                   |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTicketsRequest

Create request for operation 'listTickets'

```php
private listTicketsRequest(int|null $filterTicketId = null, \DateTime|null $filterCreated = null, \DateTime|null $filterUpdated = null, string|null $filterType = null, string|null $filterPriority = null, string|null $filterStatus = null, string|null $filterRequesterId = null, string|null $filterSubmitterId = null, string|null $filterAssigneeId = null, bool|null $filterHasIncidents = null, \DateTime|null $filterDue = null, string|null $search = null, int|null $page = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                | Description                                                                       |
|-----------------------|---------------------|-----------------------------------------------------------------------------------|
| `$filterTicketId`     | **int\|null**       | The ID of the ticket. (optional)                                                  |
| `$filterCreated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was created. (optional) |
| `$filterUpdated`      | **\DateTime\|null** | ISO dateformat expected. The time when the support ticket was updated. (optional) |
| `$filterType`         | **string\|null**    | The type of the support ticket. (optional)                                        |
| `$filterPriority`     | **string\|null**    | The priority of the support ticket. (optional)                                    |
| `$filterStatus`       | **string\|null**    | The status of the support ticket. (optional)                                      |
| `$filterRequesterId`  | **string\|null**    | UUID of the ticket requester. Converted from the ZID value. (optional)            |
| `$filterSubmitterId`  | **string\|null**    | UUID of the ticket submitter. Converted from the ZID value. (optional)            |
| `$filterAssigneeId`   | **string\|null**    | UUID of the ticket assignee. Converted from the ZID value. (optional)             |
| `$filterHasIncidents` | **bool\|null**      | Whether or not this ticket has incidents. (optional)                              |
| `$filterDue`          | **\DateTime\|null** | ISO dateformat expected. A time that the ticket is due at. (optional)             |
| `$search`             | **string\|null**    | Search string for the ticket subject and description. (optional)                  |
| `$page`               | **int\|null**       | Page to be displayed. Defaults to 1. (optional)                                   |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### queryOrganiationCarbon

Query project carbon emissions metrics for an entire organization

```php
public queryOrganiationCarbon(string $organizationId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Upsun\Model\OrganizationCarbon
```

Queries the carbon emission data for all projects owned by the specified organiation.

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the query. Exclusive. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag//operation/query-organiation-carbon

***

### queryOrganiationCarbonWithHttpInfo

Query project carbon emissions metrics for an entire organization with HTTP Info

```php
private queryOrganiationCarbonWithHttpInfo(string $organizationId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Upsun\Model\OrganizationCarbon
```

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the query. Exclusive. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### queryOrganiationCarbonRequest

Create request for operation 'queryOrganiationCarbon'

```php
private queryOrganiationCarbonRequest(string $organizationId, \Upsun\Model\DateTimeFilter|null $from = null, \Upsun\Model\DateTimeFilter|null $to = null, string|null $interval = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type                                  | Description                                                                                                |
|-------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**                            | The ID of the organization. (required)                                                                     |
| `$from`           | **\Upsun\Model\DateTimeFilter\|null** | The start of the time frame for the query. Inclusive. (optional)                                           |
| `$to`             | **\Upsun\Model\DateTimeFilter\|null** | The end of the time frame for the query. Exclusive. (optional)                                             |
| `$interval`       | **string\|null**                      | The interval by which the query groups the results. of the time frame for the query. Exclusive. (optional) |

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
