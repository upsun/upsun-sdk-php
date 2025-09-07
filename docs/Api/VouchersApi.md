# Upsun\VouchersApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**applyOrgVoucher()**](VouchersApi.md#applyOrgVoucher) | **POST** /organizations/{organization_id}/vouchers/apply | Apply voucher
[**listOrgVouchers()**](VouchersApi.md#listOrgVouchers) | **GET** /organizations/{organization_id}/vouchers | List vouchers


## `applyOrgVoucher()`

```php
applyOrgVoucher($organizationId, $applyOrgVoucherRequest)
```

Apply voucher

Applies a voucher for the specified organization, and refreshes the currently open order.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\VouchersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$applyOrgVoucherRequest = new \Upsun\Model\ApplyOrgVoucherRequest(); // \Upsun\Model\ApplyOrgVoucherRequest

try {
    $apiInstance->applyOrgVoucher($organizationId, $applyOrgVoucherRequest);
} catch (Exception $e) {
    echo 'Exception when calling VouchersApi->applyOrgVoucher: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **applyOrgVoucherRequest** | [**\Upsun\Model\ApplyOrgVoucherRequest**](../Model/ApplyOrgVoucherRequest.md)|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgVouchers()`

```php
listOrgVouchers($organizationId): \Upsun\Model\Vouchers
```

List vouchers

Retrieves vouchers for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\VouchersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->listOrgVouchers($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VouchersApi->listOrgVouchers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\Vouchers**](../Model/Vouchers.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
