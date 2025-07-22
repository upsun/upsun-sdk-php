# OpenAPI\Client\ProjectSettingsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectsSettings()**](ProjectSettingsApi.md#getProjectsSettings) | **GET** /projects/{projectId}/settings | Get list of project settings
[**updateProjectsSettings()**](ProjectSettingsApi.md#updateProjectsSettings) | **PATCH** /projects/{projectId}/settings | Update a project setting


## `getProjectsSettings()`

```php
getProjectsSettings($project_id): \OpenAPI\Client\Model\ProjectSettings
```

Get list of project settings

Retrieve the global settings for a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectSettingsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->getProjectsSettings($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectSettingsApi->getProjectsSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\ProjectSettings**](../Model/ProjectSettings.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsSettings()`

```php
updateProjectsSettings($project_id, $project_settings_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update a project setting

Update one or more project-level settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectSettingsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_settings_patch = new \OpenAPI\Client\Model\ProjectSettingsPatch(); // \OpenAPI\Client\Model\ProjectSettingsPatch | 

try {
    $result = $apiInstance->updateProjectsSettings($project_id, $project_settings_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectSettingsApi->updateProjectsSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **project_settings_patch** | [**\OpenAPI\Client\Model\ProjectSettingsPatch**](../Model/ProjectSettingsPatch.md)|  |

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
