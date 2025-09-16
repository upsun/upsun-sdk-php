# Upsun\DiscountsApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getDiscount()**](DiscountsApi.md#getDiscount) | **GET** /discounts/{id} | Get an organization discount
[**getTypeAllowance()**](DiscountsApi.md#getTypeAllowance) | **GET** /discounts/types/allowance | Get the value of the First Project Incentive discount
[**listOrgDiscounts()**](DiscountsApi.md#listOrgDiscounts) | **GET** /organizations/{organization_id}/discounts | List organization discounts


## `getDiscount()`

```php
getDiscount($id): \Upsun\Model\Discount
```

Get an organization discount

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DiscountsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | The ID of the organization discount

try {
    $result = $apiInstance->getDiscount($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiscountsApi->getDiscount: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the organization discount |

### Return type

[**\Upsun\Model\Discount**](../Model/Discount.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTypeAllowance()`

```php
getTypeAllowance(): \Upsun\Model\GetTypeAllowance200Response
```

Get the value of the First Project Incentive discount

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DiscountsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getTypeAllowance();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiscountsApi->getTypeAllowance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\GetTypeAllowance200Response**](../Model/GetTypeAllowance200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgDiscounts()`

```php
listOrgDiscounts($organizationId): \Upsun\Model\ListOrgDiscounts200Response
```

List organization discounts

Retrieves all applicable discounts granted to the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\DiscountsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->listOrgDiscounts($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DiscountsApi->listOrgDiscounts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\ListOrgDiscounts200Response**](../Model/ListOrgDiscounts200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
