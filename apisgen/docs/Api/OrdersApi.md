# OpenAPI\Client\OrdersApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getOrgOrder()**](OrdersApi.md#getOrgOrder) | **GET** /organizations/{organization_id}/orders/{order_id} | Get order |
| [**listOrgOrders()**](OrdersApi.md#listOrgOrders) | **GET** /organizations/{organization_id}/orders | List orders |


## `getOrgOrder()`

```php
getOrgOrder($organization_id, $order_id, $mode): \OpenAPI\Client\Model\Order
```

Get order

Retrieves an order for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$order_id = 'order_id_example'; // string | The ID of the order.
$mode = 'mode_example'; // string | The output mode.

try {
    $result = $apiInstance->getOrgOrder($organization_id, $order_id, $mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->getOrgOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **order_id** | **string**| The ID of the order. | |
| **mode** | **string**| The output mode. | [optional] |

### Return type

[**\OpenAPI\Client\Model\Order**](../Model/Order.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgOrders()`

```php
listOrgOrders($organization_id, $filter_status, $filter_total, $page, $mode): \OpenAPI\Client\Model\ListOrgOrders200Response
```

List orders

Retrieves orders for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_status = 'filter_status_example'; // string | The status of the order.
$filter_total = 56; // int | The total of the order.
$page = 56; // int | Page to be displayed. Defaults to 1.
$mode = 'mode_example'; // string | The output mode.

try {
    $result = $apiInstance->listOrgOrders($organization_id, $filter_status, $filter_total, $page, $mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->listOrgOrders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **filter_status** | **string**| The status of the order. | [optional] |
| **filter_total** | **int**| The total of the order. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |
| **mode** | **string**| The output mode. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListOrgOrders200Response**](../Model/ListOrgOrders200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
