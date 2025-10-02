# [Upsun\Api\PlansApi](../src/Api/PlansApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**listPlans()**](PlansApi.md#listPlans) | **GET** /plans | List available plans | https://docs.upsun.com/api/#tag/Plans/operation/list-plans |


## `listPlans()`

```php
listPlans(): \Upsun\Model\ListPlans200Response
```

List available plans

Retrieve information about plans and pricing on Platform.sh.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\PlansApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listPlans();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlansApi->listPlans: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\ListPlans200Response**](../Model/ListPlans200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
