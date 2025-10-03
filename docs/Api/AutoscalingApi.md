# [Upsun\Api\AutoscalingApi](../src/Api/AutoscalingApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getAutoscalerSettings()**](AutoscalingApi.md#getAutoscalerSettings) | **GET** /projects/{projectId}/environments/{environmentId}/autoscaling/settings | Retrieves Autoscaler settings | https://docs.upsun.com/api/#tag/Autoscaling/operation/get-autoscaler-settings |
| [**patchAutoscalerSettings()**](AutoscalingApi.md#patchAutoscalerSettings) | **PATCH** /projects/{projectId}/environments/{environmentId}/autoscaling/settings | Modifies Autoscaler settings | https://docs.upsun.com/api/#tag/Autoscaling/operation/patch-autoscaler-settings |
| [**postAutoscalerAlert()**](AutoscalingApi.md#postAutoscalerAlert) | **POST** /projects/{projectId}/environments/{environmentId}/autoscaling/alerts |  | https://docs.upsun.com/api/#tag/Autoscaling/operation/post-autoscaler-alert |
| [**postAutoscalerSettings()**](AutoscalingApi.md#postAutoscalerSettings) | **POST** /projects/{projectId}/environments/{environmentId}/autoscaling/settings | Updates Autoscaler settings | https://docs.upsun.com/api/#tag/Autoscaling/operation/post-autoscaler-settings |


## `getAutoscalerSettings()`

```php
getAutoscalerSettings($projectId, $environmentId): \Upsun\Model\AutoscalerSettings
```

Retrieves Autoscaler settings

Retrieves the current Autoscaler configuration for a specific environment. This includes all thresholds, conditions, and rules currently applied. Use this endpoint to inspect how automatic scaling is configured.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AutoscalingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | A string that uniquely identifies the project
$environmentId = 'environmentId_example'; // string | A string that uniquely identifies the project environment

try {
    $result = $apiInstance->getAutoscalerSettings($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AutoscalingApi->getAutoscalerSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| A string that uniquely identifies the project | |
| **environmentId** | **string**| A string that uniquely identifies the project environment | |

### Return type

[**\Upsun\Model\AutoscalerSettings**](../Model/AutoscalerSettings.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `patchAutoscalerSettings()`

```php
patchAutoscalerSettings($projectId, $environmentId, $autoscalerSettings): \Upsun\Model\AutoscalerSettings
```

Modifies Autoscaler settings

Modifies the configuration of an existing Autoscaler for the specified environment. Use this endpoint to change scaling thresholds, conditions, or other autoscaling parameters without deleting the Autoscaler.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AutoscalingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | A string that uniquely identifies the project
$environmentId = 'environmentId_example'; // string | A string that uniquely identifies the project environment
$autoscalerSettings = new \Upsun\Model\AutoscalerSettings(); // \Upsun\Model\AutoscalerSettings | Settings to modify

try {
    $result = $apiInstance->patchAutoscalerSettings($projectId, $environmentId, $autoscalerSettings);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AutoscalingApi->patchAutoscalerSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| A string that uniquely identifies the project | |
| **environmentId** | **string**| A string that uniquely identifies the project environment | |
| **autoscalerSettings** | [**\Upsun\Model\AutoscalerSettings**](../Model/AutoscalerSettings.md)| Settings to modify | [optional] |

### Return type

[**\Upsun\Model\AutoscalerSettings**](../Model/AutoscalerSettings.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `postAutoscalerAlert()`

```php
postAutoscalerAlert($projectId, $environmentId, $autoscalerAlertPartial): \Upsun\Model\AcceptedResponse
```



Sends an Autoscaler alert for processing

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AutoscalingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | A string that uniquely identifies the project
$environmentId = 'environmentId_example'; // string | A string that uniquely identifies the project environment
$autoscalerAlertPartial = new \Upsun\Model\AutoscalerAlertPartial(); // \Upsun\Model\AutoscalerAlertPartial | Alert to process

try {
    $result = $apiInstance->postAutoscalerAlert($projectId, $environmentId, $autoscalerAlertPartial);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AutoscalingApi->postAutoscalerAlert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| A string that uniquely identifies the project | |
| **environmentId** | **string**| A string that uniquely identifies the project environment | |
| **autoscalerAlertPartial** | [**\Upsun\Model\AutoscalerAlertPartial**](../Model/AutoscalerAlertPartial.md)| Alert to process | [optional] |

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

## `postAutoscalerSettings()`

```php
postAutoscalerSettings($projectId, $environmentId, $autoscalerSettings): \Upsun\Model\AutoscalerSettings
```

Updates Autoscaler settings

Creates or updates the Autoscaler settings for a specific environment. Use this endpoint to define new autoscaling rules or override existing ones.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AutoscalingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | A string that uniquely identifies the project
$environmentId = 'environmentId_example'; // string | A string that uniquely identifies the project environment
$autoscalerSettings = new \Upsun\Model\AutoscalerSettings(); // \Upsun\Model\AutoscalerSettings | Settings to update

try {
    $result = $apiInstance->postAutoscalerSettings($projectId, $environmentId, $autoscalerSettings);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AutoscalingApi->postAutoscalerSettings: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| A string that uniquely identifies the project | |
| **environmentId** | **string**| A string that uniquely identifies the project environment | |
| **autoscalerSettings** | [**\Upsun\Model\AutoscalerSettings**](../Model/AutoscalerSettings.md)| Settings to update | [optional] |

### Return type

[**\Upsun\Model\AutoscalerSettings**](../Model/AutoscalerSettings.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
