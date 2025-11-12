# EnvironmentBackupsApi

Low level EnvironmentBackupsApi (auto-generated)

***

* Full name: `\Upsun\Api\EnvironmentBackupsApi`
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

### backupEnvironment

Create backup of environment

```php
public backupEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBackupInput $environmentBackupInput): \Upsun\Model\AcceptedResponse
```

Trigger a new backup of an environment to be created. See the
[Backups](https://docs.upsun.com/anchors/environments/backup/) section of the documentation for more information.

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBackupInput` | **\Upsun\Model\EnvironmentBackupInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Backups/operation/backup-environment

***

### backupEnvironmentWithHttpInfo

Create backup of environment with HTTP Info

```php
private backupEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBackupInput $environmentBackupInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBackupInput` | **\Upsun\Model\EnvironmentBackupInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### backupEnvironmentRequest

Create request for operation 'backupEnvironment'

```php
private backupEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBackupInput $environmentBackupInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBackupInput` | **\Upsun\Model\EnvironmentBackupInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsEnvironmentsBackups

Delete an environment backup

```php
public deleteProjectsEnvironmentsBackups(string $projectId, string $environmentId, string $backupId): \Upsun\Model\AcceptedResponse
```

Delete a specific backup from an environment using the `id` of the entry retrieved by the Get backups list
(https://docs.upsun.com/api/#tag/Environment-Backups/paths//projects/{projectId}/environments/{environmentId}/backups/get)
endpoint.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Backups/operation/delete-projects-environments-backups

***

### deleteProjectsEnvironmentsBackupsWithHttpInfo

Delete an environment backup with HTTP Info

```php
private deleteProjectsEnvironmentsBackupsWithHttpInfo(string $projectId, string $environmentId, string $backupId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsEnvironmentsBackupsRequest

Create request for operation 'deleteProjectsEnvironmentsBackups'

```php
private deleteProjectsEnvironmentsBackupsRequest(string $projectId, string $environmentId, string $backupId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsEnvironmentsBackups

Get an environment backup's info

```php
public getProjectsEnvironmentsBackups(string $projectId, string $environmentId, string $backupId): \Upsun\Model\Backup
```

Get the details of a specific backup from an environment using the `id` of the entry retrieved by the Get backups
list
(https://docs.upsun.com/api/#tag/Environment-Backups/paths//projects/{projectId}/environments/{environmentId}/backups/get)
endpoint.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Backups/operation/get-projects-environments-backups

***

### getProjectsEnvironmentsBackupsWithHttpInfo

Get an environment backup's info with HTTP Info

```php
private getProjectsEnvironmentsBackupsWithHttpInfo(string $projectId, string $environmentId, string $backupId): \Upsun\Model\Backup
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsEnvironmentsBackupsRequest

Create request for operation 'getProjectsEnvironmentsBackups'

```php
private getProjectsEnvironmentsBackupsRequest(string $projectId, string $environmentId, string $backupId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$backupId`      | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironmentsBackups

Get an environment's backup list

```php
public listProjectsEnvironmentsBackups(string $projectId, string $environmentId): \Upsun\Model\Backup[]
```

Retrieve a list of objects representing backups of this environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Backups/operation/list-projects-environments-backups

***

### listProjectsEnvironmentsBackupsWithHttpInfo

Get an environment's backup list with HTTP Info

```php
private listProjectsEnvironmentsBackupsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\Backup[]
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

### listProjectsEnvironmentsBackupsRequest

Create request for operation 'listProjectsEnvironmentsBackups'

```php
private listProjectsEnvironmentsBackupsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### restoreBackup

Restore an environment snapshot

```php
public restoreBackup(string $projectId, string $environmentId, string $backupId, \Upsun\Model\EnvironmentRestoreInput $environmentRestoreInput): \Upsun\Model\AcceptedResponse
```

Restore a specific backup from an environment using the `id` of the entry retrieved by the Get backups list
(https://docs.upsun.com/api/#tag/Environment-Backups/paths//projects/{projectId}/environments/{environmentId}/backups/get)
endpoint.

**Parameters:**

| Parameter                  | Type                                     | Description |
|----------------------------|------------------------------------------|-------------|
| `$projectId`               | **string**                               |             |
| `$environmentId`           | **string**                               |             |
| `$backupId`                | **string**                               |             |
| `$environmentRestoreInput` | **\Upsun\Model\EnvironmentRestoreInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment-Backups/operation/restore-backup

***

### restoreBackupWithHttpInfo

Restore an environment snapshot with HTTP Info

```php
private restoreBackupWithHttpInfo(string $projectId, string $environmentId, string $backupId, \Upsun\Model\EnvironmentRestoreInput $environmentRestoreInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                  | Type                                     | Description |
|----------------------------|------------------------------------------|-------------|
| `$projectId`               | **string**                               |             |
| `$environmentId`           | **string**                               |             |
| `$backupId`                | **string**                               |             |
| `$environmentRestoreInput` | **\Upsun\Model\EnvironmentRestoreInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### restoreBackupRequest

Create request for operation 'restoreBackup'

```php
private restoreBackupRequest(string $projectId, string $environmentId, string $backupId, \Upsun\Model\EnvironmentRestoreInput $environmentRestoreInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                  | Type                                     | Description |
|----------------------------|------------------------------------------|-------------|
| `$projectId`               | **string**                               |             |
| `$environmentId`           | **string**                               |             |
| `$backupId`                | **string**                               |             |
| `$environmentRestoreInput` | **\Upsun\Model\EnvironmentRestoreInput** | (required)  |

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
