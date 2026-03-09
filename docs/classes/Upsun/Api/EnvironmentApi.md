# EnvironmentApi

Low level EnvironmentApi (auto-generated)

***

* Full name: `\Upsun\Api\EnvironmentApi`
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

### activateEnvironment

Activate an environment

```php
public activateEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentActivateInput $environmentActivateInput): \Upsun\Model\AcceptedResponse
```

Set the specified environment's status to active

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$environmentActivateInput` | **\Upsun\Model\EnvironmentActivateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/activate-environment

***

### activateEnvironmentWithHttpInfo

Activate an environment with HTTP Info

```php
private activateEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentActivateInput $environmentActivateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$environmentActivateInput` | **\Upsun\Model\EnvironmentActivateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### activateEnvironmentRequest

Create request for operation 'activateEnvironment'

```php
private activateEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentActivateInput $environmentActivateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                   | Type                                      | Description |
|-----------------------------|-------------------------------------------|-------------|
| `$projectId`                | **string**                                |             |
| `$environmentId`            | **string**                                |             |
| `$environmentActivateInput` | **\Upsun\Model\EnvironmentActivateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### branchEnvironment

Branch an environment

```php
public branchEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBranchInput $environmentBranchInput): \Upsun\Model\AcceptedResponse
```

Create a new environment as a branch of the current environment.

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBranchInput` | **\Upsun\Model\EnvironmentBranchInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/branch-environment

***

### branchEnvironmentWithHttpInfo

Branch an environment with HTTP Info

```php
private branchEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBranchInput $environmentBranchInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBranchInput` | **\Upsun\Model\EnvironmentBranchInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### branchEnvironmentRequest

Create request for operation 'branchEnvironment'

```php
private branchEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentBranchInput $environmentBranchInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentBranchInput` | **\Upsun\Model\EnvironmentBranchInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### createProjectsEnvironmentsVersions

Create versions associated with the environment

```php
public createProjectsEnvironmentsVersions(string $projectId, string $environmentId, \Upsun\Model\VersionCreateInput $versionCreateInput): \Upsun\Model\AcceptedResponse
```

Create versions associated with the `{environmentId}` environment. At least one version always exists. When
multiple versions exist, it means that multiple versions of an app are deployed. The deployment target type
denotes whether staged deployment is supported.

**Parameters:**

| Parameter             | Type                                | Description |
|-----------------------|-------------------------------------|-------------|
| `$projectId`          | **string**                          |             |
| `$environmentId`      | **string**                          |             |
| `$versionCreateInput` | **\Upsun\Model\VersionCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/create-projects-environments-versions

***

### createProjectsEnvironmentsVersionsWithHttpInfo

Create versions associated with the environment with HTTP Info

```php
private createProjectsEnvironmentsVersionsWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\VersionCreateInput $versionCreateInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter             | Type                                | Description |
|-----------------------|-------------------------------------|-------------|
| `$projectId`          | **string**                          |             |
| `$environmentId`      | **string**                          |             |
| `$versionCreateInput` | **\Upsun\Model\VersionCreateInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createProjectsEnvironmentsVersionsRequest

Create request for operation 'createProjectsEnvironmentsVersions'

```php
private createProjectsEnvironmentsVersionsRequest(string $projectId, string $environmentId, \Upsun\Model\VersionCreateInput $versionCreateInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                                | Description |
|-----------------------|-------------------------------------|-------------|
| `$projectId`          | **string**                          |             |
| `$environmentId`      | **string**                          |             |
| `$versionCreateInput` | **\Upsun\Model\VersionCreateInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deactivateEnvironment

Deactivate an environment

```php
public deactivateEnvironment(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

Destroy all services and data running on this environment so that only the Git branch remains. The environment
can be reactivated later at any time; reactivating an environment will sync data from the parent environment and
redeploy. **NOTE: ALL DATA IN THIS ENVIRONMENT WILL BE IRREVOCABLY LOST**

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/deactivate-environment

***

### deactivateEnvironmentWithHttpInfo

Deactivate an environment with HTTP Info

```php
private deactivateEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
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

### deactivateEnvironmentRequest

Create request for operation 'deactivateEnvironment'

```php
private deactivateEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteEnvironment

Delete an environment

```php
public deleteEnvironment(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

Delete a specified environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/delete-environment

***

### deleteEnvironmentWithHttpInfo

Delete an environment with HTTP Info

```php
private deleteEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
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

### deleteEnvironmentRequest

Create request for operation 'deleteEnvironment'

```php
private deleteEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteProjectsEnvironmentsVersions

Delete the version

```php
public deleteProjectsEnvironmentsVersions(string $projectId, string $environmentId, string $versionId): \Upsun\Model\AcceptedResponse
```

Delete the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if
the deployment target supports it).

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/delete-projects-environments-versions

***

### deleteProjectsEnvironmentsVersionsWithHttpInfo

Delete the version with HTTP Info

```php
private deleteProjectsEnvironmentsVersionsWithHttpInfo(string $projectId, string $environmentId, string $versionId): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteProjectsEnvironmentsVersionsRequest

Create request for operation 'deleteProjectsEnvironmentsVersions'

```php
private deleteProjectsEnvironmentsVersionsRequest(string $projectId, string $environmentId, string $versionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deployEnvironment

Deploy an environment

```php
public deployEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentDeployInput $environmentDeployInput): \Upsun\Model\AcceptedResponse
```

Trigger a controlled [manual
deployment](https://docs.upsun.com/learn/overview/build-deploy.html#manual-deployment) to release all the staged
changes

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentDeployInput` | **\Upsun\Model\EnvironmentDeployInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/deploy-environment

