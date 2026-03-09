# InvoicesApi

Low level InvoicesApi (auto-generated)

***

* Full name: `\Upsun\Api\InvoicesApi`
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

### getOrgInvoice

Get invoice

```php
public getOrgInvoice(string $invoiceId, string $organizationId): \Upsun\Model\Invoice
```

Retrieves an invoice for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$invoiceId`      | **string** | The ID of the invoice. (required)                                                                      |
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Invoices/operation/get-org-invoice

***

### getOrgInvoiceWithHttpInfo

Get invoice with HTTP Info

```php
private getOrgInvoiceWithHttpInfo(string $invoiceId, string $organizationId): \Upsun\Model\Invoice
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$invoiceId`      | **string** | The ID of the invoice. (required)                                                                      |
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgInvoiceRequest

Create request for operation 'getOrgInvoice'

```php
private getOrgInvoiceRequest(string $invoiceId, string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$invoiceId`      | **string** | The ID of the invoice. (required)                                                                      |
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgInvoices

List invoices

```php
public listOrgInvoices(string $organizationId, string|null $filterStatus = null, string|null $filterType = null, string|null $filterOrderId = null, int|null $page = null): \Upsun\Model\ListOrgInvoices200Response
```

Retrieves a list of invoices for the specified organization.

**Parameters:**

| Parameter         | Type             | Description                                                                                             |
|-------------------|------------------|---------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)  |
| `$filterStatus`   | **string\|null** | The status of the invoice. (optional)                                                                   |
| `$filterType`     | **string\|null** | The invoice type. Use invoice for standard invoices, credit_memo for
refund/credit invoices. (optional) |
| `$filterOrderId`  | **string\|null** | The order id of Invoice. (optional)                                                                     |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                         |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Invoices/operation/list-org-invoices

***

### listOrgInvoicesWithHttpInfo

List invoices with HTTP Info

```php
private listOrgInvoicesWithHttpInfo(string $organizationId, string|null $filterStatus = null, string|null $filterType = null, string|null $filterOrderId = null, int|null $page = null): \Upsun\Model\ListOrgInvoices200Response
```

**Parameters:**

| Parameter         | Type             | Description                                                                                             |
|-------------------|------------------|---------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)  |
| `$filterStatus`   | **string\|null** | The status of the invoice. (optional)                                                                   |
| `$filterType`     | **string\|null** | The invoice type. Use invoice for standard invoices, credit_memo for
refund/credit invoices. (optional) |
| `$filterOrderId`  | **string\|null** | The order id of Invoice. (optional)                                                                     |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                         |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgInvoicesRequest

Create request for operation 'listOrgInvoices'

```php
private listOrgInvoicesRequest(string $organizationId, string|null $filterStatus = null, string|null $filterType = null, string|null $filterOrderId = null, int|null $page = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                                             |
|-------------------|------------------|---------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required)  |
| `$filterStatus`   | **string\|null** | The status of the invoice. (optional)                                                                   |
| `$filterType`     | **string\|null** | The invoice type. Use invoice for standard invoices, credit_memo for
refund/credit invoices. (optional) |
| `$filterOrderId`  | **string\|null** | The order id of Invoice. (optional)                                                                     |
| `$page`           | **int\|null**    | Page to be displayed. Defaults to 1. (optional)                                                         |

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
