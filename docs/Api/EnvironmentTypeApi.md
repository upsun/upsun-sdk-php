# [Upsun\Api\EnvironmentTypeApi](../src/Api/EnvironmentTypeApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getEnvironmentType()**](EnvironmentTypeApi.md#getEnvironmentType) | **GET** /projects/{projectId}/environment-types/{environmentTypeId} | Get environment type links | https://docs.upsun.com/api/#tag/Environment-Type/operation/get-environment-type |
| [**listProjectsEnvironmentTypes()**](EnvironmentTypeApi.md#listProjectsEnvironmentTypes) | **GET** /projects/{projectId}/environment-types | Get environment types | https://docs.upsun.com/api/#tag/Environment-Type/operation/list-projects-environment-types |


## `getEnvironmentType()`

```php
getEnvironmentType($projectId, $environmentTypeId): \Upsun\Model\EnvironmentType
```

Get environment type links

Lists the endpoints used to retrieve info about the environment type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\EnvironmentTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentTypeId = 'environmentTypeId_example'; // string

try {
    $result = $apiInstance->getEnvironmentType($projectId, $environmentTypeId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeApi->getEnvironmentType: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentTypeId** | **string**|  | |

### Return type

[**\Upsun\Model\EnvironmentType**](../Model/EnvironmentType.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentTypes()`

```php
listProjectsEnvironmentTypes($projectId): \Upsun\Model\EnvironmentType[]
```

Get environment types

List all available environment types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\EnvironmentTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentTypes($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeApi->listProjectsEnvironmentTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\EnvironmentType[]**](../Model/EnvironmentType.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
