# OpenAPI\Client\ProjectDiscoveryApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**locateProject()**](ProjectDiscoveryApi.md#locateProject) | **GET** /locate/{projectId} | Locate a single project |
| [**locateProjects()**](ProjectDiscoveryApi.md#locateProjects) | **GET** /locate | Locate user projects |


## `locateProject()`

```php
locateProject($project_id): \OpenAPI\Client\Model\ProjectLink
```

Locate a single project

Returns a project's endpoint and management console URLs, as well as information about the project owner.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectDiscoveryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project

try {
    $result = $apiInstance->locateProject($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectDiscoveryApi->locateProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project | |

### Return type

[**\OpenAPI\Client\Model\ProjectLink**](../Model/ProjectLink.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `locateProjects()`

```php
locateProjects($filter_owner, $page): \OpenAPI\Client\Model\LocateProjects200Response
```

Locate user projects

Returns a paginated list of all the projects associated with a given UUID. The returned information includes each project's respective endpoint and management console URLs, as well as information about the project owner.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectDiscoveryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$filter_owner = 'filter_owner_example'; // string | The UUID of the owner.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->locateProjects($filter_owner, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectDiscoveryApi->locateProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filter_owner** | **string**| The UUID of the owner. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |

### Return type

[**\OpenAPI\Client\Model\LocateProjects200Response**](../Model/LocateProjects200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
