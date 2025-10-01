# [Upsun\Api\AddOnsApi](../src/Api/AddOnsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getOrgAddons()**](AddOnsApi.md#getOrgAddons) | **GET** /organizations/{organization_id}/addons | Get add-ons | https://docs.upsun.com/api/#tag/Add-ons/operation/get-org-addons |
| [**updateOrgAddons()**](AddOnsApi.md#updateOrgAddons) | **PATCH** /organizations/{organization_id}/addons | Update organization add-ons | https://docs.upsun.com/api/#tag/Add-ons/operation/update-org-addons |


## `getOrgAddons()`

```php
getOrgAddons($organizationId): \Upsun\Model\OrganizationAddonsObject
```

Get add-ons

Retrieves information about the add-ons for an organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AddOnsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgAddons($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AddOnsApi->getOrgAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

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

## `updateOrgAddons()`

```php
updateOrgAddons($organizationId, $updateOrgAddonsRequest): \Upsun\Model\OrganizationAddonsObject
```

Update organization add-ons

Updates the add-ons configuration for an organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\AddOnsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$updateOrgAddonsRequest = new \Upsun\Model\UpdateOrgAddonsRequest(); // \Upsun\Model\UpdateOrgAddonsRequest

try {
    $result = $apiInstance->updateOrgAddons($organizationId, $updateOrgAddonsRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AddOnsApi->updateOrgAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **updateOrgAddonsRequest** | [**\Upsun\Model\UpdateOrgAddonsRequest**](../Model/UpdateOrgAddonsRequest.md)|  | |

### Return type

[**\Upsun\Model\OrganizationAddonsObject**](../Model/OrganizationAddonsObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
