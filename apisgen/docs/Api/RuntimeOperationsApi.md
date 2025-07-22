# OpenAPI\Client\RuntimeOperationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**runOperation()**](RuntimeOperationsApi.md#runOperation) | **POST** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId}/operations | Execute a runtime operation


## `runOperation()`

```php
runOperation($project_id, $environment_id, $deployment_id, $environment_operation_input): \OpenAPI\Client\Model\AcceptedResponse
```

Execute a runtime operation

Execute a runtime operation on a currently deployed environment. This allows you to run one-off commands, such as rebuilding static assets on demand, by defining an `operations` key in a project's `.platform.app.yaml` configuration. More information on runtime operations is [available in our user documentation](https://docs.platform.sh/create-apps/runtime-operations.html).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RuntimeOperationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$deployment_id = 'deployment_id_example'; // string
$environment_operation_input = new \OpenAPI\Client\Model\EnvironmentOperationInput(); // \OpenAPI\Client\Model\EnvironmentOperationInput | 

try {
    $result = $apiInstance->runOperation($project_id, $environment_id, $deployment_id, $environment_operation_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RuntimeOperationsApi->runOperation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **deployment_id** | **string**|  |
 **environment_operation_input** | [**\OpenAPI\Client\Model\EnvironmentOperationInput**](../Model/EnvironmentOperationInput.md)|  |

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
