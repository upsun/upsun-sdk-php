# Upsun\ProjectVariablesApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsVariables()**](ProjectVariablesApi.md#createProjectsVariables) | **POST** /projects/{projectId}/variables | Add a project variable
[**deleteProjectsVariables()**](ProjectVariablesApi.md#deleteProjectsVariables) | **DELETE** /projects/{projectId}/variables/{projectVariableId} | Delete a project variable
[**getProjectsVariables()**](ProjectVariablesApi.md#getProjectsVariables) | **GET** /projects/{projectId}/variables/{projectVariableId} | Get a project variable
[**listProjectsVariables()**](ProjectVariablesApi.md#listProjectsVariables) | **GET** /projects/{projectId}/variables | Get list of project variables
[**updateProjectsVariables()**](ProjectVariablesApi.md#updateProjectsVariables) | **PATCH** /projects/{projectId}/variables/{projectVariableId} | Update a project variable


## `createProjectsVariables()`

```php
createProjectsVariables($projectId, $projectVariableCreateInput): \Upsun\Model\AcceptedResponse
```

Add a project variable

Add a variable to a project. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. See the [Variables](https://docs.platform.sh/development/variables.html#project-variables) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectVariableCreateInput = new \Upsun\Model\ProjectVariableCreateInput(); // \Upsun\Model\ProjectVariableCreateInput | 

try {
    $result = $apiInstance->createProjectsVariables($projectId, $projectVariableCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->createProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectVariableCreateInput** | [**\Upsun\Model\ProjectVariableCreateInput**](../Model/ProjectVariableCreateInput.md)|  |

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

## `deleteProjectsVariables()`

```php
deleteProjectsVariables($projectId, $projectVariableId): \Upsun\Model\AcceptedResponse
```

Delete a project variable

Delete a single user-defined project variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectVariableId = 'projectVariableId_example'; // string

try {
    $result = $apiInstance->deleteProjectsVariables($projectId, $projectVariableId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->deleteProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectVariableId** | **string**|  |

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

## `getProjectsVariables()`

```php
getProjectsVariables($projectId, $projectVariableId): \Upsun\Model\ProjectVariable
```

Get a project variable

Retrieve a single user-defined project variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectVariableId = 'projectVariableId_example'; // string

try {
    $result = $apiInstance->getProjectsVariables($projectId, $projectVariableId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->getProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectVariableId** | **string**|  |

### Return type

[**\Upsun\Model\ProjectVariable**](../Model/ProjectVariable.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsVariables()`

```php
listProjectsVariables($projectId): \Upsun\Model\ProjectVariable[]
```

Get list of project variables

Retrieve a list of objects representing the user-defined variables within a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsVariables($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->listProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\ProjectVariable[]**](../Model/ProjectVariable.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsVariables()`

```php
updateProjectsVariables($projectId, $projectVariableId, $projectVariablePatch): \Upsun\Model\AcceptedResponse
```

Update a project variable

Update a single user-defined project variable. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. See the [Variables](https://docs.platform.sh/development/variables.html#project-variables) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectVariableId = 'projectVariableId_example'; // string
$projectVariablePatch = new \Upsun\Model\ProjectVariablePatch(); // \Upsun\Model\ProjectVariablePatch | 

try {
    $result = $apiInstance->updateProjectsVariables($projectId, $projectVariableId, $projectVariablePatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->updateProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectVariableId** | **string**|  |
 **projectVariablePatch** | [**\Upsun\Model\ProjectVariablePatch**](../Model/ProjectVariablePatch.md)|  |

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
