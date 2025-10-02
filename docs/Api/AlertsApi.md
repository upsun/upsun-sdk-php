# [Upsun\Api\AlertsApi](../src/Api/AlertsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getUsageAlerts()**](AlertsApi.md#getUsageAlerts) | **GET** /alerts/subscriptions/{subscriptionId}/usage | Get usage alerts for a subscription | https://docs.upsun.com/api/#tag/Alerts/operation/get-usage-alerts |
| [**updateUsageAlerts()**](AlertsApi.md#updateUsageAlerts) | **PATCH** /alerts/subscriptions/{subscriptionId}/usage | Update usage alerts. | https://docs.upsun.com/api/#tag/Alerts/operation/update-usage-alerts |


## `getUsageAlerts()`

```php
getUsageAlerts($subscriptionId): \Upsun\Model\GetUsageAlerts200Response
```

Get usage alerts for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription

try {
    $result = $apiInstance->getUsageAlerts($subscriptionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->getUsageAlerts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **subscriptionId** | **string**| The ID of the subscription | |

### Return type

[**\Upsun\Model\GetUsageAlerts200Response**](../Model/GetUsageAlerts200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUsageAlerts()`

```php
updateUsageAlerts($subscriptionId, $updateUsageAlertsRequest): \Upsun\Model\GetUsageAlerts200Response
```

Update usage alerts.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription
$updateUsageAlertsRequest = new \Upsun\Model\UpdateUsageAlertsRequest(); // \Upsun\Model\UpdateUsageAlertsRequest

try {
    $result = $apiInstance->updateUsageAlerts($subscriptionId, $updateUsageAlertsRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->updateUsageAlerts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **subscriptionId** | **string**| The ID of the subscription | |
| **updateUsageAlertsRequest** | [**\Upsun\Model\UpdateUsageAlertsRequest**](../Model/UpdateUsageAlertsRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\GetUsageAlerts200Response**](../Model/GetUsageAlerts200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
