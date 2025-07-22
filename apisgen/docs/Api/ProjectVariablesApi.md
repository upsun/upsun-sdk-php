# OpenAPI\Client\ProjectVariablesApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsVariables()**](ProjectVariablesApi.md#createProjectsVariables) | **POST** /projects/{projectId}/variables | Add a project variable
[**deleteProjectsVariables()**](ProjectVariablesApi.md#deleteProjectsVariables) | **DELETE** /projects/{projectId}/variables/{projectVariableId} | Delete a project variable
[**getProjectsVariables()**](ProjectVariablesApi.md#getProjectsVariables) | **GET** /projects/{projectId}/variables/{projectVariableId} | Get a project variable
[**listProjectsVariables()**](ProjectVariablesApi.md#listProjectsVariables) | **GET** /projects/{projectId}/variables | Get list of project variables
[**updateProjectsVariables()**](ProjectVariablesApi.md#updateProjectsVariables) | **PATCH** /projects/{projectId}/variables/{projectVariableId} | Update a project variable


## `createProjectsVariables()`

```php
createProjectsVariables($project_id, $project_variable_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Add a project variable

Add a variable to a project. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. See the [Variables](https://docs.platform.sh/development/variables.html#project-variables) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_variable_create_input = new \OpenAPI\Client\Model\ProjectVariableCreateInput(); // \OpenAPI\Client\Model\ProjectVariableCreateInput | 

try {
    $result = $apiInstance->createProjectsVariables($project_id, $project_variable_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->createProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **project_variable_create_input** | [**\OpenAPI\Client\Model\ProjectVariableCreateInput**](../Model/ProjectVariableCreateInput.md)|  |

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

## `deleteProjectsVariables()`

```php
deleteProjectsVariables($project_id, $project_variable_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete a project variable

Delete a single user-defined project variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_variable_id = 'project_variable_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsVariables($project_id, $project_variable_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->deleteProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **project_variable_id** | **string**|  |

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

## `getProjectsVariables()`

```php
getProjectsVariables($project_id, $project_variable_id): \OpenAPI\Client\Model\ProjectVariable
```

Get a project variable

Retrieve a single user-defined project variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_variable_id = 'project_variable_id_example'; // string

try {
    $result = $apiInstance->getProjectsVariables($project_id, $project_variable_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->getProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **project_variable_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\ProjectVariable**](../Model/ProjectVariable.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsVariables()`

```php
listProjectsVariables($project_id): \OpenAPI\Client\Model\ProjectVariable[]
```

Get list of project variables

Retrieve a list of objects representing the user-defined variables within a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsVariables($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->listProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\ProjectVariable[]**](../Model/ProjectVariable.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsVariables()`

```php
updateProjectsVariables($project_id, $project_variable_id, $project_variable_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update a project variable

Update a single user-defined project variable. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. See the [Variables](https://docs.platform.sh/development/variables.html#project-variables) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectVariablesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_variable_id = 'project_variable_id_example'; // string
$project_variable_patch = new \OpenAPI\Client\Model\ProjectVariablePatch(); // \OpenAPI\Client\Model\ProjectVariablePatch | 

try {
    $result = $apiInstance->updateProjectsVariables($project_id, $project_variable_id, $project_variable_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectVariablesApi->updateProjectsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **project_variable_id** | **string**|  |
 **project_variable_patch** | [**\OpenAPI\Client\Model\ProjectVariablePatch**](../Model/ProjectVariablePatch.md)|  |

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
