# OrganizationManagementApi

Low level OrganizationManagementApi (auto-generated)

***

* Full name: `\Upsun\Api\OrganizationManagementApi`
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

### estimateOrg

Estimate total spend

```php
public estimateOrg(string $organizationId): \Upsun\Model\OrganizationEstimationObject
```

Estimates the total spend for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Management/operation/estimate-org

***

### estimateOrgWithHttpInfo

Estimate total spend with HTTP Info

```php
private estimateOrgWithHttpInfo(string $organizationId): \Upsun\Model\OrganizationEstimationObject
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### estimateOrgRequest

Create request for operation 'estimateOrg'

```php
private estimateOrgRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgBillingAlertConfig

Get billing alert configuration

```php
public getOrgBillingAlertConfig(string $organizationId): \Upsun\Model\OrganizationAlertConfig
```

Retrieves billing alert configuration for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Management/operation/get-org-billing-alert-config

***

### getOrgBillingAlertConfigWithHttpInfo

Get billing alert configuration with HTTP Info

```php
private getOrgBillingAlertConfigWithHttpInfo(string $organizationId): \Upsun\Model\OrganizationAlertConfig
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgBillingAlertConfigRequest

Create request for operation 'getOrgBillingAlertConfig'

```php
private getOrgBillingAlertConfigRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                            |
|-------------------|------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgPrepaymentInfo

Get organization prepayment information

```php
public getOrgPrepaymentInfo(string $organizationId): \Upsun\Model\GetOrgPrepaymentInfo200Response
```

Retrieves prepayment information for the specified organization, if applicable.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Management/operation/get-org-prepayment-info

***

### getOrgPrepaymentInfoWithHttpInfo

Get organization prepayment information with HTTP Info

```php
private getOrgPrepaymentInfoWithHttpInfo(string $organizationId): \Upsun\Model\GetOrgPrepaymentInfo200Response
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgPrepaymentInfoRequest

Create request for operation 'getOrgPrepaymentInfo'

```php
private getOrgPrepaymentInfoRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgPrepaymentTransactions

List organization prepayment transactions

```php
public listOrgPrepaymentTransactions(string $organizationId): \Upsun\Model\ListOrgPrepaymentTransactions200Response
```

Retrieves a list of prepayment transactions for the specified organization, if applicable.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Management/operation/list-org-prepayment-transactions

***

### listOrgPrepaymentTransactionsWithHttpInfo

List organization prepayment transactions with HTTP Info

```php
private listOrgPrepaymentTransactionsWithHttpInfo(string $organizationId): \Upsun\Model\ListOrgPrepaymentTransactions200Response
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgPrepaymentTransactionsRequest

Create request for operation 'listOrgPrepaymentTransactions'

```php
private listOrgPrepaymentTransactionsRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrgBillingAlertConfig

Update billing alert configuration

```php
public updateOrgBillingAlertConfig(string $organizationId, ?\Upsun\Model\UpdateOrgBillingAlertConfigRequest $updateOrgBillingAlertConfigRequest = null): \Upsun\Model\OrganizationAlertConfig
```

Updates billing alert configuration for the specified organization.

**Parameters:**

| Parameter                             | Type                                                 | Description                                                                                            |
|---------------------------------------|------------------------------------------------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId`                     | **string**                                           | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |
| `$updateOrgBillingAlertConfigRequest` | **?\Upsun\Model\UpdateOrgBillingAlertConfigRequest** |                                                                                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Organization-Management/operation/update-org-billing-alert-config

***

### updateOrgBillingAlertConfigWithHttpInfo

Update billing alert configuration with HTTP Info

```php
private updateOrgBillingAlertConfigWithHttpInfo(string $organizationId, ?\Upsun\Model\UpdateOrgBillingAlertConfigRequest $updateOrgBillingAlertConfigRequest = null): \Upsun\Model\OrganizationAlertConfig
```

**Parameters:**

| Parameter                             | Type                                                 | Description                                                                                            |
|---------------------------------------|------------------------------------------------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId`                     | **string**                                           | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |
| `$updateOrgBillingAlertConfigRequest` | **?\Upsun\Model\UpdateOrgBillingAlertConfigRequest** |                                                                                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgBillingAlertConfigRequest

Create request for operation 'updateOrgBillingAlertConfig'

```php
private updateOrgBillingAlertConfigRequest(string $organizationId, ?\Upsun\Model\UpdateOrgBillingAlertConfigRequest $updateOrgBillingAlertConfigRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                             | Type                                                 | Description                                                                                            |
|---------------------------------------|------------------------------------------------------|--------------------------------------------------------------------------------------------------------|
| `$organizationId`                     | **string**                                           | The ID of the organization. Prefix with name= to retrieve the organization by
name instead. (required) |
| `$updateOrgBillingAlertConfigRequest` | **?\Upsun\Model\UpdateOrgBillingAlertConfigRequest** |                                                                                                        |

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
