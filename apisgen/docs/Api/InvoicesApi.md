# OpenAPI\Client\InvoicesApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getOrgInvoice()**](InvoicesApi.md#getOrgInvoice) | **GET** /organizations/{organization_id}/invoices/{invoice_id} | Get invoice |
| [**listOrgInvoices()**](InvoicesApi.md#listOrgInvoices) | **GET** /organizations/{organization_id}/invoices | List invoices |


## `getOrgInvoice()`

```php
getOrgInvoice($invoice_id, $organization_id): \OpenAPI\Client\Model\Invoice
```

Get invoice

Retrieves an invoice for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InvoicesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 'invoice_id_example'; // string | The ID of the invoice.
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgInvoice($invoice_id, $organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesApi->getOrgInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_id** | **string**| The ID of the invoice. | |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\OpenAPI\Client\Model\Invoice**](../Model/Invoice.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgInvoices()`

```php
listOrgInvoices($organization_id, $filter_status, $filter_type, $filter_order_id, $page): \OpenAPI\Client\Model\ListOrgInvoices200Response
```

List invoices

Retrieves a list of invoices for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InvoicesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_status = 'filter_status_example'; // string | The status of the invoice.
$filter_type = 'filter_type_example'; // string | The invoice type. Use invoice for standard invoices, credit_memo for refund/credit invoices.
$filter_order_id = 'filter_order_id_example'; // string | The order id of Invoice.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgInvoices($organization_id, $filter_status, $filter_type, $filter_order_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesApi->listOrgInvoices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **filter_status** | **string**| The status of the invoice. | [optional] |
| **filter_type** | **string**| The invoice type. Use invoice for standard invoices, credit_memo for refund/credit invoices. | [optional] |
| **filter_order_id** | **string**| The order id of Invoice. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListOrgInvoices200Response**](../Model/ListOrgInvoices200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
