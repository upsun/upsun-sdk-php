# OpenAPI\Client\UserAccessApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getUserProjectAccess()**](UserAccessApi.md#getUserProjectAccess) | **GET** /users/{user_id}/project-access/{project_id} | Get project access for a user |
| [**grantUserProjectAccess()**](UserAccessApi.md#grantUserProjectAccess) | **POST** /users/{user_id}/project-access | Grant project access to a user |
| [**listUserProjectAccess()**](UserAccessApi.md#listUserProjectAccess) | **GET** /users/{user_id}/project-access | List project access for a user |
| [**removeUserProjectAccess()**](UserAccessApi.md#removeUserProjectAccess) | **DELETE** /users/{user_id}/project-access/{project_id} | Remove project access for a user |
| [**updateUserProjectAccess()**](UserAccessApi.md#updateUserProjectAccess) | **PATCH** /users/{user_id}/project-access/{project_id} | Update project access for a user |


## `getUserProjectAccess()`

```php
getUserProjectAccess($user_id, $project_id): \OpenAPI\Client\Model\UserProjectAccess
```

Get project access for a user

Retrieves the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$project_id = 'project_id_example'; // string | The ID of the project.

try {
    $result = $apiInstance->getUserProjectAccess($user_id, $project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->getUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **project_id** | **string**| The ID of the project. | |

### Return type

[**\OpenAPI\Client\Model\UserProjectAccess**](../Model/UserProjectAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `grantUserProjectAccess()`

```php
grantUserProjectAccess($user_id, $grant_user_project_access_request_inner)
```

Grant project access to a user

Adds the user to one or more specified projects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$grant_user_project_access_request_inner = array(new \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner()); // \OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[]

try {
    $apiInstance->grantUserProjectAccess($user_id, $grant_user_project_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->grantUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **grant_user_project_access_request_inner** | [**\OpenAPI\Client\Model\GrantUserProjectAccessRequestInner[]**](../Model/GrantUserProjectAccessRequestInner.md)|  | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listUserProjectAccess()`

```php
listUserProjectAccess($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListProjectUserAccess200Response
```

List project access for a user

Returns a list of items representing the user's project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filter_organization_id = 'filter_organization_id_example'; // string | Allows filtering by `organization_id`.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listUserProjectAccess($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->listUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **filter_organization_id** | **string**| Allows filtering by &#x60;organization_id&#x60;. | [optional] |
| **page_size** | **int**| Determines the number of items to show. | [optional] |
| **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListProjectUserAccess200Response**](../Model/ListProjectUserAccess200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeUserProjectAccess()`

```php
removeUserProjectAccess($user_id, $project_id)
```

Remove project access for a user

Removes the user from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$project_id = 'project_id_example'; // string | The ID of the project.

try {
    $apiInstance->removeUserProjectAccess($user_id, $project_id);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->removeUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **project_id** | **string**| The ID of the project. | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUserProjectAccess()`

```php
updateUserProjectAccess($user_id, $project_id, $update_project_user_access_request)
```

Update project access for a user

Updates the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$project_id = 'project_id_example'; // string | The ID of the project.
$update_project_user_access_request = new \OpenAPI\Client\Model\UpdateProjectUserAccessRequest(); // \OpenAPI\Client\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateUserProjectAccess($user_id, $project_id, $update_project_user_access_request);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->updateUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **project_id** | **string**| The ID of the project. | |
| **update_project_user_access_request** | [**\OpenAPI\Client\Model\UpdateProjectUserAccessRequest**](../Model/UpdateProjectUserAccessRequest.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
