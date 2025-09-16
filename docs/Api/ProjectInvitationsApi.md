# Upsun\ProjectInvitationsApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelProjectInvite()**](ProjectInvitationsApi.md#cancelProjectInvite) | **DELETE** /projects/{project_id}/invitations/{invitation_id} | Cancel a pending invitation to a project
[**createProjectInvite()**](ProjectInvitationsApi.md#createProjectInvite) | **POST** /projects/{project_id}/invitations | Invite user to a project by email
[**listProjectInvites()**](ProjectInvitationsApi.md#listProjectInvites) | **GET** /projects/{project_id}/invitations | List invitations to a project


## `cancelProjectInvite()`

```php
cancelProjectInvite($projectId, $invitationId)
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
$projectId = 'projectId_example'; // string | The ID of the project.
$invitationId = 'invitationId_example'; // string | The ID of the invitation.

try {
    $apiInstance->cancelProjectInvite($projectId, $invitationId);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->cancelProjectInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
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

## `createProjectInvite()`

```php
createProjectInvite($projectId, $createProjectInviteRequest): \Upsun\Model\ProjectInvitation
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
$projectId = 'projectId_example'; // string | The ID of the project.
$createProjectInviteRequest = new \Upsun\Model\CreateProjectInviteRequest(); // \Upsun\Model\CreateProjectInviteRequest

try {
    $result = $apiInstance->createProjectInvite($projectId, $createProjectInviteRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->createProjectInvite: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **createProjectInviteRequest** | [**\Upsun\Model\CreateProjectInviteRequest**](../Model/CreateProjectInviteRequest.md)|  | [optional]

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
listProjectInvites($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ProjectInvitation[]
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
$projectId = 'projectId_example'; // string | The ID of the project.
$filterState = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `state` of the invtations: \"pending\" (default), \"error\".
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listProjectInvites($projectId, $filterState, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectInvitationsApi->listProjectInvites: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **filterState** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;state&#x60; of the invtations: \&quot;pending\&quot; (default), \&quot;error\&quot;. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
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
