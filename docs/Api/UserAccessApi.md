# Upsun\UserAccessApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectUserAccess()**](UserAccessApi.md#getProjectUserAccess) | **GET** /projects/{project_id}/user-access/{user_id} | Get user access for a project
[**getUserProjectAccess()**](UserAccessApi.md#getUserProjectAccess) | **GET** /users/{user_id}/project-access/{project_id} | Get project access for a user
[**grantProjectUserAccess()**](UserAccessApi.md#grantProjectUserAccess) | **POST** /projects/{project_id}/user-access | Grant user access to a project
[**grantUserProjectAccess()**](UserAccessApi.md#grantUserProjectAccess) | **POST** /users/{user_id}/project-access | Grant project access to a user
[**listProjectUserAccess()**](UserAccessApi.md#listProjectUserAccess) | **GET** /projects/{project_id}/user-access | List user access for a project
[**listUserProjectAccess()**](UserAccessApi.md#listUserProjectAccess) | **GET** /users/{user_id}/project-access | List project access for a user
[**removeProjectUserAccess()**](UserAccessApi.md#removeProjectUserAccess) | **DELETE** /projects/{project_id}/user-access/{user_id} | Remove user access for a project
[**removeUserProjectAccess()**](UserAccessApi.md#removeUserProjectAccess) | **DELETE** /users/{user_id}/project-access/{project_id} | Remove project access for a user
[**updateProjectUserAccess()**](UserAccessApi.md#updateProjectUserAccess) | **PATCH** /projects/{project_id}/user-access/{user_id} | Update user access for a project
[**updateUserProjectAccess()**](UserAccessApi.md#updateUserProjectAccess) | **PATCH** /users/{user_id}/project-access/{project_id} | Update project access for a user


## `getProjectUserAccess()`

```php
getProjectUserAccess($project_id, $user_id): \Upsun\Model\UserProjectAccess
```

Get user access for a project

Retrieves the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getProjectUserAccess($project_id, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->getProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **user_id** | **string**| The ID of the user. |

### Return type

[**\Upsun\Model\UserProjectAccess**](../Model/UserProjectAccess.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserProjectAccess()`

```php
getUserProjectAccess($user_id, $project_id): \Upsun\Model\UserProjectAccess
```

Get project access for a user

Retrieves the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **project_id** | **string**| The ID of the project. |

### Return type

[**\Upsun\Model\UserProjectAccess**](../Model/UserProjectAccess.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `grantProjectUserAccess()`

```php
grantProjectUserAccess($project_id, $grant_project_user_access_request_inner)
```

Grant user access to a project

Grants one or more users access to a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$grant_project_user_access_request_inner = array(new \Upsun\Model\GrantProjectUserAccessRequestInner()); // \Upsun\Model\GrantProjectUserAccessRequestInner[]

try {
    $apiInstance->grantProjectUserAccess($project_id, $grant_project_user_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->grantProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **grant_project_user_access_request_inner** | [**\Upsun\Model\GrantProjectUserAccessRequestInner[]**](../Model/GrantProjectUserAccessRequestInner.md)|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

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



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$grant_user_project_access_request_inner = array(new \Upsun\Model\GrantUserProjectAccessRequestInner()); // \Upsun\Model\GrantUserProjectAccessRequestInner[]

try {
    $apiInstance->grantUserProjectAccess($user_id, $grant_user_project_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->grantUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **grant_user_project_access_request_inner** | [**\Upsun\Model\GrantUserProjectAccessRequestInner[]**](../Model/GrantUserProjectAccessRequestInner.md)|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectUserAccess()`

```php
listProjectUserAccess($project_id, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListProjectUserAccess200Response
```

List user access for a project

Returns a list of items representing the project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listProjectUserAccess($project_id, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->listProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\Upsun\Model\ListProjectUserAccess200Response**](../Model/ListProjectUserAccess200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listUserProjectAccess()`

```php
listUserProjectAccess($user_id, $filter_organization_id, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListProjectUserAccess200Response
```

List project access for a user

Returns a list of items representing the user's project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **filter_organization_id** | **string**| Allows filtering by &#x60;organization_id&#x60;. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\Upsun\Model\ListProjectUserAccess200Response**](../Model/ListProjectUserAccess200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeProjectUserAccess()`

```php
removeProjectUserAccess($project_id, $user_id)
```

Remove user access for a project

Removes the user from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->removeProjectUserAccess($project_id, $user_id);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->removeProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
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



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **project_id** | **string**| The ID of the project. |

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

## `updateProjectUserAccess()`

```php
updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request)
```

Update user access for a project

Updates the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$update_project_user_access_request = new \Upsun\Model\UpdateProjectUserAccessRequest(); // \Upsun\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->updateProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **user_id** | **string**| The ID of the user. |
 **update_project_user_access_request** | [**\Upsun\Model\UpdateProjectUserAccessRequest**](../Model/UpdateProjectUserAccessRequest.md)|  | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
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



$apiInstance = new Upsun\Api\UserAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$project_id = 'project_id_example'; // string | The ID of the project.
$update_project_user_access_request = new \Upsun\Model\UpdateProjectUserAccessRequest(); // \Upsun\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateUserProjectAccess($user_id, $project_id, $update_project_user_access_request);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->updateUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **project_id** | **string**| The ID of the project. |
 **update_project_user_access_request** | [**\Upsun\Model\UpdateProjectUserAccessRequest**](../Model/UpdateProjectUserAccessRequest.md)|  | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
