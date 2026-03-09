# RepositoryApi

Low level RepositoryApi (auto-generated)

***

* Full name: `\Upsun\Api\RepositoryApi`
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

### getProjectsGitBlobs

Get a blob object

```php
public getProjectsGitBlobs(string $projectId, string $repositoryBlobId): \Upsun\Model\Blob
```

Retrieve, by hash, an object representing a blob in the repository backing a project. This endpoint allows direct
read-only access to the contents of files in a repo. It returns the file in the `content` field of the response
object, encoded according to the format in the `encoding` field, e.g. `base64`.

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryBlobId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-blobs

***

### getProjectsGitBlobsWithHttpInfo

Get a blob object with HTTP Info

```php
private getProjectsGitBlobsWithHttpInfo(string $projectId, string $repositoryBlobId): \Upsun\Model\Blob
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryBlobId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsGitBlobsRequest

Create request for operation 'getProjectsGitBlobs'

```php
private getProjectsGitBlobsRequest(string $projectId, string $repositoryBlobId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryBlobId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsGitCommits

Get a commit object

```php
public getProjectsGitCommits(string $projectId, string $repositoryCommitId): \Upsun\Model\Commit
```

Retrieve, by hash, an object representing a commit in the repository backing a project. This endpoint functions
similarly to `git cat-file -p <commit-id>`. The returned object contains the hash of the Git tree that it belongs
to, as well as the ID of parent commits. The commit represented by a parent ID can be retrieved using this
endpoint, while the tree state represented by this commit can be retrieved using the Get a tree object
(https://docs.upsun.com/api/#tag/Git-Repo/paths//projects/{projectId}/git/trees/{repositoryTreeId}/get) endpoint.

**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$projectId`          | **string** |             |
| `$repositoryCommitId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-commits

***

### getProjectsGitCommitsWithHttpInfo

Get a commit object with HTTP Info

```php
private getProjectsGitCommitsWithHttpInfo(string $projectId, string $repositoryCommitId): \Upsun\Model\Commit
```

**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$projectId`          | **string** |             |
| `$repositoryCommitId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsGitCommitsRequest

Create request for operation 'getProjectsGitCommits'

```php
private getProjectsGitCommitsRequest(string $projectId, string $repositoryCommitId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type       | Description |
|-----------------------|------------|-------------|
| `$projectId`          | **string** |             |
| `$repositoryCommitId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsGitRefs

Get a ref object

```php
public getProjectsGitRefs(string $projectId, string $repositoryRefId): \Upsun\Model\Ref
```

Retrieve the details of a single `refs` object in the repository backing a project. This endpoint functions
similarly to `git show-ref <pattern>`, although the pattern must be a full ref `id`, rather than a matching
pattern. *NOTE: The `{repositoryRefId}` must be properly escaped.* That is, the ref `refs/heads/master` is
accessible via `/projects/{projectId}/git/refs/heads/master`.

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$repositoryRefId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-refs

***

### getProjectsGitRefsWithHttpInfo

Get a ref object with HTTP Info

```php
private getProjectsGitRefsWithHttpInfo(string $projectId, string $repositoryRefId): \Upsun\Model\Ref
```

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$repositoryRefId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsGitRefsRequest

Create request for operation 'getProjectsGitRefs'

```php
private getProjectsGitRefsRequest(string $projectId, string $repositoryRefId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter          | Type       | Description |
|--------------------|------------|-------------|
| `$projectId`       | **string** |             |
| `$repositoryRefId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsGitTrees

Get a tree object

```php
public getProjectsGitTrees(string $projectId, string $repositoryTreeId): \Upsun\Model\Tree
```

Retrieve, by hash, the tree state represented by a commit. The returned object's `tree` field contains a list of
files and directories present in the tree. Directories in the tree can be recursively retrieved by this endpoint
through their hashes. Files in the tree can be retrieved by the Get a blob object
(https://docs.upsun.com/api/#tag/Git-Repo/paths//projects/{projectId}/git/blobs/{repositoryBlobId}/get) endpoint.

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryTreeId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-trees

***

### getProjectsGitTreesWithHttpInfo

Get a tree object with HTTP Info

```php
private getProjectsGitTreesWithHttpInfo(string $projectId, string $repositoryTreeId): \Upsun\Model\Tree
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryTreeId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsGitTreesRequest

Create request for operation 'getProjectsGitTrees'

```php
private getProjectsGitTreesRequest(string $projectId, string $repositoryTreeId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type       | Description |
|---------------------|------------|-------------|
| `$projectId`        | **string** |             |
| `$repositoryTreeId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsGitRefs

Get list of repository refs

```php
public listProjectsGitRefs(string $projectId): \Upsun\Model\Ref[]
```

Retrieve a list of `refs/*` in the repository backing a project. This endpoint functions similarly to `git
show-ref`, with each returned object containing a `ref` field with the ref's name, and an object containing the
associated commit ID. The returned commit ID can be used with the Get a commit object
(https://docs.upsun.com/api/#tag/Git-Repo/paths//projects/{projectId}/git/commits/{repositoryCommitId}/get)
endpoint to retrieve information about that specific commit.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Repository/operation/list-projects-git-refs

***

### listProjectsGitRefsWithHttpInfo

Get list of repository refs with HTTP Info

```php
private listProjectsGitRefsWithHttpInfo(string $projectId): \Upsun\Model\Ref[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsGitRefsRequest

Create request for operation 'listProjectsGitRefs'

```php
private listProjectsGitRefsRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

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
