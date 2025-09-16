# Upsun\SystemInformationApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**actionProjectsSystemRestart()**](SystemInformationApi.md#actionProjectsSystemRestart) | **POST** /projects/{projectId}/system/restart | Restart the Git server
[**getProjectsSystem()**](SystemInformationApi.md#getProjectsSystem) | **GET** /projects/{projectId}/system | Get information about the Git server.


## `actionProjectsSystemRestart()`

```php
actionProjectsSystemRestart($projectId): \Upsun\Model\AcceptedResponse
```

Restart the Git server

Force the Git server to restart.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SystemInformationApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->actionProjectsSystemRestart($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SystemInformationApi->actionProjectsSystemRestart: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

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

## `getProjectsSystem()`

```php
getProjectsSystem($projectId): \Upsun\Model\SystemInformation
```

Get information about the Git server.

Output information for the project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SystemInformationApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->getProjectsSystem($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SystemInformationApi->getProjectsSystem: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\SystemInformation**](../Model/SystemInformation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
