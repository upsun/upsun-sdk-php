# Upsun\AlertsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createUsageAlert()**](AlertsApi.md#createUsageAlert) | **POST** /alerts/subscriptions/{subscriptionId}/usage | Create a usage alert.
[**deleteUsageAlert()**](AlertsApi.md#deleteUsageAlert) | **DELETE** /alerts/subscriptions/{subscriptionId}/usage/{usageId} | Delete a usage alert.
[**getUsageAlerts()**](AlertsApi.md#getUsageAlerts) | **GET** /alerts/subscriptions/{subscriptionId}/usage | Get usage alerts for a subscription
[**updateUsageAlert()**](AlertsApi.md#updateUsageAlert) | **PATCH** /alerts/subscriptions/{subscriptionId}/usage/{usageId} | Update a usage alert.


## `createUsageAlert()`

```php
createUsageAlert($subscription_id, $create_usage_alert_request): \Upsun\Model\Alert
```

Create a usage alert.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription
$create_usage_alert_request = new \Upsun\Model\CreateUsageAlertRequest(); // \Upsun\Model\CreateUsageAlertRequest

try {
    $result = $apiInstance->createUsageAlert($subscription_id, $create_usage_alert_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->createUsageAlert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription |
 **create_usage_alert_request** | [**\Upsun\Model\CreateUsageAlertRequest**](../Model/CreateUsageAlertRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Alert**](../Model/Alert.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteUsageAlert()`

```php
deleteUsageAlert($subscription_id, $usage_id)
```

Delete a usage alert.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription
$usage_id = 'usage_id_example'; // string | The usage id of the alert.

try {
    $apiInstance->deleteUsageAlert($subscription_id, $usage_id);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->deleteUsageAlert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription |
 **usage_id** | **string**| The usage id of the alert. |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUsageAlerts()`

```php
getUsageAlerts($subscription_id): \Upsun\Model\GetUsageAlerts200Response
```

Get usage alerts for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription

try {
    $result = $apiInstance->getUsageAlerts($subscription_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->getUsageAlerts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription |

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

## `updateUsageAlert()`

```php
updateUsageAlert($subscription_id, $usage_id, $update_usage_alert_request): \Upsun\Model\Alert
```

Update a usage alert.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AlertsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription
$usage_id = 'usage_id_example'; // string | The usage id of the alert.
$update_usage_alert_request = new \Upsun\Model\UpdateUsageAlertRequest(); // \Upsun\Model\UpdateUsageAlertRequest

try {
    $result = $apiInstance->updateUsageAlert($subscription_id, $usage_id, $update_usage_alert_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AlertsApi->updateUsageAlert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription |
 **usage_id** | **string**| The usage id of the alert. |
 **update_usage_alert_request** | [**\Upsun\Model\UpdateUsageAlertRequest**](../Model/UpdateUsageAlertRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Alert**](../Model/Alert.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
