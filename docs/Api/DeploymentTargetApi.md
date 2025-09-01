# Upsun\DeploymentTargetApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsDeployments()**](DeploymentTargetApi.md#createProjectsDeployments) | **POST** /projects/{projectId}/deployments | Create a project deployment target
[**deleteProjectsDeployments()**](DeploymentTargetApi.md#deleteProjectsDeployments) | **DELETE** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Delete a single project deployment target
[**getProjectsDeployments()**](DeploymentTargetApi.md#getProjectsDeployments) | **GET** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Get a single project deployment target
[**listProjectsDeployments()**](DeploymentTargetApi.md#listProjectsDeployments) | **GET** /projects/{projectId}/deployments | Get project deployment target info
[**updateProjectsDeployments()**](DeploymentTargetApi.md#updateProjectsDeployments) | **PATCH** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Update a project deployment


## `createProjectsDeployments()`

```php
createProjectsDeployments($project_id, $deployment_target_create_input): \Upsun\Model\AcceptedResponse
```

Create a project deployment target

Set the deployment target information for a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string
$deployment_target_create_input = new \Upsun\Model\DeploymentTargetCreateInput(); // \Upsun\Model\DeploymentTargetCreateInput | 

try {
    $result = $apiInstance->createProjectsDeployments($project_id, $deployment_target_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->createProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **deployment_target_create_input** | [**\Upsun\Model\DeploymentTargetCreateInput**](../Model/DeploymentTargetCreateInput.md)|  |

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
deleteProjectsDeployments($project_id, $deployment_target_configuration_id): \Upsun\Model\AcceptedResponse
```

Delete a single project deployment target

Delete a single deployment target configuration associated with a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **deployment_target_configuration_id** | **string**|  |

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
getProjectsDeployments($project_id, $deployment_target_configuration_id): \Upsun\Model\DeploymentTarget
```

Get a single project deployment target

Get a single deployment target configuration of a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **deployment_target_configuration_id** | **string**|  |

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
listProjectsDeployments($project_id): \Upsun\Model\DeploymentTarget[]
```

Get project deployment target info

The deployment target information for the project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

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
updateProjectsDeployments($project_id, $deployment_target_configuration_id, $deployment_target_patch): \Upsun\Model\AcceptedResponse
```

Update a project deployment

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentTargetApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string
$deployment_target_configuration_id = 'deployment_target_configuration_id_example'; // string
$deployment_target_patch = new \Upsun\Model\DeploymentTargetPatch(); // \Upsun\Model\DeploymentTargetPatch | 

try {
    $result = $apiInstance->updateProjectsDeployments($project_id, $deployment_target_configuration_id, $deployment_target_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeploymentTargetApi->updateProjectsDeployments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **deployment_target_configuration_id** | **string**|  |
 **deployment_target_patch** | [**\Upsun\Model\DeploymentTargetPatch**](../Model/DeploymentTargetPatch.md)|  |

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
