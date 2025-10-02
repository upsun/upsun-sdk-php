# [Upsun\Api\GrantsApi](../src/Api/GrantsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**listUserExtendedAccess()**](GrantsApi.md#listUserExtendedAccess) | **GET** /users/{user_id}/extended-access | List extended access of a user | https://docs.upsun.com/api/#tag/Grants/operation/list-user-extended-access |


## `listUserExtendedAccess()`

```php
listUserExtendedAccess($userId, $filterResourceType, $filterOrganizationId, $filterPermissions): \Upsun\Model\ListUserExtendedAccess200Response
```

List extended access of a user

List extended access of the given user, which includes both individual and team access to project and organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\GrantsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filterResourceType = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `resource_type` (project or organization) using one or more operators.
$filterOrganizationId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filterPermissions = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `permissions` using one or more operators.

try {
    $result = $apiInstance->listUserExtendedAccess($userId, $filterResourceType, $filterOrganizationId, $filterPermissions);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GrantsApi->listUserExtendedAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **filterResourceType** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;resource_type&#x60; (project or organization) using one or more operators. | [optional] |
| **filterOrganizationId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional] |
| **filterPermissions** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;permissions&#x60; using one or more operators. | [optional] |

### Return type

[**\Upsun\Model\ListUserExtendedAccess200Response**](../Model/ListUserExtendedAccess200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
