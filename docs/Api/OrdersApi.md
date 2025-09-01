# Upsun\OrdersApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAuthorizationCredentials()**](OrdersApi.md#createAuthorizationCredentials) | **POST** /organizations/{organization_id}/orders/{order_id}/authorize | Create confirmation credentials for for 3D-Secure
[**downloadInvoice()**](OrdersApi.md#downloadInvoice) | **GET** /orders/download | Download an invoice.
[**getOrgOrder()**](OrdersApi.md#getOrgOrder) | **GET** /organizations/{organization_id}/orders/{order_id} | Get order
[**listOrgOrders()**](OrdersApi.md#listOrgOrders) | **GET** /organizations/{organization_id}/orders | List orders


## `createAuthorizationCredentials()`

```php
createAuthorizationCredentials($organization_id, $order_id): \Upsun\Model\CreateAuthorizationCredentials200Response
```

Create confirmation credentials for for 3D-Secure

Creates confirmation credentials for payments that require online authorization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$order_id = 'order_id_example'; // string | The ID of the order.

try {
    $result = $apiInstance->createAuthorizationCredentials($organization_id, $order_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->createAuthorizationCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **order_id** | **string**| The ID of the order. |

### Return type

[**\Upsun\Model\CreateAuthorizationCredentials200Response**](../Model/CreateAuthorizationCredentials200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadInvoice()`

```php
downloadInvoice($token)
```

Download an invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$token = 'token_example'; // string | JWT for invoice.

try {
    $apiInstance->downloadInvoice($token);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->downloadInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| JWT for invoice. |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/pdf`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgOrder()`

```php
getOrgOrder($organization_id, $order_id, $mode): \Upsun\Model\Order
```

Get order

Retrieves an order for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **order_id** | **string**| The ID of the order. |
 **mode** | **string**| The output mode. | [optional]

### Return type

[**\Upsun\Model\Order**](../Model/Order.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgOrders()`

```php
listOrgOrders($organization_id, $filter_status, $filter_total, $page, $mode): \Upsun\Model\ListOrgOrders200Response
```

List orders

Retrieves orders for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filter_status** | **string**| The status of the order. | [optional]
 **filter_total** | **int**| The total of the order. | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]
 **mode** | **string**| The output mode. | [optional]

### Return type

[**\Upsun\Model\ListOrgOrders200Response**](../Model/ListOrgOrders200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
