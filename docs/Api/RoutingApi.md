# Upsun\RoutingApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsEnvironmentsRoutes()**](RoutingApi.md#createProjectsEnvironmentsRoutes) | **POST** /projects/{projectId}/environments/{environmentId}/routes | Create a new route
[**deleteProjectsEnvironmentsRoutes()**](RoutingApi.md#deleteProjectsEnvironmentsRoutes) | **DELETE** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Delete a route
[**getProjectsEnvironmentsRoutes()**](RoutingApi.md#getProjectsEnvironmentsRoutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Get a route&#39;s info
[**listProjectsEnvironmentsRoutes()**](RoutingApi.md#listProjectsEnvironmentsRoutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes | Get list of routes
[**updateProjectsEnvironmentsRoutes()**](RoutingApi.md#updateProjectsEnvironmentsRoutes) | **PATCH** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Update a route


## `createProjectsEnvironmentsRoutes()`

```php
createProjectsEnvironmentsRoutes($project_id, $environment_id, $route_create_input): \Upsun\Model\AcceptedResponse
```

Create a new route

Add a new route to the specified environment. More information about how routes are defined can be found in the [Routes](https://docs.platform.sh/configuration/routes.html) section of the documentation.  This endpoint modifies an environment's `.platform/routes.yaml` file. For routes to propagate to child environments, the child environments must be synchronized with their parent.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$route_create_input = new \Upsun\Model\RouteCreateInput(); // \Upsun\Model\RouteCreateInput | 

try {
    $result = $apiInstance->createProjectsEnvironmentsRoutes($project_id, $environment_id, $route_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->createProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **route_create_input** | [**\Upsun\Model\RouteCreateInput**](../Model/RouteCreateInput.md)|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsEnvironmentsRoutes()`

```php
deleteProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id): \Upsun\Model\AcceptedResponse
```

Delete a route

Remove a route from an environment using the `id` of the entry retrieved by the [Get environment routes list](#tag/Environment-Routes%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1routes%2Fget) endpoint.  This endpoint modifies an environment's `.platform/routes.yaml` file. For routes to propagate to child environments, the child environments must be synchronized with their parent.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$route_id = 'route_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->deleteProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **route_id** | **string**|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsEnvironmentsRoutes()`

```php
getProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id): \Upsun\Model\Route
```

Get a route's info

Get details of a route from an environment using the `id` of the entry retrieved by the [Get environment routes list](#tag/Environment-Routes%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1routes%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$route_id = 'route_id_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->getProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **route_id** | **string**|  |

### Return type

[**\Upsun\Model\Route**](../Model/Route.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsRoutes()`

```php
listProjectsEnvironmentsRoutes($project_id, $environment_id): \Upsun\Model\Route[]
```

Get list of routes

Retrieve a list of objects containing route definitions for a specific environment. The definitions returned by this endpoint are those present in an environment's `.platform/routes.yaml` file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsRoutes($project_id, $environment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->listProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |

### Return type

[**\Upsun\Model\Route[]**](../Model/Route.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsEnvironmentsRoutes()`

```php
updateProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id, $route_patch): \Upsun\Model\AcceptedResponse
```

Update a route

Update a route in an environment using the `id` of the entry retrieved by the [Get environment routes list](#tag/Environment-Routes%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1routes%2Fget) endpoint.  This endpoint modifies an environment's `.platform/routes.yaml` file. For routes to propagate to child environments, the child environments must be synchronized with their parent.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\RoutingApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$route_id = 'route_id_example'; // string
$route_patch = new \Upsun\Model\RoutePatch(); // \Upsun\Model\RoutePatch | 

try {
    $result = $apiInstance->updateProjectsEnvironmentsRoutes($project_id, $environment_id, $route_id, $route_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RoutingApi->updateProjectsEnvironmentsRoutes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **route_id** | **string**|  |
 **route_patch** | [**\Upsun\Model\RoutePatch**](../Model/RoutePatch.md)|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
