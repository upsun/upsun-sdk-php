# SupportApi

Low level SupportApi (auto-generated)

***

* Full name: `\Upsun\Api\SupportApi`
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

### createTicket

Create a new support ticket

```php
public createTicket(?\Upsun\Model\CreateTicketRequest $createTicketRequest = null): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter              | Type                                  | Description |
|------------------------|---------------------------------------|-------------|
| `$createTicketRequest` | **?\Upsun\Model\CreateTicketRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Support/operation/create-ticket

***

### createTicketWithHttpInfo

Create a new support ticket with HTTP Info

```php
private createTicketWithHttpInfo(?\Upsun\Model\CreateTicketRequest $createTicketRequest = null): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter              | Type                                  | Description |
|------------------------|---------------------------------------|-------------|
| `$createTicketRequest` | **?\Upsun\Model\CreateTicketRequest** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createTicketRequest

Create request for operation 'createTicket'

```php
private createTicketRequest(?\Upsun\Model\CreateTicketRequest $createTicketRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter              | Type                                  | Description |
|------------------------|---------------------------------------|-------------|
| `$createTicketRequest` | **?\Upsun\Model\CreateTicketRequest** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listTicketCategories

List support ticket categories

```php
public listTicketCategories(string|null $subscriptionId = null, string|null $organizationId = null): \Upsun\Model\ListTicketCategories200ResponseInner[]
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$organizationId` | **string\|null** | The ID of the organization the ticket should be related to (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Support/operation/list-ticket-categories

***

### listTicketCategoriesWithHttpInfo

List support ticket categories with HTTP Info

```php
private listTicketCategoriesWithHttpInfo(string|null $subscriptionId = null, string|null $organizationId = null): \Upsun\Model\ListTicketCategories200ResponseInner[]
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$organizationId` | **string\|null** | The ID of the organization the ticket should be related to (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTicketCategoriesRequest

Create request for operation 'listTicketCategories'

```php
private listTicketCategoriesRequest(string|null $subscriptionId = null, string|null $organizationId = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$organizationId` | **string\|null** | The ID of the organization the ticket should be related to (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listTicketPriorities

List support ticket priorities

```php
public listTicketPriorities(string|null $subscriptionId = null, string|null $category = null): \Upsun\Model\ListTicketPriorities200ResponseInner[]
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$category`       | **string\|null** | The category of the support ticket. (optional)                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Support/operation/list-ticket-priorities

***

### listTicketPrioritiesWithHttpInfo

List support ticket priorities with HTTP Info

```php
private listTicketPrioritiesWithHttpInfo(string|null $subscriptionId = null, string|null $category = null): \Upsun\Model\ListTicketPriorities200ResponseInner[]
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$category`       | **string\|null** | The category of the support ticket. (optional)                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listTicketPrioritiesRequest

Create request for operation 'listTicketPriorities'

```php
private listTicketPrioritiesRequest(string|null $subscriptionId = null, string|null $category = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                           |
|-------------------|------------------|-----------------------------------------------------------------------|
| `$subscriptionId` | **string\|null** | The ID of the subscription the ticket should be related to (optional) |
| `$category`       | **string\|null** | The category of the support ticket. (optional)                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateTicket

Update a ticket

```php
public updateTicket(string $ticketId, ?\Upsun\Model\UpdateTicketRequest $updateTicketRequest = null): \Upsun\Model\Ticket|null
```

**Parameters:**

| Parameter              | Type                                  | Description                     |
|------------------------|---------------------------------------|---------------------------------|
| `$ticketId`            | **string**                            | The ID of the ticket (required) |
| `$updateTicketRequest` | **?\Upsun\Model\UpdateTicketRequest** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Support/operation/update-ticket

***

### updateTicketWithHttpInfo

Update a ticket with HTTP Info

```php
private updateTicketWithHttpInfo(string $ticketId, ?\Upsun\Model\UpdateTicketRequest $updateTicketRequest = null): \Upsun\Model\Ticket|null
```

**Parameters:**

| Parameter              | Type                                  | Description                     |
|------------------------|---------------------------------------|---------------------------------|
| `$ticketId`            | **string**                            | The ID of the ticket (required) |
| `$updateTicketRequest` | **?\Upsun\Model\UpdateTicketRequest** |                                 |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateTicketRequest

Create request for operation 'updateTicket'

```php
private updateTicketRequest(string $ticketId, ?\Upsun\Model\UpdateTicketRequest $updateTicketRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter              | Type                                  | Description                     |
|------------------------|---------------------------------------|---------------------------------|
| `$ticketId`            | **string**                            | The ID of the ticket (required) |
| `$updateTicketRequest` | **?\Upsun\Model\UpdateTicketRequest** |                                 |

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
