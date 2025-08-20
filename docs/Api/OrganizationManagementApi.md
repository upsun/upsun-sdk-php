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
estimateOrg($organization_id): \Upsun\Model\OrganizationEstimationObject
```

Estimate total spend

Estimates the total spend for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->estimateOrg($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->estimateOrg: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationEstimationObject**](../Model/OrganizationEstimationObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgBillingAlertConfig()`

```php
getOrgBillingAlertConfig($organization_id): \Upsun\Model\OrganizationAlertConfig
```

Get billing alert configuration

Retrieves billing alert configuration for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgBillingAlertConfig($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->getOrgBillingAlertConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationAlertConfig**](../Model/OrganizationAlertConfig.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgPrepaymentInfo()`

```php
getOrgPrepaymentInfo($organization_id): \Upsun\Model\GetOrgPrepaymentInfo200Response
```

Get organization prepayment information

Retrieves prepayment information for the specified organization, if applicable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->getOrgPrepaymentInfo($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->getOrgPrepaymentInfo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |

### Return type

[**\Upsun\Model\GetOrgPrepaymentInfo200Response**](../Model/GetOrgPrepaymentInfo200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgPrepaymentTransactions()`

```php
listOrgPrepaymentTransactions($organization_id): \Upsun\Model\ListOrgPrepaymentTransactions200Response
```

List organization prepayment transactions

Retrieves a list of prepayment transactions for the specified organization, if applicable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->listOrgPrepaymentTransactions($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->listOrgPrepaymentTransactions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |

### Return type

[**\Upsun\Model\ListOrgPrepaymentTransactions200Response**](../Model/ListOrgPrepaymentTransactions200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgBillingAlertConfig()`

```php
updateOrgBillingAlertConfig($organization_id, $update_org_billing_alert_config_request): \Upsun\Model\OrganizationAlertConfig
```

Update billing alert configuration

Updates billing alert configuration for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\OrganizationManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$update_org_billing_alert_config_request = new \Upsun\Model\UpdateOrgBillingAlertConfigRequest(); // \Upsun\Model\UpdateOrgBillingAlertConfigRequest

try {
    $result = $apiInstance->updateOrgBillingAlertConfig($organization_id, $update_org_billing_alert_config_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationManagementApi->updateOrgBillingAlertConfig: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **update_org_billing_alert_config_request** | [**\Upsun\Model\UpdateOrgBillingAlertConfigRequest**](../Model/UpdateOrgBillingAlertConfigRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\OrganizationAlertConfig**](../Model/OrganizationAlertConfig.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
