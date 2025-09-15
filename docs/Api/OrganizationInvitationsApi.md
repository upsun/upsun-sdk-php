# Upsun\OrganizationInvitationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelOrgInvite()**](OrganizationInvitationsApi.md#cancelOrgInvite) | **DELETE** /organizations/{organization_id}/invitations/{invitation_id} | Cancel a pending invitation to an organization
[**createOrgInvite()**](OrganizationInvitationsApi.md#createOrgInvite) | **POST** /organizations/{organization_id}/invitations | Invite user to an organization by email
[**listOrgInvites()**](OrganizationInvitationsApi.md#listOrgInvites) | **GET** /organizations/{organization_id}/invitations | List invitations to an organization


## `cancelOrgInvite()`

```php
cancelOrgInvite($organizationId, $invitationId)
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
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$invitationId = 'invitationId_example'; // string | The ID of the invitation.

try {
    $apiInstance->cancelOrgInvite($organizationId, $invitationId);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->cancelOrgInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **invitationId** | **string**| The ID of the invitation. |

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
createOrgInvite($organizationId, $createOrgInviteRequest): \Upsun\Model\OrganizationInvitation
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
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$createOrgInviteRequest = new \Upsun\Model\CreateOrgInviteRequest(); // \Upsun\Model\CreateOrgInviteRequest

try {
    $result = $apiInstance->createOrgInvite($organizationId, $createOrgInviteRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->createOrgInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **createOrgInviteRequest** | [**\Upsun\Model\CreateOrgInviteRequest**](../Model/CreateOrgInviteRequest.md)|  | [optional]

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
listOrgInvites($organizationId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\OrganizationInvitation[]
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
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$filterState = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `state` of the invtations: \"pending\" (default), \"error\".
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listOrgInvites($organizationId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->listOrgInvites: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **filterState** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
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
