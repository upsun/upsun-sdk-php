# Upsun\ProjectSettingsApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectsSettings()**](ProjectSettingsApi.md#getProjectsSettings) | **GET** /projects/{projectId}/settings | Get list of project settings
[**updateProjectsSettings()**](ProjectSettingsApi.md#updateProjectsSettings) | **PATCH** /projects/{projectId}/settings | Update a project setting


## `getProjectsSettings()`

```php
getProjectsSettings($projectId): \Upsun\Model\ProjectSettings
```

Get list of project settings

Retrieve the global settings for a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectSettingsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->getProjectsSettings($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectSettingsApi->getProjectsSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\ProjectSettings**](../Model/ProjectSettings.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsSettings()`

```php
updateProjectsSettings($projectId, $projectSettingsPatch): \Upsun\Model\AcceptedResponse
```

Update a project setting

Update one or more project-level settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectSettingsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$projectSettingsPatch = new \Upsun\Model\ProjectSettingsPatch(); // \Upsun\Model\ProjectSettingsPatch | 

try {
    $result = $apiInstance->updateProjectsSettings($projectId, $projectSettingsPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectSettingsApi->updateProjectsSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **projectSettingsPatch** | [**\Upsun\Model\ProjectSettingsPatch**](../Model/ProjectSettingsPatch.md)|  |

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
