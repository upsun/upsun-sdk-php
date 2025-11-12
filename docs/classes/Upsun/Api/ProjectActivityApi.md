# ProjectActivityApi

Low level ProjectActivityApi (auto-generated)

***

* Full name: `\Upsun\Api\ProjectActivityApi`
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

### actionProjectsActivitiesCancel

Cancel a project activity

```php
public actionProjectsActivitiesCancel(string $projectId, string $activityId): \Upsun\Model\AcceptedResponse
```

Cancel a single activity as specified by an `id` returned by the Get project activity log
(https://docs.upsun.com/api/#tag/Project-Activity/paths//projects/{projectId}/activities/get) endpoint. Please
note that not all activities are cancelable.

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Activity/operation/action-projects-activities-cancel

***

### actionProjectsActivitiesCancelWithHttpInfo

Cancel a project activity with HTTP Info

```php
private actionProjectsActivitiesCancelWithHttpInfo(string $projectId, string $activityId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### actionProjectsActivitiesCancelRequest

Create request for operation 'actionProjectsActivitiesCancel'

```php
private actionProjectsActivitiesCancelRequest(string $projectId, string $activityId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsActivities

Get a project activity log entry

```php
public getProjectsActivities(string $projectId, string $activityId): \Upsun\Model\Activity
```

Retrieve a single activity log entry as specified by an `id` returned by the Get project activity log
(https://docs.upsun.com/api/#tag/Project-Activity/paths//projects/{projectId}/activities/get) endpoint. See the
documentation on that endpoint for details about the information this endpoint can return.

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Activity/operation/get-projects-activities

***

### getProjectsActivitiesWithHttpInfo

Get a project activity log entry with HTTP Info

```php
private getProjectsActivitiesWithHttpInfo(string $projectId, string $activityId): \Upsun\Model\Activity
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsActivitiesRequest

Create request for operation 'getProjectsActivities'

```php
private getProjectsActivitiesRequest(string $projectId, string $activityId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$projectId`  | **string** |             |
| `$activityId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsActivities

Get project activity log

```php
public listProjectsActivities(string $projectId): \Upsun\Model\Activity[]
```

Retrieve a project's activity log including logging actions in all environments within a project. This returns a
list of objects with records of actions such as: - Commits being pushed to the repository - A new environment
being branched out from the specified environment - A snapshot being created of the specified environment The
object includes a timestamp of when the action occurred (`created_at`), when the action concluded (`updated_at`),
the current `state` of the action, the action's completion percentage (`completion_percent`), the `environments`
it applies to and when the activity expires (`expires_at`). There are other related information in the `payload`.
The contents of the `payload` varies based on the `type` of the activity. For example: - An `environment.branch`
action's `payload` can contain objects representing the environment's `parent` environment and the branching
action's `outcome`. - An `environment.push` action's `payload` can contain objects representing the
`environment`, the specific `commits` included in the push, and the `user` who pushed. Expired activities are
removed from the project activity log, except the last 100 expired objects provided they are not of type
`environment.cron` or `environment.backup`.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Project-Activity/operation/list-projects-activities

***

### listProjectsActivitiesWithHttpInfo

Get project activity log with HTTP Info

```php
private listProjectsActivitiesWithHttpInfo(string $projectId): \Upsun\Model\Activity[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsActivitiesRequest

Create request for operation 'listProjectsActivities'

```php
private listProjectsActivitiesRequest(string $projectId): \Psr\Http\Message\RequestInterface
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
