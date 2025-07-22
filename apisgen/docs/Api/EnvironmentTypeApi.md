# OpenAPI\Client\EnvironmentTypeApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getEnvironmentType()**](EnvironmentTypeApi.md#getEnvironmentType) | **GET** /projects/{projectId}/environment-types/{environmentTypeId} | Get environment type links
[**listProjectsEnvironmentTypes()**](EnvironmentTypeApi.md#listProjectsEnvironmentTypes) | **GET** /projects/{projectId}/environment-types | Get environment types


## `getEnvironmentType()`

```php
getEnvironmentType($project_id, $environment_type_id): \OpenAPI\Client\Model\EnvironmentType
```

Get environment type links

Lists the endpoints used to retrieve info about the environment type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string

try {
    $result = $apiInstance->getEnvironmentType($project_id, $environment_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeApi->getEnvironmentType: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_type_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\EnvironmentType**](../Model/EnvironmentType.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentTypes()`

```php
listProjectsEnvironmentTypes($project_id): \OpenAPI\Client\Model\EnvironmentType[]
```

Get environment types

List all available environment types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentTypes($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeApi->listProjectsEnvironmentTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\EnvironmentType[]**](../Model/EnvironmentType.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
