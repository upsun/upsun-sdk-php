# [Upsun\Api\DeploymentTargetApi](../src/Api/DeploymentTargetApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createProjectsDeployments()**](DeploymentTargetApi.md#createProjectsDeployments) | **POST** /projects/{projectId}/deployments | Create a project deployment target | https://docs.upsun.com/api/#tag/Deployment-Target/operation/create-projects-deployments |
| [**deleteProjectsDeployments()**](DeploymentTargetApi.md#deleteProjectsDeployments) | **DELETE** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Delete a single project deployment target | https://docs.upsun.com/api/#tag/Deployment-Target/operation/delete-projects-deployments |
| [**getProjectsDeployments()**](DeploymentTargetApi.md#getProjectsDeployments) | **GET** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Get a single project deployment target | https://docs.upsun.com/api/#tag/Deployment-Target/operation/get-projects-deployments |
| [**listProjectsDeployments()**](DeploymentTargetApi.md#listProjectsDeployments) | **GET** /projects/{projectId}/deployments | Get project deployment target info | https://docs.upsun.com/api/#tag/Deployment-Target/operation/list-projects-deployments |
| [**updateProjectsDeployments()**](DeploymentTargetApi.md#updateProjectsDeployments) | **PATCH** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Update a project deployment | https://docs.upsun.com/api/#tag/Deployment-Target/operation/update-projects-deployments |


## `createProjectsDeployments()`

```php
createProjectsDeployments($projectId, $deploymentTargetCreateInput): \Upsun\Model\AcceptedResponse
```

Create a project deployment target

Set the deployment target information for a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$deploymentTargetCreateInput = new \Upsun\Model\DeploymentTargetCreateInput(); // \Upsun\Model\DeploymentTargetCreateInput | 

try {
    $result = $apiInstance->createProjectsDeployments($projectId, $deploymentTargetCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->createProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **deploymentTargetCreateInput** | [**\Upsun\Model\DeploymentTargetCreateInput**](../Model/DeploymentTargetCreateInput.md)|  | |

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

## `deleteProjectsDeployments()`

```php
deleteProjectsDeployments($projectId, $deploymentTargetConfigurationId): \Upsun\Model\AcceptedResponse
```

Delete a single project deployment target

Delete a single deployment target configuration associated with a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$deploymentTargetConfigurationId = 'deploymentTargetConfigurationId_example'; // string

try {
    $result = $apiInstance->deleteProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->deleteProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **deploymentTargetConfigurationId** | **string**|  | |

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

## `getProjectsDeployments()`

```php
getProjectsDeployments($projectId, $deploymentTargetConfigurationId): \Upsun\Model\DeploymentTarget
```

Get a single project deployment target

Get a single deployment target configuration of a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$deploymentTargetConfigurationId = 'deploymentTargetConfigurationId_example'; // string

try {
    $result = $apiInstance->getProjectsDeployments($projectId, $deploymentTargetConfigurationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->getProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **deploymentTargetConfigurationId** | **string**|  | |

### Return type

[**\Upsun\Model\DeploymentTarget**](../Model/DeploymentTarget.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsDeployments()`

```php
listProjectsDeployments($projectId): \Upsun\Model\DeploymentTarget[]
```

Get project deployment target info

The deployment target information for the project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsDeployments($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->listProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\DeploymentTarget[]**](../Model/DeploymentTarget.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsDeployments()`

```php
updateProjectsDeployments($projectId, $deploymentTargetConfigurationId, $deploymentTargetPatch): \Upsun\Model\AcceptedResponse
```

Update a project deployment

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$deploymentTargetConfigurationId = 'deploymentTargetConfigurationId_example'; // string
$deploymentTargetPatch = new \Upsun\Model\DeploymentTargetPatch(); // \Upsun\Model\DeploymentTargetPatch | 

try {
    $result = $apiInstance->updateProjectsDeployments($projectId, $deploymentTargetConfigurationId, $deploymentTargetPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->updateProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **deploymentTargetConfigurationId** | **string**|  | |
| **deploymentTargetPatch** | [**\Upsun\Model\DeploymentTargetPatch**](../Model/DeploymentTargetPatch.md)|  | |

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
