# [Upsun\Api\EnvironmentApi](../src/Api/EnvironmentApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**activateEnvironment()**](EnvironmentApi.md#activateEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/activate | Activate an environment | https://docs.upsun.com/api/#tag/Environment/operation/activate-environment |
| [**branchEnvironment()**](EnvironmentApi.md#branchEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/branch | Branch an environment | https://docs.upsun.com/api/#tag/Environment/operation/branch-environment |
| [**createProjectsEnvironmentsVersions()**](EnvironmentApi.md#createProjectsEnvironmentsVersions) | **POST** /projects/{projectId}/environments/{environmentId}/versions | Create versions associated with the environment | https://docs.upsun.com/api/#tag/Environment/operation/create-projects-environments-versions |
| [**deactivateEnvironment()**](EnvironmentApi.md#deactivateEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/deactivate | Deactivate an environment | https://docs.upsun.com/api/#tag/Environment/operation/deactivate-environment |
| [**deleteEnvironment()**](EnvironmentApi.md#deleteEnvironment) | **DELETE** /projects/{projectId}/environments/{environmentId} | Delete an environment | https://docs.upsun.com/api/#tag/Environment/operation/delete-environment |
| [**deleteProjectsEnvironmentsVersions()**](EnvironmentApi.md#deleteProjectsEnvironmentsVersions) | **DELETE** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | Delete the version | https://docs.upsun.com/api/#tag/Environment/operation/delete-projects-environments-versions |
| [**deployEnvironment()**](EnvironmentApi.md#deployEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/deploy | Deploy an environment | https://docs.upsun.com/api/#tag/Environment/operation/deploy-environment |
| [**getEnvironment()**](EnvironmentApi.md#getEnvironment) | **GET** /projects/{projectId}/environments/{environmentId} | Get an environment | https://docs.upsun.com/api/#tag/Environment/operation/get-environment |
| [**getProjectsEnvironmentsVersions()**](EnvironmentApi.md#getProjectsEnvironmentsVersions) | **GET** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | List the version | https://docs.upsun.com/api/#tag/Environment/operation/get-projects-environments-versions |
| [**initializeEnvironment()**](EnvironmentApi.md#initializeEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/initialize | Initialize a new environment | https://docs.upsun.com/api/#tag/Environment/operation/initialize-environment |
| [**listProjectsEnvironments()**](EnvironmentApi.md#listProjectsEnvironments) | **GET** /projects/{projectId}/environments | Get list of project environments | https://docs.upsun.com/api/#tag/Environment/operation/list-projects-environments |
| [**listProjectsEnvironmentsVersions()**](EnvironmentApi.md#listProjectsEnvironmentsVersions) | **GET** /projects/{projectId}/environments/{environmentId}/versions | List versions associated with the environment | https://docs.upsun.com/api/#tag/Environment/operation/list-projects-environments-versions |
| [**mergeEnvironment()**](EnvironmentApi.md#mergeEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/merge | Merge an environment | https://docs.upsun.com/api/#tag/Environment/operation/merge-environment |
| [**pauseEnvironment()**](EnvironmentApi.md#pauseEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/pause | Pause an environment | https://docs.upsun.com/api/#tag/Environment/operation/pause-environment |
| [**redeployEnvironment()**](EnvironmentApi.md#redeployEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/redeploy | Redeploy an environment | https://docs.upsun.com/api/#tag/Environment/operation/redeploy-environment |
| [**resumeEnvironment()**](EnvironmentApi.md#resumeEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/resume | Resume a paused environment | https://docs.upsun.com/api/#tag/Environment/operation/resume-environment |
| [**synchronizeEnvironment()**](EnvironmentApi.md#synchronizeEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/synchronize | Synchronize a child environment with its parent | https://docs.upsun.com/api/#tag/Environment/operation/synchronize-environment |
| [**updateEnvironment()**](EnvironmentApi.md#updateEnvironment) | **PATCH** /projects/{projectId}/environments/{environmentId} | Update an environment | https://docs.upsun.com/api/#tag/Environment/operation/update-environment |
| [**updateProjectsEnvironmentsVersions()**](EnvironmentApi.md#updateProjectsEnvironmentsVersions) | **PATCH** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | Update the version | https://docs.upsun.com/api/#tag/Environment/operation/update-projects-environments-versions |


## `activateEnvironment()`

```php
activateEnvironment($projectId, $environmentId, $environmentActivateInput): \Upsun\Model\AcceptedResponse
```

Activate an environment

Set the specified environment's status to active

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentActivateInput = new \Upsun\Model\EnvironmentActivateInput(); // \Upsun\Model\EnvironmentActivateInput | 

try {
    $result = $apiInstance->activateEnvironment($projectId, $environmentId, $environmentActivateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->activateEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentActivateInput** | [**\Upsun\Model\EnvironmentActivateInput**](../Model/EnvironmentActivateInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `branchEnvironment()`

```php
branchEnvironment($projectId, $environmentId, $environmentBranchInput): \Upsun\Model\AcceptedResponse
```

Branch an environment

Create a new environment as a branch of the current environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentBranchInput = new \Upsun\Model\EnvironmentBranchInput(); // \Upsun\Model\EnvironmentBranchInput | 

try {
    $result = $apiInstance->branchEnvironment($projectId, $environmentId, $environmentBranchInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->branchEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentBranchInput** | [**\Upsun\Model\EnvironmentBranchInput**](../Model/EnvironmentBranchInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createProjectsEnvironmentsVersions()`

```php
createProjectsEnvironmentsVersions($projectId, $environmentId, $versionCreateInput): \Upsun\Model\AcceptedResponse
```

Create versions associated with the environment

Create versions associated with the `{environmentId}` environment. At least one version always exists. When multiple versions exist, it means that multiple versions of an app are deployed. The deployment target type denotes whether staged deployment is supported.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$versionCreateInput = new \Upsun\Model\VersionCreateInput(); // \Upsun\Model\VersionCreateInput | 

try {
    $result = $apiInstance->createProjectsEnvironmentsVersions($projectId, $environmentId, $versionCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->createProjectsEnvironmentsVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **versionCreateInput** | [**\Upsun\Model\VersionCreateInput**](../Model/VersionCreateInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deactivateEnvironment()`

```php
deactivateEnvironment($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Deactivate an environment

Destroy all services and data running on this environment so that only the Git branch remains. The environment can be reactivated later at any time; reactivating an environment will sync data from the parent environment and redeploy.  **NOTE: ALL DATA IN THIS ENVIRONMENT WILL BE IRREVOCABLY LOST**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->deactivateEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->deactivateEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteEnvironment()`

```php
deleteEnvironment($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Delete an environment

Delete a specified environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->deleteEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->deleteEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsEnvironmentsVersions()`

```php
deleteProjectsEnvironmentsVersions($projectId, $environmentId, $versionId): \Upsun\Model\AcceptedResponse
```

Delete the version

Delete the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if the deployment target supports it).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$versionId = 'versionId_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->deleteProjectsEnvironmentsVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **versionId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deployEnvironment()`

```php
deployEnvironment($projectId, $environmentId, $environmentDeployInput): \Upsun\Model\AcceptedResponse
```

Deploy an environment

Trigger a controlled [manual deployment](https://docs.upsun.com/learn/overview/build-deploy.html#manual-deployment) to release all the staged changes

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentDeployInput = new \Upsun\Model\EnvironmentDeployInput(); // \Upsun\Model\EnvironmentDeployInput | 

try {
    $result = $apiInstance->deployEnvironment($projectId, $environmentId, $environmentDeployInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->deployEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentDeployInput** | [**\Upsun\Model\EnvironmentDeployInput**](../Model/EnvironmentDeployInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEnvironment()`

```php
getEnvironment($projectId, $environmentId): \Upsun\Model\Environment
```

Get an environment

Retrieve the details of a single existing environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->getEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->getEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\Environment**](../Model/Environment.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsEnvironmentsVersions()`

```php
getProjectsEnvironmentsVersions($projectId, $environmentId, $versionId): \Upsun\Model\Version
```

List the version

List the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if the deployment target supports it).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$versionId = 'versionId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsVersions($projectId, $environmentId, $versionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->getProjectsEnvironmentsVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **versionId** | **string**|  | |

### Return type

[**\Upsun\Model\Version**](../Model/Version.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `initializeEnvironment()`

```php
initializeEnvironment($projectId, $environmentId, $environmentInitializeInput): \Upsun\Model\AcceptedResponse
```

Initialize a new environment

Initialize and configure a new environment with an existing repository. The payload is the url of a git repository with a profile name:  ``` {     \"repository\": \"git@github.com:platformsh/a-project-template.git@master\",     \"profile\": \"Example Project\",     \"files\": [       {         \"mode\": 0600,         \"path\": \"config.json\",         \"contents\": \"XXXXXXXX\"       }     ] } ``` It can optionally carry additional files that will be committed to the repository, the POSIX file mode to set on each file, and the base64-encoded contents of each file.  This endpoint can also add a second repository URL in the `config` parameter that will be added to the contents of the first. This allows you to put your application in one repository and the Upsun YAML configuration files in another.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentInitializeInput = new \Upsun\Model\EnvironmentInitializeInput(); // \Upsun\Model\EnvironmentInitializeInput | 

try {
    $result = $apiInstance->initializeEnvironment($projectId, $environmentId, $environmentInitializeInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->initializeEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentInitializeInput** | [**\Upsun\Model\EnvironmentInitializeInput**](../Model/EnvironmentInitializeInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironments()`

```php
listProjectsEnvironments($projectId): \Upsun\Model\AcceptedResponse
```

Get list of project environments

Retrieve a list of a project's existing environments and the information associated with each environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironments($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->listProjectsEnvironments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsVersions()`

```php
listProjectsEnvironmentsVersions($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

List versions associated with the environment

List versions associated with the `{environmentId}` environment. At least one version always exists. When multiple versions exist, it means that multiple versions of an app are deployed. The deployment target type denotes whether staged deployment is supported.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsVersions($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->listProjectsEnvironmentsVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `mergeEnvironment()`

```php
mergeEnvironment($projectId, $environmentId, $environmentMergeInput): \Upsun\Model\AcceptedResponse
```

Merge an environment

Merge an environment into its parent. This means that code changes from the branch environment will be merged into the parent branch, and the parent branch will be rebuilt and deployed with the new code changes, retaining the existing data in the parent environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentMergeInput = new \Upsun\Model\EnvironmentMergeInput(); // \Upsun\Model\EnvironmentMergeInput | 

try {
    $result = $apiInstance->mergeEnvironment($projectId, $environmentId, $environmentMergeInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->mergeEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentMergeInput** | [**\Upsun\Model\EnvironmentMergeInput**](../Model/EnvironmentMergeInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `pauseEnvironment()`

```php
pauseEnvironment($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Pause an environment

Pause an environment, stopping all services and applications (except the router).  Development environments are often used for a limited time and then abandoned. To prevent unnecessary consumption of resources, development environments that haven't been redeployed in 14 days are automatically paused.  You can pause an environment manually at any time using this endpoint. Further information is available in our [public documentation](https://docs.upsun.com/anchors/environments/paused/).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->pauseEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->pauseEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `redeployEnvironment()`

```php
redeployEnvironment($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Redeploy an environment

Trigger the redeployment sequence of an environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->redeployEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->redeployEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resumeEnvironment()`

```php
resumeEnvironment($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Resume a paused environment

Resume a paused environment, restarting all services and applications.  Development environments that haven't been used for 14 days will be paused automatically. They can be resumed via a redeployment or manually using this endpoint or the CLI as described in the [public documentation](https://docs.upsun.com/anchors/environments/paused/).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->resumeEnvironment($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->resumeEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `synchronizeEnvironment()`

```php
synchronizeEnvironment($projectId, $environmentId, $environmentSynchronizeInput): \Upsun\Model\AcceptedResponse
```

Synchronize a child environment with its parent

This synchronizes the code and/or data of an environment with that of its parent, then redeploys the environment. Synchronization is only possible if a branch has no unmerged commits and it can be fast-forwarded.  If data synchronization is specified, the data in the environment will be overwritten with that of its parent.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentSynchronizeInput = new \Upsun\Model\EnvironmentSynchronizeInput(); // \Upsun\Model\EnvironmentSynchronizeInput | 

try {
    $result = $apiInstance->synchronizeEnvironment($projectId, $environmentId, $environmentSynchronizeInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->synchronizeEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentSynchronizeInput** | [**\Upsun\Model\EnvironmentSynchronizeInput**](../Model/EnvironmentSynchronizeInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateEnvironment()`

```php
updateEnvironment($projectId, $environmentId, $environmentPatch): \Upsun\Model\AcceptedResponse
```

Update an environment

Update the details of a single existing environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentPatch = new \Upsun\Model\EnvironmentPatch(); // \Upsun\Model\EnvironmentPatch | 

try {
    $result = $apiInstance->updateEnvironment($projectId, $environmentId, $environmentPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->updateEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentPatch** | [**\Upsun\Model\EnvironmentPatch**](../Model/EnvironmentPatch.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsEnvironmentsVersions()`

```php
updateProjectsEnvironmentsVersions($projectId, $environmentId, $versionId, $versionPatch): \Upsun\Model\AcceptedResponse
```

Update the version

Update the `{versionId}` version. A routing percentage for this version may be specified for staged rollouts (if the deployment target supports it).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$versionId = 'versionId_example'; // string
$versionPatch = new \Upsun\Model\VersionPatch(); // \Upsun\Model\VersionPatch | 

try {
    $result = $apiInstance->updateProjectsEnvironmentsVersions($projectId, $environmentId, $versionId, $versionPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentApi->updateProjectsEnvironmentsVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **versionId** | **string**|  | |
| **versionPatch** | [**\Upsun\Model\VersionPatch**](../Model/VersionPatch.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
