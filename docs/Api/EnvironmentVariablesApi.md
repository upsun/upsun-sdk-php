# [Upsun\Api\EnvironmentVariablesApi](../src/Api/EnvironmentVariablesApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createProjectsEnvironmentsVariables()**](EnvironmentVariablesApi.md#createProjectsEnvironmentsVariables) | **POST** /projects/{projectId}/environments/{environmentId}/variables | Add an environment variable | https://docs.upsun.com/api/#tag/Environment-Variables/operation/create-projects-environments-variables |
| [**deleteProjectsEnvironmentsVariables()**](EnvironmentVariablesApi.md#deleteProjectsEnvironmentsVariables) | **DELETE** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Delete an environment variable | https://docs.upsun.com/api/#tag/Environment-Variables/operation/delete-projects-environments-variables |
| [**getProjectsEnvironmentsVariables()**](EnvironmentVariablesApi.md#getProjectsEnvironmentsVariables) | **GET** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Get an environment variable | https://docs.upsun.com/api/#tag/Environment-Variables/operation/get-projects-environments-variables |
| [**listProjectsEnvironmentsVariables()**](EnvironmentVariablesApi.md#listProjectsEnvironmentsVariables) | **GET** /projects/{projectId}/environments/{environmentId}/variables | Get list of environment variables | https://docs.upsun.com/api/#tag/Environment-Variables/operation/list-projects-environments-variables |
| [**updateProjectsEnvironmentsVariables()**](EnvironmentVariablesApi.md#updateProjectsEnvironmentsVariables) | **PATCH** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Update an environment variable | https://docs.upsun.com/api/#tag/Environment-Variables/operation/update-projects-environments-variables |


## `createProjectsEnvironmentsVariables()`

```php
createProjectsEnvironmentsVariables($projectId, $environmentId, $environmentVariableCreateInput): \Upsun\Model\AcceptedResponse
```

Add an environment variable

Add a variable to an environment. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. Additionally, the inheritability of an environment variable can be determined through the `is_inheritable` flag (default: true). See the [Environment Variables](https://docs.upsun.com/anchors/variables/set/environment/create/) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentVariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentVariableCreateInput = new \Upsun\Model\EnvironmentVariableCreateInput(); // \Upsun\Model\EnvironmentVariableCreateInput | 

try {
    $result = $apiInstance->createProjectsEnvironmentsVariables($projectId, $environmentId, $environmentVariableCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentVariablesApi->createProjectsEnvironmentsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentVariableCreateInput** | [**\Upsun\Model\EnvironmentVariableCreateInput**](../Model/EnvironmentVariableCreateInput.md)|  | |

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

## `deleteProjectsEnvironmentsVariables()`

```php
deleteProjectsEnvironmentsVariables($projectId, $environmentId, $variableId): \Upsun\Model\AcceptedResponse
```

Delete an environment variable

Delete a single user-defined environment variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentVariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$variableId = 'variableId_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsVariables($projectId, $environmentId, $variableId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentVariablesApi->deleteProjectsEnvironmentsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **variableId** | **string**|  | |

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

## `getProjectsEnvironmentsVariables()`

```php
getProjectsEnvironmentsVariables($projectId, $environmentId, $variableId): \Upsun\Model\EnvironmentVariable
```

Get an environment variable

Retrieve a single user-defined environment variable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentVariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$variableId = 'variableId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsVariables($projectId, $environmentId, $variableId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentVariablesApi->getProjectsEnvironmentsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **variableId** | **string**|  | |

### Return type

[**\Upsun\Model\EnvironmentVariable**](../Model/EnvironmentVariable.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsVariables()`

```php
listProjectsEnvironmentsVariables($projectId, $environmentId): \Upsun\Model\AcceptedResponse
```

Get list of environment variables

Retrieve a list of objects representing the user-defined variables within an environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentVariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsVariables($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentVariablesApi->listProjectsEnvironmentsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

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

## `updateProjectsEnvironmentsVariables()`

```php
updateProjectsEnvironmentsVariables($projectId, $environmentId, $variableId, $environmentVariablePatch): \Upsun\Model\AcceptedResponse
```

Update an environment variable

Update a single user-defined environment variable. The `value` can be either a string or a JSON object (default: string), as specified by the `is_json` boolean flag. Additionally, the inheritability of an environment variable can be determined through the `is_inheritable` flag (default: true). See the [Variables](https://docs.upsun.com/anchors/variables/) section in our documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentVariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$variableId = 'variableId_example'; // string
$environmentVariablePatch = new \Upsun\Model\EnvironmentVariablePatch(); // \Upsun\Model\EnvironmentVariablePatch | 

try {
    $result = $apiInstance->updateProjectsEnvironmentsVariables($projectId, $environmentId, $variableId, $environmentVariablePatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentVariablesApi->updateProjectsEnvironmentsVariables: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **variableId** | **string**|  | |
| **environmentVariablePatch** | [**\Upsun\Model\EnvironmentVariablePatch**](../Model/EnvironmentVariablePatch.md)|  | |

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
