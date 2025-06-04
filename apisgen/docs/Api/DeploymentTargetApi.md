# OpenAPI\Client\DeploymentTargetApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createProjectsDeployments()**](DeploymentTargetApi.md#createProjectsDeployments) | **POST** /projects/{projectId}/deployments | Create a project deployment target |
| [**deleteProjectsDeployments()**](DeploymentTargetApi.md#deleteProjectsDeployments) | **DELETE** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Delete a single project deployment target |
| [**getProjectsDeployments()**](DeploymentTargetApi.md#getProjectsDeployments) | **GET** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Get a single project deployment target |
| [**listProjectsDeployments()**](DeploymentTargetApi.md#listProjectsDeployments) | **GET** /projects/{projectId}/deployments | Get project deployment target info |
| [**updateProjectsDeployments()**](DeploymentTargetApi.md#updateProjectsDeployments) | **PATCH** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Update a project deployment |


## `createProjectsDeployments()`

```php
createProjectsDeployments($project_id, $deployment_target_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Create a project deployment target

Set the deployment target information for a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$deployment_target_create_input = new \OpenAPI\Client\Model\DeploymentTargetCreateInput(); // \OpenAPI\Client\Model\DeploymentTargetCreateInput | 

try {
    $result = $apiInstance->createProjectsDeployments($project_id, $deployment_target_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->createProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **deployment_target_create_input** | [**\OpenAPI\Client\Model\DeploymentTargetCreateInput**](../Model/DeploymentTargetCreateInput.md)|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsDeployments()`

```php
deleteProjectsDeployments($project_id, $deployment_target_configuration_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete a single project deployment target

Delete a single deployment target configuration associated with a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$deployment_target_configuration_id = 'deployment_target_configuration_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsDeployments($project_id, $deployment_target_configuration_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->deleteProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **deployment_target_configuration_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsDeployments()`

```php
getProjectsDeployments($project_id, $deployment_target_configuration_id): \OpenAPI\Client\Model\DeploymentTarget
```

Get a single project deployment target

Get a single deployment target configuration of a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$deployment_target_configuration_id = 'deployment_target_configuration_id_example'; // string

try {
    $result = $apiInstance->getProjectsDeployments($project_id, $deployment_target_configuration_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->getProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **deployment_target_configuration_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\DeploymentTarget**](../Model/DeploymentTarget.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsDeployments()`

```php
listProjectsDeployments($project_id): \OpenAPI\Client\Model\DeploymentTarget[]
```

Get project deployment target info

The deployment target information for the project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsDeployments($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->listProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\DeploymentTarget[]**](../Model/DeploymentTarget.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsDeployments()`

```php
updateProjectsDeployments($project_id, $deployment_target_configuration_id, $deployment_target_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update a project deployment

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$deployment_target_configuration_id = 'deployment_target_configuration_id_example'; // string
$deployment_target_patch = new \OpenAPI\Client\Model\DeploymentTargetPatch(); // \OpenAPI\Client\Model\DeploymentTargetPatch | 

try {
    $result = $apiInstance->updateProjectsDeployments($project_id, $deployment_target_configuration_id, $deployment_target_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->updateProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **deployment_target_configuration_id** | **string**|  | |
| **deployment_target_patch** | [**\OpenAPI\Client\Model\DeploymentTargetPatch**](../Model/DeploymentTargetPatch.md)|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
