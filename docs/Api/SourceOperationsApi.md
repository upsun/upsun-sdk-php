# Upsun\SourceOperationsApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listProjectsEnvironmentsSourceOperations()**](SourceOperationsApi.md#listProjectsEnvironmentsSourceOperations) | **GET** /projects/{projectId}/environments/{environmentId}/source-operations | List source operations
[**runSourceOperation()**](SourceOperationsApi.md#runSourceOperation) | **POST** /projects/{projectId}/environments/{environmentId}/source-operation | Trigger a source operation


## `listProjectsEnvironmentsSourceOperations()`

```php
listProjectsEnvironmentsSourceOperations($projectId, $environmentId): \Upsun\Model\EnvironmentSourceOperation[]
```

List source operations

Lists all the source operations, defined in `.platform.app.yaml`, that are available in an environment. More information on source code operations is [available in our user documentation](https://docs.platform.sh/configuration/app/source-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SourceOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsSourceOperations($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourceOperationsApi->listProjectsEnvironmentsSourceOperations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |

### Return type

[**\Upsun\Model\EnvironmentSourceOperation[]**](../Model/EnvironmentSourceOperation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `runSourceOperation()`

```php
runSourceOperation($projectId, $environmentId, $environmentSourceOperationInput): \Upsun\Model\AcceptedResponse
```

Trigger a source operation

This endpoint triggers a source code operation as defined in the `source.operations` key in a project's `.platform.app.yaml` configuration. More information on source code operations is [available in our user documentation](https://docs.platform.sh/configuration/app/source-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SourceOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentSourceOperationInput = new \Upsun\Model\EnvironmentSourceOperationInput(); // \Upsun\Model\EnvironmentSourceOperationInput | 

try {
    $result = $apiInstance->runSourceOperation($projectId, $environmentId, $environmentSourceOperationInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourceOperationsApi->runSourceOperation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |
 **environmentSourceOperationInput** | [**\Upsun\Model\EnvironmentSourceOperationInput**](../Model/EnvironmentSourceOperationInput.md)|  |

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
