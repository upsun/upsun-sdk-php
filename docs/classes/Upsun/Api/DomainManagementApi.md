# DomainManagementApi

Low level DomainManagementApi (auto-generated)

***

* Full name: `\Upsun\Api\DomainManagementApi`
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

### createProjectsDomains

Add a project domain

```php
public createProjectsDomains(string $projectId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Upsun\Model\AcceptedResponse
```

Add a single domain to a project. If the `ssl` field is left blank without an object containing a PEM-encoded SSL
certificate, a certificate will [be provisioned for you via Let's
Encrypt.](https://docs.upsun.com/anchors/routes/https/certificates/)

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/create-projects-domains

***

### createProjectsDomainsWithHttpInfo

Add a project domain with HTTP Info

```php
private createProjectsDomainsWithHttpInfo(string $projectId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsDomainsRequest

Create request for operation 'createProjectsDomains'

```php
private createProjectsDomainsRequest(string $projectId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### createProjectsEnvironmentsDomains

Add an environment domain

```php
public createProjectsEnvironmentsDomains(string $projectId, string $environmentId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Upsun\Model\AcceptedResponse
```

Add a single domain to an environment. If the environment is not production, the `replacement_for` field is
required, which binds a new domain to an existing one from a production environment. If the `ssl` field is left
blank without an object containing a PEM-encoded SSL certificate, a certificate will [be provisioned for you via
Let's Encrypt](https://docs.upsun.com/anchors/routes/https/certificates/).

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$environmentId`     | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/create-projects-environments-domains

***

### createProjectsEnvironmentsDomainsWithHttpInfo

Add an environment domain with HTTP Info

```php
private createProjectsEnvironmentsDomainsWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$environmentId`     | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsEnvironmentsDomainsRequest

Create request for operation 'createProjectsEnvironmentsDomains'

```php
private createProjectsEnvironmentsDomainsRequest(string $projectId, string $environmentId, \Upsun\Model\DomainCreateInput $domainCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type                               | Description |
|----------------------|------------------------------------|-------------|
| `$projectId`         | **string**                         |             |
| `$environmentId`     | **string**                         |             |
| `$domainCreateInput` | **\Upsun\Model\DomainCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsDomains

Delete a project domain

```php
public deleteProjectsDomains(string $projectId, string $domainId): \Upsun\Model\AcceptedResponse
```

Delete a single user-specified domain associated with a project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/delete-projects-domains

***

### deleteProjectsDomainsWithHttpInfo

Delete a project domain with HTTP Info

```php
private deleteProjectsDomainsWithHttpInfo(string $projectId, string $domainId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsDomainsRequest

Create request for operation 'deleteProjectsDomains'

```php
private deleteProjectsDomainsRequest(string $projectId, string $domainId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsEnvironmentsDomains

Delete an environment domain

```php
public deleteProjectsEnvironmentsDomains(string $projectId, string $environmentId, string $domainId): \Upsun\Model\AcceptedResponse
```

Delete a single user-specified domain associated with an environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/delete-projects-environments-domains

***

### deleteProjectsEnvironmentsDomainsWithHttpInfo

Delete an environment domain with HTTP Info

```php
private deleteProjectsEnvironmentsDomainsWithHttpInfo(string $projectId, string $environmentId, string $domainId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsEnvironmentsDomainsRequest

Create request for operation 'deleteProjectsEnvironmentsDomains'

```php
private deleteProjectsEnvironmentsDomainsRequest(string $projectId, string $environmentId, string $domainId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsDomains

Get a project domain

```php
public getProjectsDomains(string $projectId, string $domainId): \Upsun\Model\Domain
```

Retrieve information about a single user-specified domain associated with a project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/get-projects-domains

***

### getProjectsDomainsWithHttpInfo

Get a project domain with HTTP Info

```php
private getProjectsDomainsWithHttpInfo(string $projectId, string $domainId): \Upsun\Model\Domain
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsDomainsRequest

Create request for operation 'getProjectsDomains'

```php
private getProjectsDomainsRequest(string $projectId, string $domainId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |
| `$domainId`  | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsEnvironmentsDomains

Get an environment domain

```php
public getProjectsEnvironmentsDomains(string $projectId, string $environmentId, string $domainId): \Upsun\Model\Domain
```

Retrieve information about a single user-specified domain associated with an environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/get-projects-environments-domains

***

### getProjectsEnvironmentsDomainsWithHttpInfo

Get an environment domain with HTTP Info

```php
private getProjectsEnvironmentsDomainsWithHttpInfo(string $projectId, string $environmentId, string $domainId): \Upsun\Model\Domain
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsEnvironmentsDomainsRequest

Create request for operation 'getProjectsEnvironmentsDomains'

```php
private getProjectsEnvironmentsDomainsRequest(string $projectId, string $environmentId, string $domainId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$domainId`      | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsDomains

Get list of project domains

```php
public listProjectsDomains(string $projectId): \Upsun\Model\Domain[]
```

Retrieve a list of objects representing the user-specified domains associated with a project. Note that this does
*not* return the domains automatically assigned to a project that appear under "Access site" on the user
interface.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/list-projects-domains

***

### listProjectsDomainsWithHttpInfo

Get list of project domains with HTTP Info

```php
private listProjectsDomainsWithHttpInfo(string $projectId): \Upsun\Model\Domain[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsDomainsRequest

Create request for operation 'listProjectsDomains'

```php
private listProjectsDomainsRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironmentsDomains

Get a list of environment domains

```php
public listProjectsEnvironmentsDomains(string $projectId, string $environmentId): \Upsun\Model\Domain[]
```

Retrieve a list of objects representing the user-specified domains associated with an environment. Note that this
does *not* return the `.platformsh.site` subdomains, which are automatically assigned to the environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/list-projects-environments-domains

***

### listProjectsEnvironmentsDomainsWithHttpInfo

Get a list of environment domains with HTTP Info

```php
private listProjectsEnvironmentsDomainsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\Domain[]
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsEnvironmentsDomainsRequest

Create request for operation 'listProjectsEnvironmentsDomains'

```php
private listProjectsEnvironmentsDomainsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsDomains

Update a project domain

```php
public updateProjectsDomains(string $projectId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

Update the information associated with a single user-specified domain associated with a project.

**Parameters:**

| Parameter      | Type                         | Description |
|----------------|------------------------------|-------------|
| `$projectId`   | **string**                   |             |
| `$domainId`    | **string**                   |             |
| `$domainPatch` | **\Upsun\Model\DomainPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/update-projects-domains

***

### updateProjectsDomainsWithHttpInfo

Update a project domain with HTTP Info

```php
private updateProjectsDomainsWithHttpInfo(string $projectId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter      | Type                         | Description |
|----------------|------------------------------|-------------|
| `$projectId`   | **string**                   |             |
| `$domainId`    | **string**                   |             |
| `$domainPatch` | **\Upsun\Model\DomainPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsDomainsRequest

Create request for operation 'updateProjectsDomains'

```php
private updateProjectsDomainsRequest(string $projectId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter      | Type                         | Description |
|----------------|------------------------------|-------------|
| `$projectId`   | **string**                   |             |
| `$domainId`    | **string**                   |             |
| `$domainPatch` | **\Upsun\Model\DomainPatch** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsEnvironmentsDomains

Update an environment domain

```php
public updateProjectsEnvironmentsDomains(string $projectId, string $environmentId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

Update the information associated with a single user-specified domain associated with an environment.

**Parameters:**

| Parameter        | Type                         | Description |
|------------------|------------------------------|-------------|
| `$projectId`     | **string**                   |             |
| `$environmentId` | **string**                   |             |
| `$domainId`      | **string**                   |             |
| `$domainPatch`   | **\Upsun\Model\DomainPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Domain-Management/operation/update-projects-environments-domains

***

### updateProjectsEnvironmentsDomainsWithHttpInfo

Update an environment domain with HTTP Info

```php
private updateProjectsEnvironmentsDomainsWithHttpInfo(string $projectId, string $environmentId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                         | Description |
|------------------|------------------------------|-------------|
| `$projectId`     | **string**                   |             |
| `$environmentId` | **string**                   |             |
| `$domainId`      | **string**                   |             |
| `$domainPatch`   | **\Upsun\Model\DomainPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsEnvironmentsDomainsRequest

Create request for operation 'updateProjectsEnvironmentsDomains'

```php
private updateProjectsEnvironmentsDomainsRequest(string $projectId, string $environmentId, string $domainId, \Upsun\Model\DomainPatch $domainPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type                         | Description |
|------------------|------------------------------|-------------|
| `$projectId`     | **string**                   |             |
| `$environmentId` | **string**                   |             |
| `$domainId`      | **string**                   |             |
| `$domainPatch`   | **\Upsun\Model\DomainPatch** | (required)  |

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
