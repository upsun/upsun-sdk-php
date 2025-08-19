# OpenAPI\Client\GrantsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**listUserExtendedAccess()**](GrantsApi.md#listUserExtendedAccess) | **GET** /users/{user_id}/extended-access | List extended access of a user |


## `listUserExtendedAccess()`

```php
listUserExtendedAccess($user_id, $filter_resource_type, $filter_organization_id, $filter_permissions): \OpenAPI\Client\Model\ListUserExtendedAccess200Response
```

List extended access of a user

List extended access of the given user, which includes both individual and team access to project and organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\GrantsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filter_resource_type = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `resource_type` (project or organization) using one or more operators.
$filter_organization_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filter_permissions = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `permissions` using one or more operators.

try {
    $result = $apiInstance->listUserExtendedAccess($user_id, $filter_resource_type, $filter_organization_id, $filter_permissions);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GrantsApi->listUserExtendedAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **filter_resource_type** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;resource_type&#x60; (project or organization) using one or more operators. | [optional] |
| **filter_organization_id** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional] |
| **filter_permissions** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;permissions&#x60; using one or more operators. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListUserExtendedAccess200Response**](../Model/ListUserExtendedAccess200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
