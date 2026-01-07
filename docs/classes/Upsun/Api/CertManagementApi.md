# CertManagementApi

Low level CertManagementApi (auto-generated)

***

* Full name: `\Upsun\Api\CertManagementApi`
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

### createProjectsCertificates

Add an SSL certificate

```php
public createProjectsCertificates(string $projectId, \Upsun\Model\CertificateCreateInput $certificateCreateInput): \Upsun\Model\AcceptedResponse
```

Add a single SSL certificate to a project.

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$certificateCreateInput` | **\Upsun\Model\CertificateCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/create-projects-certificates

***

### createProjectsCertificatesWithHttpInfo

Add an SSL certificate with HTTP Info

```php
private createProjectsCertificatesWithHttpInfo(string $projectId, \Upsun\Model\CertificateCreateInput $certificateCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$certificateCreateInput` | **\Upsun\Model\CertificateCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsCertificatesRequest

Create request for operation 'createProjectsCertificates'

```php
private createProjectsCertificatesRequest(string $projectId, \Upsun\Model\CertificateCreateInput $certificateCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$certificateCreateInput` | **\Upsun\Model\CertificateCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsCertificates

Delete an SSL certificate

```php
public deleteProjectsCertificates(string $projectId, string $certificateId): \Upsun\Model\AcceptedResponse
```

Delete a single SSL certificate associated with a project.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/delete-projects-certificates

***

### deleteProjectsCertificatesWithHttpInfo

Delete an SSL certificate with HTTP Info

```php
private deleteProjectsCertificatesWithHttpInfo(string $projectId, string $certificateId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsCertificatesRequest

Create request for operation 'deleteProjectsCertificates'

```php
private deleteProjectsCertificatesRequest(string $projectId, string $certificateId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsCertificates

Get an SSL certificate

```php
public getProjectsCertificates(string $projectId, string $certificateId): \Upsun\Model\Certificate
```

Retrieve information about a single SSL certificate associated with a project.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/get-projects-certificates

***

### getProjectsCertificatesWithHttpInfo

Get an SSL certificate with HTTP Info

```php
private getProjectsCertificatesWithHttpInfo(string $projectId, string $certificateId): \Upsun\Model\Certificate
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsCertificatesRequest

Create request for operation 'getProjectsCertificates'

```php
private getProjectsCertificatesRequest(string $projectId, string $certificateId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$certificateId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsProvisioners

```php
public getProjectsProvisioners(string $projectId, string $certificateProvisionerDocumentId): \Upsun\Model\CertificateProvisioner
```

**Parameters:**

| Parameter                           | Type       | Description |
|-------------------------------------|------------|-------------|
| `$projectId`                        | **string** |             |
| `$certificateProvisionerDocumentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/get-projects-provisioners

***

### getProjectsProvisionersWithHttpInfo

```php
private getProjectsProvisionersWithHttpInfo(string $projectId, string $certificateProvisionerDocumentId): \Upsun\Model\CertificateProvisioner
```

**Parameters:**

| Parameter                           | Type       | Description |
|-------------------------------------|------------|-------------|
| `$projectId`                        | **string** |             |
| `$certificateProvisionerDocumentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsProvisionersRequest

Create request for operation 'getProjectsProvisioners'

```php
private getProjectsProvisionersRequest(string $projectId, string $certificateProvisionerDocumentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                           | Type       | Description |
|-------------------------------------|------------|-------------|
| `$projectId`                        | **string** |             |
| `$certificateProvisionerDocumentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsCertificates

Get list of SSL certificates

```php
public listProjectsCertificates(string $projectId): \Upsun\Model\Certificate[]
```

Retrieve a list of objects representing the SSL certificates associated with a project.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/list-projects-certificates

***

### listProjectsCertificatesWithHttpInfo

Get list of SSL certificates with HTTP Info

```php
private listProjectsCertificatesWithHttpInfo(string $projectId): \Upsun\Model\Certificate[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsCertificatesRequest

Create request for operation 'listProjectsCertificates'

```php
private listProjectsCertificatesRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsProvisioners

```php
public listProjectsProvisioners(string $projectId): \Upsun\Model\CertificateProvisioner[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/list-projects-provisioners

***

### listProjectsProvisionersWithHttpInfo

```php
private listProjectsProvisionersWithHttpInfo(string $projectId): \Upsun\Model\CertificateProvisioner[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsProvisionersRequest

Create request for operation 'listProjectsProvisioners'

```php
private listProjectsProvisionersRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsCertificates

Update an SSL certificate

```php
public updateProjectsCertificates(string $projectId, string $certificateId, \Upsun\Model\CertificatePatch $certificatePatch): \Upsun\Model\AcceptedResponse
```

Update a single SSL certificate associated with a project.

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$certificateId`    | **string**                        |             |
| `$certificatePatch` | **\Upsun\Model\CertificatePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/update-projects-certificates

***

### updateProjectsCertificatesWithHttpInfo

Update an SSL certificate with HTTP Info

```php
private updateProjectsCertificatesWithHttpInfo(string $projectId, string $certificateId, \Upsun\Model\CertificatePatch $certificatePatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$certificateId`    | **string**                        |             |
| `$certificatePatch` | **\Upsun\Model\CertificatePatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsCertificatesRequest

Create request for operation 'updateProjectsCertificates'

```php
private updateProjectsCertificatesRequest(string $projectId, string $certificateId, \Upsun\Model\CertificatePatch $certificatePatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$certificateId`    | **string**                        |             |
| `$certificatePatch` | **\Upsun\Model\CertificatePatch** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsProvisioners

```php
public updateProjectsProvisioners(string $projectId, string $certificateProvisionerDocumentId, \Upsun\Model\CertificateProvisionerPatch $certificateProvisionerPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                           | Type                                         | Description |
|-------------------------------------|----------------------------------------------|-------------|
| `$projectId`                        | **string**                                   |             |
| `$certificateProvisionerDocumentId` | **string**                                   |             |
| `$certificateProvisionerPatch`      | **\Upsun\Model\CertificateProvisionerPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Cert-Management/operation/update-projects-provisioners

***

### updateProjectsProvisionersWithHttpInfo

```php
private updateProjectsProvisionersWithHttpInfo(string $projectId, string $certificateProvisionerDocumentId, \Upsun\Model\CertificateProvisionerPatch $certificateProvisionerPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                           | Type                                         | Description |
|-------------------------------------|----------------------------------------------|-------------|
| `$projectId`                        | **string**                                   |             |
| `$certificateProvisionerDocumentId` | **string**                                   |             |
| `$certificateProvisionerPatch`      | **\Upsun\Model\CertificateProvisionerPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsProvisionersRequest

Create request for operation 'updateProjectsProvisioners'

```php
private updateProjectsProvisionersRequest(string $projectId, string $certificateProvisionerDocumentId, \Upsun\Model\CertificateProvisionerPatch $certificateProvisionerPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                           | Type                                         | Description |
|-------------------------------------|----------------------------------------------|-------------|
| `$projectId`                        | **string**                                   |             |
| `$certificateProvisionerDocumentId` | **string**                                   |             |
| `$certificateProvisionerPatch`      | **\Upsun\Model\CertificateProvisionerPatch** | (required)  |

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