***

### deployEnvironmentWithHttpInfo

Deploy an environment with HTTP Info

```php
private deployEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentDeployInput $environmentDeployInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentDeployInput` | **\Upsun\Model\EnvironmentDeployInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deployEnvironmentRequest

Create request for operation 'deployEnvironment'

```php
private deployEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentDeployInput $environmentDeployInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                 | Type                                    | Description |
|---------------------------|-----------------------------------------|-------------|
| `$projectId`              | **string**                              |             |
| `$environmentId`          | **string**                              |             |
| `$environmentDeployInput` | **\Upsun\Model\EnvironmentDeployInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getEnvironment

Get an environment

```php
public getEnvironment(string $projectId, string $environmentId): \Upsun\Model\Environment
```

Retrieve the details of a single existing environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/get-environment

***

### getEnvironmentWithHttpInfo

Get an environment with HTTP Info

```php
private getEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\Environment
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

### getEnvironmentRequest

Create request for operation 'getEnvironment'

```php
private getEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getProjectsEnvironmentsVersions

List the version

```php
public getProjectsEnvironmentsVersions(string $projectId, string $environmentId, string $versionId): \Upsun\Model\Version
```

List the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if
the deployment target supports it).

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/get-projects-environments-versions

***

### getProjectsEnvironmentsVersionsWithHttpInfo

List the version with HTTP Info

```php
private getProjectsEnvironmentsVersionsWithHttpInfo(string $projectId, string $environmentId, string $versionId): \Upsun\Model\Version
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getProjectsEnvironmentsVersionsRequest

Create request for operation 'getProjectsEnvironmentsVersions'

```php
private getProjectsEnvironmentsVersionsRequest(string $projectId, string $environmentId, string $versionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |
| `$versionId`     | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### initializeEnvironment

Initialize a new environment

```php
public initializeEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentInitializeInput $environmentInitializeInput): \Upsun\Model\AcceptedResponse
```

Initialize and configure a new environment with an existing repository. The payload is the url of a git
repository with a profile name: ``` { "repository": "git@github.com:platformsh/a-project-template.git@master",
"profile": "Example Project", "files": [ { "mode": 0600, "path": "config.json", "contents": "XXXXXXXX" } ] } ```
It can optionally carry additional files that will be committed to the repository, the POSIX file mode to set on
each file, and the base64-encoded contents of each file. This endpoint can also add a second repository URL in
the `config` parameter that will be added to the contents of the first. This allows you to put your application
in one repository and the Upsun YAML configuration files in another.

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$environmentId`              | **string**                                  |             |
| `$environmentInitializeInput` | **\Upsun\Model\EnvironmentInitializeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/initialize-environment

***

### initializeEnvironmentWithHttpInfo

Initialize a new environment with HTTP Info

```php
private initializeEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentInitializeInput $environmentInitializeInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$environmentId`              | **string**                                  |             |
| `$environmentInitializeInput` | **\Upsun\Model\EnvironmentInitializeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### initializeEnvironmentRequest

Create request for operation 'initializeEnvironment'

```php
private initializeEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentInitializeInput $environmentInitializeInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                     | Type                                        | Description |
|-------------------------------|---------------------------------------------|-------------|
| `$projectId`                  | **string**                                  |             |
| `$environmentId`              | **string**                                  |             |
| `$environmentInitializeInput` | **\Upsun\Model\EnvironmentInitializeInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironments

Get list of project environments

```php
public listProjectsEnvironments(string $projectId): \Upsun\Model\Environment[]
```

Retrieve a list of a project's existing environments and the information associated with each environment.

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/list-projects-environments

***

### listProjectsEnvironmentsWithHttpInfo

Get list of project environments with HTTP Info

```php
private listProjectsEnvironmentsWithHttpInfo(string $projectId): \Upsun\Model\Environment[]
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listProjectsEnvironmentsRequest

