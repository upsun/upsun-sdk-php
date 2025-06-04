# OpenAPI\Client\RegionsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**listOrgRegions()**](RegionsApi.md#listOrgRegions) | **GET** /organizations/{organization_id}/regions | List available regions |


## `listOrgRegions()`

```php
listOrgRegions($organization_id, $filter_zone, $filter_available, $filter_private, $page): \OpenAPI\Client\Model\ListOrgRegions200Response
```

List available regions

Retrieves the list of available regions for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RegionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_zone = 'filter_zone_example'; // string | Geographical zone of the region.
$filter_available = 'filter_available_example'; // string | Value 0 displays only disabled regions. Value 1 displays only enabled ones.
$filter_private = 'filter_private_example'; // string | Value 0 displays only public regions. Value 1 displays only private ones.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgRegions($organization_id, $filter_zone, $filter_available, $filter_private, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->listOrgRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **filter_zone** | **string**| Geographical zone of the region. | [optional] |
| **filter_available** | **string**| Value 0 displays only disabled regions. Value 1 displays only enabled ones. | [optional] |
| **filter_private** | **string**| Value 0 displays only public regions. Value 1 displays only private ones. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListOrgRegions200Response**](../Model/ListOrgRegions200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
