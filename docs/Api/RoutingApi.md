# [Upsun\Api\RoutingApi](../src/Api/RoutingApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getProjectsEnvironmentsRoutes()**](RoutingApi.md#getProjectsEnvironmentsRoutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Get a route&#39;s info | https://docs.upsun.com/api/#tag/Routing/operation/get-projects-environments-routes |
| [**listProjectsEnvironmentsRoutes()**](RoutingApi.md#listProjectsEnvironmentsRoutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes | Get list of routes | https://docs.upsun.com/api/#tag/Routing/operation/list-projects-environments-routes |


## `getProjectsEnvironmentsRoutes()`

```php
getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId): \Upsun\Model\Route
```

Get a route's info

Get details of a route from an environment using the `id` of the entry retrieved by the [Get environment routes list](#tag/Environment-Routes%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1routes%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$routeId = 'routeId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsRoutes($projectId, $environmentId, $routeId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->getProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **routeId** | **string**|  | |

### Return type

[**\Upsun\Model\Route**](../Model/Route.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsRoutes()`

```php
listProjectsEnvironmentsRoutes($projectId, $environmentId): \Upsun\Model\Route[]
```

Get list of routes

Retrieve a list of objects containing route definitions for a specific environment. The definitions returned by this endpoint are those present in an environment's `.upsun/config.yaml` file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsRoutes($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->listProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\Route[]**](../Model/Route.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
