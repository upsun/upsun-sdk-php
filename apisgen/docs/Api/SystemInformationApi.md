# OpenAPI\Client\SystemInformationApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**actionProjectsSystemRestart()**](SystemInformationApi.md#actionProjectsSystemRestart) | **POST** /projects/{projectId}/system/restart | Restart the Git server
[**getProjectsSystem()**](SystemInformationApi.md#getProjectsSystem) | **GET** /projects/{projectId}/system | Get information about the Git server.


## `actionProjectsSystemRestart()`

```php
actionProjectsSystemRestart($project_id): \OpenAPI\Client\Model\AcceptedResponse
```

Restart the Git server

Force the Git server to restart.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SystemInformationApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->actionProjectsSystemRestart($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SystemInformationApi->actionProjectsSystemRestart: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

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

## `getProjectsSystem()`

```php
getProjectsSystem($project_id): \OpenAPI\Client\Model\SystemInformation
```

Get information about the Git server.

Output information for the project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SystemInformationApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->getProjectsSystem($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SystemInformationApi->getProjectsSystem: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\SystemInformation**](../Model/SystemInformation.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
