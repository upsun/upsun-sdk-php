# Upsun\OrganizationManagementApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**estimateOrg()**](OrganizationManagementApi.md#estimateOrg) | **GET** /organizations/{organization_id}/estimate | Estimate total spend
[**getOrgBillingAlertConfig()**](OrganizationManagementApi.md#getOrgBillingAlertConfig) | **GET** /organizations/{organization_id}/alerts/billing | Get billing alert configuration
[**getOrgPrepaymentInfo()**](OrganizationManagementApi.md#getOrgPrepaymentInfo) | **GET** /organizations/{organization_id}/prepayment | Get organization prepayment information
[**listOrgPrepaymentTransactions()**](OrganizationManagementApi.md#listOrgPrepaymentTransactions) | **GET** /organizations/{organization_id}/prepayment/transactions | List organization prepayment transactions
[**updateOrgBillingAlertConfig()**](OrganizationManagementApi.md#updateOrgBillingAlertConfig) | **PATCH** /organizations/{organization_id}/alerts/billing | Update billing alert configuration


## `estimateOrg()`

```php
estimateOrg($organizationId): \Upsun\Model\OrganizationEstimationObject
```

Estimate total spend

Estimates the total spend for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->estimateOrg($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->estimateOrg: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationEstimationObject**](../Model/OrganizationEstimationObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgBillingAlertConfig()`

```php
getOrgBillingAlertConfig($organizationId): \Upsun\Model\OrganizationAlertConfig
```

Get billing alert configuration

Retrieves billing alert configuration for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgBillingAlertConfig($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->getOrgBillingAlertConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationAlertConfig**](../Model/OrganizationAlertConfig.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgPrepaymentInfo()`

```php
getOrgPrepaymentInfo($organizationId): \Upsun\Model\GetOrgPrepaymentInfo200Response
```

Get organization prepayment information

Retrieves prepayment information for the specified organization, if applicable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->getOrgPrepaymentInfo($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->getOrgPrepaymentInfo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |

### Return type

[**\Upsun\Model\GetOrgPrepaymentInfo200Response**](../Model/GetOrgPrepaymentInfo200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgPrepaymentTransactions()`

```php
listOrgPrepaymentTransactions($organizationId): \Upsun\Model\ListOrgPrepaymentTransactions200Response
```

List organization prepayment transactions

Retrieves a list of prepayment transactions for the specified organization, if applicable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->listOrgPrepaymentTransactions($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->listOrgPrepaymentTransactions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |

### Return type

[**\Upsun\Model\ListOrgPrepaymentTransactions200Response**](../Model/ListOrgPrepaymentTransactions200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgBillingAlertConfig()`

```php
updateOrgBillingAlertConfig($organizationId, $updateOrgBillingAlertConfigRequest): \Upsun\Model\OrganizationAlertConfig
```

Update billing alert configuration

Updates billing alert configuration for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$updateOrgBillingAlertConfigRequest = new \Upsun\Model\UpdateOrgBillingAlertConfigRequest(); // \Upsun\Model\UpdateOrgBillingAlertConfigRequest

try {
    $result = $apiInstance->updateOrgBillingAlertConfig($organizationId, $updateOrgBillingAlertConfigRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->updateOrgBillingAlertConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **updateOrgBillingAlertConfigRequest** | [**\Upsun\Model\UpdateOrgBillingAlertConfigRequest**](../Model/UpdateOrgBillingAlertConfigRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\OrganizationAlertConfig**](../Model/OrganizationAlertConfig.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
