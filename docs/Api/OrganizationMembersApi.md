# [Upsun\Api\OrganizationMembersApi](../src/Api/OrganizationMembersApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createOrgMember()**](OrganizationMembersApi.md#createOrgMember) | **POST** /organizations/{organization_id}/members | Create organization member | https://docs.upsun.com/api/#tag/Organization-Members/operation/create-org-member |
| [**deleteOrgMember()**](OrganizationMembersApi.md#deleteOrgMember) | **DELETE** /organizations/{organization_id}/members/{user_id} | Delete organization member | https://docs.upsun.com/api/#tag/Organization-Members/operation/delete-org-member |
| [**getOrgMember()**](OrganizationMembersApi.md#getOrgMember) | **GET** /organizations/{organization_id}/members/{user_id} | Get organization member | https://docs.upsun.com/api/#tag/Organization-Members/operation/get-org-member |
| [**listOrgMembers()**](OrganizationMembersApi.md#listOrgMembers) | **GET** /organizations/{organization_id}/members | List organization members | https://docs.upsun.com/api/#tag/Organization-Members/operation/list-org-members |
| [**updateOrgMember()**](OrganizationMembersApi.md#updateOrgMember) | **PATCH** /organizations/{organization_id}/members/{user_id} | Update organization member | https://docs.upsun.com/api/#tag/Organization-Members/operation/update-org-member |


## `createOrgMember()`

```php
createOrgMember($organizationId, $createOrgMemberRequest): \Upsun\Model\OrganizationMember
```

Create organization member

Creates a new organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$createOrgMemberRequest = new \Upsun\Model\CreateOrgMemberRequest(); // \Upsun\Model\CreateOrgMemberRequest

try {
    $result = $apiInstance->createOrgMember($organizationId, $createOrgMemberRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->createOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **createOrgMemberRequest** | [**\Upsun\Model\CreateOrgMemberRequest**](../Model/CreateOrgMemberRequest.md)|  | |

### Return type

[**\Upsun\Model\OrganizationMember**](../Model/OrganizationMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteOrgMember()`

```php
deleteOrgMember($organizationId, $userId)
```

Delete organization member

Deletes the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteOrgMember($organizationId, $userId);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->deleteOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **userId** | **string**| The ID of the user. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgMember()`

```php
getOrgMember($organizationId, $userId): \Upsun\Model\OrganizationMember
```

Get organization member

Retrieves the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getOrgMember($organizationId, $userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->getOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **userId** | **string**| The ID of the user. | |

### Return type

[**\Upsun\Model\OrganizationMember**](../Model/OrganizationMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgMembers()`

```php
listOrgMembers($organizationId, $filterPermissions, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListOrgMembers200Response
```

List organization members

Accessible to organization owners and members with the \"manage members\" permission.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filterPermissions = new \Upsun\Model\\Upsun\Model\ArrayFilter(); // \Upsun\Model\ArrayFilter | Allows filtering by `permissions` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `created_at`, `updated_at`.

try {
    $result = $apiInstance->listOrgMembers($organizationId, $filterPermissions, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->listOrgMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **filterPermissions** | [**\Upsun\Model\ArrayFilter**](../Model/.md)| Allows filtering by &#x60;permissions&#x60; using one or more operators. | [optional] |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\Upsun\Model\ListOrgMembers200Response**](../Model/ListOrgMembers200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgMember()`

```php
updateOrgMember($organizationId, $userId, $updateOrgMemberRequest): \Upsun\Model\OrganizationMember
```

Update organization member

Updates the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$updateOrgMemberRequest = new \Upsun\Model\UpdateOrgMemberRequest(); // \Upsun\Model\UpdateOrgMemberRequest

try {
    $result = $apiInstance->updateOrgMember($organizationId, $userId, $updateOrgMemberRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->updateOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **userId** | **string**| The ID of the user. | |
| **updateOrgMemberRequest** | [**\Upsun\Model\UpdateOrgMemberRequest**](../Model/UpdateOrgMemberRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\OrganizationMember**](../Model/OrganizationMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
