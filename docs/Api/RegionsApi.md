# Upsun\RegionsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getRegion()**](RegionsApi.md#getRegion) | **GET** /regions/{region_id} | Get region
[**listRegions()**](RegionsApi.md#listRegions) | **GET** /regions | List regions


## `getRegion()`

```php
getRegion($region_id): \Upsun\Model\Region
```

Get region

Retrieves the specified region.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RegionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$region_id = 'region_id_example'; // string | The ID of the region.

try {
    $result = $apiInstance->getRegion($region_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->getRegion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **region_id** | **string**| The ID of the region. |

### Return type

[**\Upsun\Model\Region**](../Model/Region.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRegions()`

```php
listRegions($filter_available, $filter_private, $filter_zone, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListRegions200Response
```

List regions

Retrieves a list of available regions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RegionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$filter_available = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `available` using one or more operators.
$filter_private = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `private` using one or more operators.
$filter_zone = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `zone` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `id`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listRegions($filter_available, $filter_private, $filter_zone, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->listRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filter_available** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;available&#x60; using one or more operators. | [optional]
 **filter_private** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;private&#x60; using one or more operators. | [optional]
 **filter_zone** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;zone&#x60; using one or more operators. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;id&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\Upsun\Model\ListRegions200Response**](../Model/ListRegions200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