Create request for operation 'listProjectsEnvironments'

```php
private listProjectsEnvironmentsRequest(string $projectId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$projectId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listProjectsEnvironmentsVersions

List versions associated with the environment

```php
public listProjectsEnvironmentsVersions(string $projectId, string $environmentId): \Upsun\Model\Version[]
```

List versions associated with the `{environmentId}` environment. At least one version always exists. When
multiple versions exist, it means that multiple versions of an app are deployed. The deployment target type
denotes whether staged deployment is supported.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/list-projects-environments-versions

***

### listProjectsEnvironmentsVersionsWithHttpInfo

List versions associated with the environment with HTTP Info

```php
private listProjectsEnvironmentsVersionsWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\Version[]
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

### listProjectsEnvironmentsVersionsRequest

Create request for operation 'listProjectsEnvironmentsVersions'

```php
private listProjectsEnvironmentsVersionsRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### mergeEnvironment

Merge an environment

```php
public mergeEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentMergeInput $environmentMergeInput): \Upsun\Model\AcceptedResponse
```

Merge an environment into its parent. This means that code changes from the branch environment will be merged
into the parent branch, and the parent branch will be rebuilt and deployed with the new code changes, retaining
the existing data in the parent environment.

**Parameters:**

| Parameter                | Type                                   | Description |
|--------------------------|----------------------------------------|-------------|
| `$projectId`             | **string**                             |             |
| `$environmentId`         | **string**                             |             |
| `$environmentMergeInput` | **\Upsun\Model\EnvironmentMergeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/merge-environment

***

### mergeEnvironmentWithHttpInfo

Merge an environment with HTTP Info

```php
private mergeEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentMergeInput $environmentMergeInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                | Type                                   | Description |
|--------------------------|----------------------------------------|-------------|
| `$projectId`             | **string**                             |             |
| `$environmentId`         | **string**                             |             |
| `$environmentMergeInput` | **\Upsun\Model\EnvironmentMergeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### mergeEnvironmentRequest

Create request for operation 'mergeEnvironment'

