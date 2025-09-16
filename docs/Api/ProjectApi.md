# Upsun\ProjectApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**actionProjectsClearBuildCache()**](ProjectApi.md#actionProjectsClearBuildCache) | **POST** /projects/{projectId}/clear_build_cache | Clear project build cache
[**getProjects()**](ProjectApi.md#getProjects) | **GET** /projects/{projectId} | Get a project
[**getProjectsCapabilities()**](ProjectApi.md#getProjectsCapabilities) | **GET** /projects/{projectId}/capabilities | Get a project&#39;s capabilities
[**updateProjects()**](ProjectApi.md#updateProjects) | **PATCH** /projects/{projectId} | Update a project


## `actionProjectsClearBuildCache()`

```php
actionProjectsClearBuildCache($projectId): \Upsun\Model\AcceptedResponse
```

Clear project build cache

On rare occasions, a project's build cache can become corrupted. This endpoint will entirely flush the project's build cache. More information on [clearing the build cache can be found in our user documentation.](https://docs.platform.sh/development/troubleshoot.html#clear-the-build-cache)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->actionProjectsClearBuildCache($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectApi->actionProjectsClearBuildCache: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

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

## `getProjects()`

```php
getProjects($projectId): \Upsun\Model\Project
```

Get a project

Retrieve the details of a single project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->getProjects($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectApi->getProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\Project**](../Model/Project.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsCapabilities()`

```php
getProjectsCapabilities($projectId): \Upsun\Model\ProjectCapabilities
```

Get a project's capabilities

Get a list of capabilities on a project, as defined by the billing system. For instance, one special capability that could be defined on a project is large development environments.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->getProjectsCapabilities($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectApi->getProjectsCapabilities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\ProjectCapabilities**](../Model/ProjectCapabilities.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjects()`

```php
updateProjects($projectId, $projectPatch): \Upsun\Model\AcceptedResponse
```

Update a project

Update the details of an existing project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectPatch = new \Upsun\Model\ProjectPatch(); // \Upsun\Model\ProjectPatch | 

try {
    $result = $apiInstance->updateProjects($projectId, $projectPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectApi->updateProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectPatch** | [**\Upsun\Model\ProjectPatch**](../Model/ProjectPatch.md)|  |

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
