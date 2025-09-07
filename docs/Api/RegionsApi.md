# Upsun\RegionsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getRegion()**](RegionsApi.md#getRegion) | **GET** /regions/{region_id} | Get region
[**listRegions()**](RegionsApi.md#listRegions) | **GET** /regions | List regions


## `getRegion()`

```php
getRegion($regionId): \Upsun\Model\Region
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
$regionId = 'regionId_example'; // string | The ID of the region.

try {
    $result = $apiInstance->getRegion($regionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->getRegion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **regionId** | **string**| The ID of the region. |

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
listRegions($filterAvailable, $filterPrivate, $filterZone, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListRegions200Response
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
$filterAvailable = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `available` using one or more operators.
$filterPrivate = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `private` using one or more operators.
$filterZone = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `zone` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `id`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listRegions($filterAvailable, $filterPrivate, $filterZone, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RegionsApi->listRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filterAvailable** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;available&#x60; using one or more operators. | [optional]
 **filterPrivate** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;private&#x60; using one or more operators. | [optional]
 **filterZone** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;zone&#x60; using one or more operators. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
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
