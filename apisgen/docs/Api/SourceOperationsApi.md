# OpenAPI\Client\SourceOperationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listProjectsEnvironmentsSourceOperations()**](SourceOperationsApi.md#listProjectsEnvironmentsSourceOperations) | **GET** /projects/{projectId}/environments/{environmentId}/source-operations | List source operations
[**runSourceOperation()**](SourceOperationsApi.md#runSourceOperation) | **POST** /projects/{projectId}/environments/{environmentId}/source-operation | Trigger a source operation


## `listProjectsEnvironmentsSourceOperations()`

```php
listProjectsEnvironmentsSourceOperations($project_id, $environment_id): \OpenAPI\Client\Model\EnvironmentSourceOperation[]
```

List source operations

Lists all the source operations, defined in `.platform.app.yaml`, that are available in an environment. More information on source code operations is [available in our user documentation](https://docs.platform.sh/configuration/app/source-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SourceOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsSourceOperations($project_id, $environment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourceOperationsApi->listProjectsEnvironmentsSourceOperations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\EnvironmentSourceOperation[]**](../Model/EnvironmentSourceOperation.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `runSourceOperation()`

```php
runSourceOperation($project_id, $environment_id, $environment_source_operation_input): \OpenAPI\Client\Model\AcceptedResponse
```

Trigger a source operation

This endpoint triggers a source code operation as defined in the `source.operations` key in a project's `.platform.app.yaml` configuration. More information on source code operations is [available in our user documentation](https://docs.platform.sh/configuration/app/source-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SourceOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$environment_source_operation_input = new \OpenAPI\Client\Model\EnvironmentSourceOperationInput(); // \OpenAPI\Client\Model\EnvironmentSourceOperationInput | 

try {
    $result = $apiInstance->runSourceOperation($project_id, $environment_id, $environment_source_operation_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourceOperationsApi->runSourceOperation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **environment_source_operation_input** | [**\OpenAPI\Client\Model\EnvironmentSourceOperationInput**](../Model/EnvironmentSourceOperationInput.md)|  |

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
