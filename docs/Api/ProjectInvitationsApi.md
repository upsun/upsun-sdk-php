# Upsun\ProjectInvitationsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelProjectInvite()**](ProjectInvitationsApi.md#cancelProjectInvite) | **DELETE** /projects/{project_id}/invitations/{invitation_id} | Cancel a pending invitation to a project
[**createProjectInvite()**](ProjectInvitationsApi.md#createProjectInvite) | **POST** /projects/{project_id}/invitations | Invite user to a project by email
[**listProjectInvites()**](ProjectInvitationsApi.md#listProjectInvites) | **GET** /projects/{project_id}/invitations | List invitations to a project


## `cancelProjectInvite()`

```php
cancelProjectInvite($project_id, $invitation_id)
```

Cancel a pending invitation to a project

Cancels the specified invitation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$invitation_id = 'invitation_id_example'; // string | The ID of the invitation.

try {
    $apiInstance->cancelProjectInvite($project_id, $invitation_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->cancelProjectInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
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

## `createProjectInvite()`

```php
createProjectInvite($project_id, $create_project_invite_request): \Upsun\Model\ProjectInvitation
```

Invite user to a project by email

Creates an invitation to a project for a user with the specified email address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$create_project_invite_request = new \Upsun\Model\CreateProjectInviteRequest(); // \Upsun\Model\CreateProjectInviteRequest

try {
    $result = $apiInstance->createProjectInvite($project_id, $create_project_invite_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->createProjectInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **create_project_invite_request** | [**\Upsun\Model\CreateProjectInviteRequest**](../Model/CreateProjectInviteRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\ProjectInvitation**](../Model/ProjectInvitation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectInvites()`

```php
listProjectInvites($project_id, $filter_state, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ProjectInvitation[]
```

List invitations to a project

Returns a list of invitations to a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ProjectInvitationsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$filter_state = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `state` of the invtations: \"pending\" (default), \"error\".
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listProjectInvites($project_id, $filter_state, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->listProjectInvites: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **filter_state** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional]

### Return type

[**\Upsun\Model\ProjectInvitation[]**](../Model/ProjectInvitation.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
