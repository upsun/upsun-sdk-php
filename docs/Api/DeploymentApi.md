# [Upsun\Api\DeploymentApi](../src/Api/DeploymentApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getProjectsEnvironmentsDeployments()**](DeploymentApi.md#getProjectsEnvironmentsDeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId} | Get a single environment deployment | https://docs.upsun.com/api/#tag/Deployment/operation/get-projects-environments-deployments |
| [**listProjectsEnvironmentsDeployments()**](DeploymentApi.md#listProjectsEnvironmentsDeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments | Get an environment&#39;s deployment information | https://docs.upsun.com/api/#tag/Deployment/operation/list-projects-environments-deployments |
| [**updateProjectsEnvironmentsDeploymentsNext()**](DeploymentApi.md#updateProjectsEnvironmentsDeploymentsNext) | **PATCH** /projects/{projectId}/environments/{environmentId}/deployments/next | Update the next deployment | https://docs.upsun.com/api/#tag/Deployment/operation/update-projects-environments-deployments-next |


## `getProjectsEnvironmentsDeployments()`

```php
getProjectsEnvironmentsDeployments($projectId, $environmentId, $deploymentId): \Upsun\Model\Deployment
```

Get a single environment deployment

Retrieve a single deployment configuration with an id of `current`. This may be subject to change in the future. Only `current` can be queried.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$deploymentId = 'deploymentId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsDeployments($projectId, $environmentId, $deploymentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentApi->getProjectsEnvironmentsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **deploymentId** | **string**|  | |

### Return type

[**\Upsun\Model\Deployment**](../Model/Deployment.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsDeployments()`

```php
listProjectsEnvironmentsDeployments($projectId, $environmentId): \Upsun\Model\Deployment[]
```

Get an environment's deployment information

Retrieve the read-only configuration of an environment's deployment. The returned information is everything required to recreate a project's current deployment.  More specifically, the objects returned by this endpoint contain the configuration derived from the repository's YAML configuration file: `.upsun/config.yaml`.  Additionally, any values deriving from environment variables, the domains attached to a project, project access settings, etc. are included here.  This endpoint currently returns a list containing a single deployment configuration with an `id` of `current`. This may be subject to change in the future.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsDeployments($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentApi->listProjectsEnvironmentsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\Deployment[]**](../Model/Deployment.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsEnvironmentsDeploymentsNext()`

```php
updateProjectsEnvironmentsDeploymentsNext($projectId, $environmentId, $updateProjectsEnvironmentsDeploymentsNextRequest): \Upsun\Model\AcceptedResponse
```

Update the next deployment

Update resources for either webapps, services, or workers in the next deployment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$updateProjectsEnvironmentsDeploymentsNextRequest = new \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest(); // \Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest

try {
    $result = $apiInstance->updateProjectsEnvironmentsDeploymentsNext($projectId, $environmentId, $updateProjectsEnvironmentsDeploymentsNextRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentApi->updateProjectsEnvironmentsDeploymentsNext: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **updateProjectsEnvironmentsDeploymentsNextRequest** | [**\Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest**](../Model/UpdateProjectsEnvironmentsDeploymentsNextRequest.md)|  | |

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
