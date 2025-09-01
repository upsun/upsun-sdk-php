# Upsun\PlansApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listPlans()**](PlansApi.md#listPlans) | **GET** /plans | List available plans


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
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
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
