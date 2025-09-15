# Upsun\RuntimeOperationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**runOperation()**](RuntimeOperationsApi.md#runOperation) | **POST** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId}/operations | Execute a runtime operation


## `runOperation()`

```php
runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput): \Upsun\Model\AcceptedResponse
```

Execute a runtime operation

Execute a runtime operation on a currently deployed environment. This allows you to run one-off commands, such as rebuilding static assets on demand, by defining an `operations` key in a project's `.platform.app.yaml` configuration. More information on runtime operations is [available in our user documentation](https://docs.platform.sh/create-apps/runtime-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RuntimeOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$deploymentId = 'deploymentId_example'; // string
$environmentOperationInput = new \Upsun\Model\EnvironmentOperationInput(); // \Upsun\Model\EnvironmentOperationInput | 

try {
    $result = $apiInstance->runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RuntimeOperationsApi->runOperation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |
 **deploymentId** | **string**|  |
 **environmentOperationInput** | [**\Upsun\Model\EnvironmentOperationInput**](../Model/EnvironmentOperationInput.md)|  |

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
