# Upsun\AddOnsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getOrgAddons()**](AddOnsApi.md#getOrgAddons) | **GET** /organizations/{organization_id}/addons | Get add-ons


## `getOrgAddons()`

```php
getOrgAddons($organization_id): \Upsun\Model\OrganizationAddonsObject
```

Get add-ons

Retrieves information about the add-ons for an organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AddOnsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgAddons($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AddOnsApi->getOrgAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationAddonsObject**](../Model/OrganizationAddonsObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
