# Upsun\OrganizationMembersApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createOrgMember()**](OrganizationMembersApi.md#createOrgMember) | **POST** /organizations/{organization_id}/members | Create organization member
[**deleteOrgMember()**](OrganizationMembersApi.md#deleteOrgMember) | **DELETE** /organizations/{organization_id}/members/{user_id} | Delete organization member
[**getOrgMember()**](OrganizationMembersApi.md#getOrgMember) | **GET** /organizations/{organization_id}/members/{user_id} | Get organization member
[**listOrgMembers()**](OrganizationMembersApi.md#listOrgMembers) | **GET** /organizations/{organization_id}/members | List organization members
[**updateOrgMember()**](OrganizationMembersApi.md#updateOrgMember) | **PATCH** /organizations/{organization_id}/members/{user_id} | Update organization member


## `createOrgMember()`

```php
createOrgMember($organization_id, $create_org_member_request): \Upsun\Model\OrganizationMember
```

Create organization member

Creates a new organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$create_org_member_request = new \Upsun\Model\CreateOrgMemberRequest(); // \Upsun\Model\CreateOrgMemberRequest

try {
    $result = $apiInstance->createOrgMember($organization_id, $create_org_member_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->createOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **create_org_member_request** | [**\Upsun\Model\CreateOrgMemberRequest**](../Model/CreateOrgMemberRequest.md)|  |

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
deleteOrgMember($organization_id, $user_id)
```

Delete organization member

Deletes the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteOrgMember($organization_id, $user_id);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->deleteOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **user_id** | **string**| The ID of the user. |

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
getOrgMember($organization_id, $user_id): \Upsun\Model\OrganizationMember
```

Get organization member

Retrieves the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getOrgMember($organization_id, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->getOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **user_id** | **string**| The ID of the user. |

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
listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListOrgMembers200Response
```

List organization members

Accessible to organization owners and members with the \"manage members\" permission.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_permissions = new \Upsun\Model\\Upsun\Model\ArrayFilter(); // \Upsun\Model\ArrayFilter | Allows filtering by `permissions` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `created_at`, `updated_at`.

try {
    $result = $apiInstance->listOrgMembers($organization_id, $filter_permissions, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->listOrgMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filter_permissions** | [**\Upsun\Model\ArrayFilter**](../Model/.md)| Allows filtering by &#x60;permissions&#x60; using one or more operators. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional]

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
updateOrgMember($organization_id, $user_id, $update_org_member_request): \Upsun\Model\OrganizationMember
```

Update organization member

Updates the specified organization member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationMembersApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$update_org_member_request = new \Upsun\Model\UpdateOrgMemberRequest(); // \Upsun\Model\UpdateOrgMemberRequest

try {
    $result = $apiInstance->updateOrgMember($organization_id, $user_id, $update_org_member_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationMembersApi->updateOrgMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **user_id** | **string**| The ID of the user. |
 **update_org_member_request** | [**\Upsun\Model\UpdateOrgMemberRequest**](../Model/UpdateOrgMemberRequest.md)|  | [optional]

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
