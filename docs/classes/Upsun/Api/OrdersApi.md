# OrdersApi

Low level OrdersApi (auto-generated)

***

* Full name: `\Upsun\Api\OrdersApi`
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

### createAuthorizationCredentials

Create confirmation credentials for for 3D-Secure

```php
public createAuthorizationCredentials(string $organizationId, string $orderId): \Upsun\Model\CreateAuthorizationCredentials200Response
```

Creates confirmation credentials for payments that require online authorization

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string** | The ID of the order. (required)                                                                            |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Orders/operation/create-authorization-credentials

***

### createAuthorizationCredentialsWithHttpInfo

Create confirmation credentials for for 3D-Secure with HTTP Info

```php
private createAuthorizationCredentialsWithHttpInfo(string $organizationId, string $orderId): \Upsun\Model\CreateAuthorizationCredentials200Response
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string** | The ID of the order. (required)                                                                            |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createAuthorizationCredentialsRequest

Create request for operation 'createAuthorizationCredentials'

```php
private createAuthorizationCredentialsRequest(string $organizationId, string $orderId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string** | The ID of the order. (required)                                                                            |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### downloadInvoice

Download an invoice.

```php
public downloadInvoice(string $token): string
```

**Parameters:**

| Parameter | Type       | Description                 |
|-----------|------------|-----------------------------|
| `$token`  | **string** | JWT for invoice. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Orders/operation/download-invoice

***

### downloadInvoiceWithHttpInfo

Download an invoice. with HTTP Info

```php
private downloadInvoiceWithHttpInfo(string $token): string
```

**Parameters:**

| Parameter | Type       | Description                 |
|-----------|------------|-----------------------------|
| `$token`  | **string** | JWT for invoice. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### downloadInvoiceRequest

Create request for operation 'downloadInvoice'

```php
private downloadInvoiceRequest(string $token): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter | Type       | Description                 |
|-----------|------------|-----------------------------|
| `$token`  | **string** | JWT for invoice. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgOrder

Get order

```php
public getOrgOrder(string $organizationId, string $orderId, string|null $mode = null): \Upsun\Model\Order
```

Retrieves an order for the specified organization.

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string**       | The ID of the order. (required)                                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Orders/operation/get-org-order

***

### getOrgOrderWithHttpInfo

Get order with HTTP Info

```php
private getOrgOrderWithHttpInfo(string $organizationId, string $orderId, string|null $mode = null): \Upsun\Model\Order
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string**       | The ID of the order. (required)                                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgOrderRequest

Create request for operation 'getOrgOrder'

```php
private getOrgOrderRequest(string $organizationId, string $orderId, string|null $mode = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$orderId`        | **string**       | The ID of the order. (required)                                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgOrders

List orders

```php
public listOrgOrders(string $organizationId, string|null $filterStatus = null, int|null $filterTotal = null, int|null $page = null, string|null $mode = null): \Upsun\Model\ListOrgOrders200Response
```

Retrieves orders for the specified organization.

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$filterStatus`   | **string\|null** | The status of the order. (optional)                                                                        |
| `$filterTotal`    | **int\|null**    | The total of the order. (optional)                                                                         |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Orders/operation/list-org-orders

***

### listOrgOrdersWithHttpInfo

List orders with HTTP Info

```php
private listOrgOrdersWithHttpInfo(string $organizationId, string|null $filterStatus = null, int|null $filterTotal = null, int|null $page = null, string|null $mode = null): \Upsun\Model\ListOrgOrders200Response
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$filterStatus`   | **string\|null** | The status of the order. (optional)                                                                        |
| `$filterTotal`    | **int\|null**    | The total of the order. (optional)                                                                         |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgOrdersRequest

Create request for operation 'listOrgOrders'

```php
private listOrgOrdersRequest(string $organizationId, string|null $filterStatus = null, int|null $filterTotal = null, int|null $page = null, string|null $mode = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                |
|-------------------|------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$filterStatus`   | **string\|null** | The status of the order. (optional)                                                                        |
| `$filterTotal`    | **int\|null**    | The total of the order. (optional)                                                                         |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                            |
| `$mode`           | **string\|null** | The output mode. (optional)                                                                                |

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
