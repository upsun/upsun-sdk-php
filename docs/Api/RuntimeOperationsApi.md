# [Upsun\Api\RuntimeOperationsApi](../src/Api/RuntimeOperationsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**runOperation()**](RuntimeOperationsApi.md#runOperation) | **POST** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId}/operations | Execute a runtime operation | https://docs.upsun.com/api/#tag/Runtime-Operations/operation/run-operation |


## `runOperation()`

```php
runOperation($projectId, $environmentId, $deploymentId, $environmentOperationInput): \Upsun\Model\AcceptedResponse
```

Execute a runtime operation

Execute a runtime operation on a currently deployed environment. This allows you to run one-off commands, such as rebuilding static assets on demand, by defining an `operations` key in a project's `.upsun/config.yaml` configuration. More information on runtime operations is [available in our user documentation](https://docs.upsun.com/anchors/app/runtime-operations/).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RuntimeOperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **deploymentId** | **string**|  | |
| **environmentOperationInput** | [**\Upsun\Model\EnvironmentOperationInput**](../Model/EnvironmentOperationInput.md)|  | |

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
