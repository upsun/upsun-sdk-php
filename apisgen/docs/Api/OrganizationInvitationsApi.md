# OpenAPI\Client\OrganizationInvitationsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelOrgInvite()**](OrganizationInvitationsApi.md#cancelOrgInvite) | **DELETE** /organizations/{organization_id}/invitations/{invitation_id} | Cancel a pending invitation to an organization |
| [**createOrgInvite()**](OrganizationInvitationsApi.md#createOrgInvite) | **POST** /organizations/{organization_id}/invitations | Invite user to an organization by email |
| [**listOrgInvites()**](OrganizationInvitationsApi.md#listOrgInvites) | **GET** /organizations/{organization_id}/invitations | List invitations to an organization |


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


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **invitation_id** | **string**| The ID of the invitation. | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createOrgInvite()`

```php
createOrgInvite($organization_id, $create_org_invite_request): \OpenAPI\Client\Model\OrganizationInvitation
```

Invite user to an organization by email

Creates an invitation to an organization for a user with the specified email address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$create_org_invite_request = new \OpenAPI\Client\Model\CreateOrgInviteRequest(); // \OpenAPI\Client\Model\CreateOrgInviteRequest

try {
    $result = $apiInstance->createOrgInvite($organization_id, $create_org_invite_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationInvitationsApi->createOrgInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **create_org_invite_request** | [**\OpenAPI\Client\Model\CreateOrgInviteRequest**](../Model/CreateOrgInviteRequest.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\OrganizationInvitation**](../Model/OrganizationInvitation.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgInvites()`

```php
listOrgInvites($organization_id, $filter_state, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\OrganizationInvitation[]
```

List invitations to an organization

Returns a list of invitations to an organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationInvitationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$filter_state = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `state` of the invtations: \"pending\" (default), \"error\".
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **filter_state** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. | [optional] |
| **page_size** | **int**| Determines the number of items to show. | [optional] |
| **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional] |

### Return type

[**\OpenAPI\Client\Model\OrganizationInvitation[]**](../Model/OrganizationInvitation.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
