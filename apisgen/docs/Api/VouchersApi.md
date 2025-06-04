# OpenAPI\Client\VouchersApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**applyOrgVoucher()**](VouchersApi.md#applyOrgVoucher) | **POST** /organizations/{organization_id}/vouchers/apply | Apply voucher |
| [**listOrgVouchers()**](VouchersApi.md#listOrgVouchers) | **GET** /organizations/{organization_id}/vouchers | List vouchers |


## `applyOrgVoucher()`

```php
applyOrgVoucher($organization_id, $apply_org_voucher_request)
```

Apply voucher

Applies a voucher for the specified organization, and refreshes the currently open order.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VouchersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$apply_org_voucher_request = new \OpenAPI\Client\Model\ApplyOrgVoucherRequest(); // \OpenAPI\Client\Model\ApplyOrgVoucherRequest

try {
    $apiInstance->applyOrgVoucher($organization_id, $apply_org_voucher_request);
} catch (Exception $e) {
    echo 'Exception when calling VouchersApi->applyOrgVoucher: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **apply_org_voucher_request** | [**\OpenAPI\Client\Model\ApplyOrgVoucherRequest**](../Model/ApplyOrgVoucherRequest.md)|  | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgVouchers()`

```php
listOrgVouchers($organization_id): \OpenAPI\Client\Model\Vouchers
```

List vouchers

Retrieves vouchers for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VouchersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->listOrgVouchers($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VouchersApi->listOrgVouchers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\OpenAPI\Client\Model\Vouchers**](../Model/Vouchers.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
