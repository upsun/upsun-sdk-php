# Upsun\DeploymentApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectsEnvironmentsDeployments()**](DeploymentApi.md#getProjectsEnvironmentsDeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId} | Get a single environment deployment
[**listProjectsEnvironmentsDeployments()**](DeploymentApi.md#listProjectsEnvironmentsDeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments | Get an environment&#39;s deployment information


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
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |
 **deploymentId** | **string**|  |

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

Retrieve the read-only configuration of an environment's deployment. The returned information is everything required to recreate a project's current deployment.  More specifically, the objects returned by this endpoint contain the configuration derived from the repository's YAML configuration files: `.platform.app.yaml`, `.platform/services.yaml`, and `.platform/routes.yaml`.  Additionally, any values deriving from environment variables, the domains attached to a project, project access settings, etc. are included here.  This endpoint currently returns a list containing a single deployment configuration with an `id` of `current`. This may be subject to change in the future.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DeploymentApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |

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
