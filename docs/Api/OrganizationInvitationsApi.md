# Upsun\OrganizationInvitationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelOrgInvite()**](OrganizationInvitationsApi.md#cancelOrgInvite) | **DELETE** /organizations/{organization_id}/invitations/{invitation_id} | Cancel a pending invitation to an organization
[**createOrgInvite()**](OrganizationInvitationsApi.md#createOrgInvite) | **POST** /organizations/{organization_id}/invitations | Invite user to an organization by email
[**listOrgInvites()**](OrganizationInvitationsApi.md#listOrgInvites) | **GET** /organizations/{organization_id}/invitations | List invitations to an organization


## `cancelOrgInvite()`

```php
cancelOrgInvite($organization_id, $invitation_id)
```

Cancel a pending invitation to an organization

Cancels the specified invitation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$invitation_id = 'invitation_id_example'; // string | The ID of the invitation.

try {
    $apiInstance->cancelOrgInvite($organization_id, $invitation_id);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->cancelOrgInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **invitation_id** | **string**| The ID of the invitation. |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createOrgInvite()`

```php
createOrgInvite($organization_id, $create_org_invite_request): \Upsun\Model\OrganizationInvitation
```

Invite user to an organization by email

Creates an invitation to an organization for a user with the specified email address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$create_org_invite_request = new \Upsun\Model\CreateOrgInviteRequest(); // \Upsun\Model\CreateOrgInviteRequest

try {
    $result = $apiInstance->createOrgInvite($organization_id, $create_org_invite_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->createOrgInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **create_org_invite_request** | [**\Upsun\Model\CreateOrgInviteRequest**](../Model/CreateOrgInviteRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\OrganizationInvitation**](../Model/OrganizationInvitation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgInvites()`

```php
listOrgInvites($organization_id, $filter_state, $page_size, $page_before, $page_after, $sort): \Upsun\Model\OrganizationInvitation[]
```

List invitations to an organization

Returns a list of invitations to an organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$filter_state = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `state` of the invtations: \"pending\" (default), \"error\".
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listOrgInvites($organization_id, $filter_state, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->listOrgInvites: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **filter_state** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional]

### Return type

[**\Upsun\Model\OrganizationInvitation[]**](../Model/OrganizationInvitation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
