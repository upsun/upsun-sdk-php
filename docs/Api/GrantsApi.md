# Upsun\GrantsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listUserExtendedAccess()**](GrantsApi.md#listUserExtendedAccess) | **GET** /users/{user_id}/extended-access | List extended access of a user


## `listUserExtendedAccess()`

```php
listUserExtendedAccess($user_id, $filter_resource_type, $filter_organization_id, $filter_permissions): \Upsun\Model\ListUserExtendedAccess200Response
```

List extended access of a user

List extended access of the given user, which includes both individual and team access to project and organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = Upsun\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Upsun\Api\GrantsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filter_resource_type = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `resource_type` (project or organization) using one or more operators.
$filter_organization_id = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filter_permissions = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `permissions` using one or more operators.

try {
    $result = $apiInstance->listUserExtendedAccess($user_id, $filter_resource_type, $filter_organization_id, $filter_permissions);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GrantsApi->listUserExtendedAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **filter_resource_type** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;resource_type&#x60; (project or organization) using one or more operators. | [optional]
 **filter_organization_id** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional]
 **filter_permissions** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;permissions&#x60; using one or more operators. | [optional]

### Return type

[**\Upsun\Model\ListUserExtendedAccess200Response**](../Model/ListUserExtendedAccess200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