```php
private mergeEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentMergeInput $environmentMergeInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                | Type                                   | Description |
|--------------------------|----------------------------------------|-------------|
| `$projectId`             | **string**                             |             |
| `$environmentId`         | **string**                             |             |
| `$environmentMergeInput` | **\Upsun\Model\EnvironmentMergeInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### pauseEnvironment

Pause an environment

```php
public pauseEnvironment(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

Pause an environment, stopping all services and applications (except the router). Development environments are
often used for a limited time and then abandoned. To prevent unnecessary consumption of resources, development
environments that haven't been redeployed in 14 days are automatically paused. You can pause an environment
manually at any time using this endpoint. Further information is available in our [public
documentation](https://docs.upsun.com/anchors/environments/paused/).

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/pause-environment

***

### pauseEnvironmentWithHttpInfo

Pause an environment with HTTP Info

```php
private pauseEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
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

### pauseEnvironmentRequest

Create request for operation 'pauseEnvironment'

```php
private pauseEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### redeployEnvironment

Redeploy an environment

```php
public redeployEnvironment(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

Trigger the redeployment sequence of an environment.

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/redeploy-environment

***

### redeployEnvironmentWithHttpInfo

Redeploy an environment with HTTP Info

```php
private redeployEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
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

### redeployEnvironmentRequest

Create request for operation 'redeployEnvironment'

```php
private redeployEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### resumeEnvironment

Resume a paused environment

```php
public resumeEnvironment(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
```

Resume a paused environment, restarting all services and applications. Development environments that haven't been
used for 14 days will be paused automatically. They can be resumed via a redeployment or manually using this
endpoint or the CLI as described in the [public
documentation](https://docs.upsun.com/anchors/environments/paused/).

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/resume-environment

***

### resumeEnvironmentWithHttpInfo

Resume a paused environment with HTTP Info

```php
private resumeEnvironmentWithHttpInfo(string $projectId, string $environmentId): \Upsun\Model\AcceptedResponse
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

### resumeEnvironmentRequest

Create request for operation 'resumeEnvironment'

```php
private resumeEnvironmentRequest(string $projectId, string $environmentId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$projectId`     | **string** |             |
| `$environmentId` | **string** |             |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### synchronizeEnvironment

Synchronize a child environment with its parent

```php
public synchronizeEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSynchronizeInput $environmentSynchronizeInput): \Upsun\Model\AcceptedResponse
```

This synchronizes the code and/or data of an environment with that of its parent, then redeploys the environment.
Synchronization is only possible if a branch has no unmerged commits and it can be fast-forwarded. If data
synchronization is specified, the data in the environment will be overwritten with that of its parent.

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$environmentId`               | **string**                                   |             |
| `$environmentSynchronizeInput` | **\Upsun\Model\EnvironmentSynchronizeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/synchronize-environment

***

### synchronizeEnvironmentWithHttpInfo

Synchronize a child environment with its parent with HTTP Info

```php
private synchronizeEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSynchronizeInput $environmentSynchronizeInput): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$environmentId`               | **string**                                   |             |
| `$environmentSynchronizeInput` | **\Upsun\Model\EnvironmentSynchronizeInput** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### synchronizeEnvironmentRequest

Create request for operation 'synchronizeEnvironment'

```php
private synchronizeEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentSynchronizeInput $environmentSynchronizeInput): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                      | Type                                         | Description |
|--------------------------------|----------------------------------------------|-------------|
| `$projectId`                   | **string**                                   |             |
| `$environmentId`               | **string**                                   |             |
| `$environmentSynchronizeInput` | **\Upsun\Model\EnvironmentSynchronizeInput** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateEnvironment

Update an environment

```php
public updateEnvironment(string $projectId, string $environmentId, \Upsun\Model\EnvironmentPatch $environmentPatch): \Upsun\Model\AcceptedResponse
```

Update the details of a single existing environment.

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$environmentId`    | **string**                        |             |
| `$environmentPatch` | **\Upsun\Model\EnvironmentPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/update-environment

***

### updateEnvironmentWithHttpInfo

Update an environment with HTTP Info

```php
private updateEnvironmentWithHttpInfo(string $projectId, string $environmentId, \Upsun\Model\EnvironmentPatch $environmentPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$environmentId`    | **string**                        |             |
| `$environmentPatch` | **\Upsun\Model\EnvironmentPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateEnvironmentRequest

Create request for operation 'updateEnvironment'

```php
private updateEnvironmentRequest(string $projectId, string $environmentId, \Upsun\Model\EnvironmentPatch $environmentPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter           | Type                              | Description |
|---------------------|-----------------------------------|-------------|
| `$projectId`        | **string**                        |             |
| `$environmentId`    | **string**                        |             |
| `$environmentPatch` | **\Upsun\Model\EnvironmentPatch** | (required)  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateProjectsEnvironmentsVersions

Update the version

```php
public updateProjectsEnvironmentsVersions(string $projectId, string $environmentId, string $versionId, \Upsun\Model\VersionPatch $versionPatch): \Upsun\Model\AcceptedResponse
```

Update the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if
the deployment target supports it).

**Parameters:**

| Parameter        | Type                          | Description |
|------------------|-------------------------------|-------------|
| `$projectId`     | **string**                    |             |
| `$environmentId` | **string**                    |             |
| `$versionId`     | **string**                    |             |
| `$versionPatch`  | **\Upsun\Model\VersionPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Environment/operation/update-projects-environments-versions

***

### updateProjectsEnvironmentsVersionsWithHttpInfo

Update the version with HTTP Info

```php
private updateProjectsEnvironmentsVersionsWithHttpInfo(string $projectId, string $environmentId, string $versionId, \Upsun\Model\VersionPatch $versionPatch): \Upsun\Model\AcceptedResponse
```

**Parameters:**

| Parameter        | Type                          | Description |
|------------------|-------------------------------|-------------|
| `$projectId`     | **string**                    |             |
| `$environmentId` | **string**                    |             |
| `$versionId`     | **string**                    |             |
| `$versionPatch`  | **\Upsun\Model\VersionPatch** | (required)  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateProjectsEnvironmentsVersionsRequest

Create request for operation 'updateProjectsEnvironmentsVersions'

```php
private updateProjectsEnvironmentsVersionsRequest(string $projectId, string $environmentId, string $versionId, \Upsun\Model\VersionPatch $versionPatch): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter        | Type                          | Description |
|------------------|-------------------------------|-------------|
| `$projectId`     | **string**                    |             |
| `$environmentId` | **string**                    |             |
| `$versionId`     | **string**                    |             |
| `$versionPatch`  | **\Upsun\Model\VersionPatch** | (required)  |

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
