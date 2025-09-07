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
getProjectUserAccess($projectId, $userId): \Upsun\Model\UserProjectAccess
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
$projectId = 'projectId_example'; // string | The ID of the project.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getProjectUserAccess($projectId, $userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->getProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **userId** | **string**| The ID of the user. |

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
getUserProjectAccess($userId, $projectId): \Upsun\Model\UserProjectAccess
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
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $result = $apiInstance->getUserProjectAccess($userId, $projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->getUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **projectId** | **string**| The ID of the project. |

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
grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner)
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
$projectId = 'projectId_example'; // string | The ID of the project.
$grantProjectUserAccessRequestInner = array(new \Upsun\Model\GrantProjectUserAccessRequestInner()); // \Upsun\Model\GrantProjectUserAccessRequestInner[]

try {
    $apiInstance->grantProjectUserAccess($projectId, $grantProjectUserAccessRequestInner);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->grantProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **grantProjectUserAccessRequestInner** | [**\Upsun\Model\GrantProjectUserAccessRequestInner[]**](../Model/GrantProjectUserAccessRequestInner.md)|  |

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
grantUserProjectAccess($userId, $grantUserProjectAccessRequestInner)
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
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$grantUserProjectAccessRequestInner = array(new \Upsun\Model\GrantUserProjectAccessRequestInner()); // \Upsun\Model\GrantUserProjectAccessRequestInner[]

try {
    $apiInstance->grantUserProjectAccess($userId, $grantUserProjectAccessRequestInner);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->grantUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **grantUserProjectAccessRequestInner** | [**\Upsun\Model\GrantUserProjectAccessRequestInner[]**](../Model/GrantUserProjectAccessRequestInner.md)|  |

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
listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListProjectUserAccess200Response
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
$projectId = 'projectId_example'; // string | The ID of the project.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listProjectUserAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->listProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
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
listUserProjectAccess($userId, $filterOrganizationId, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListProjectUserAccess200Response
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
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filterOrganizationId = 'filterOrganizationId_example'; // string | Allows filtering by `organization_id`.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listUserProjectAccess($userId, $filterOrganizationId, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->listUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **filterOrganizationId** | **string**| Allows filtering by &#x60;organization_id&#x60;. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
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
removeProjectUserAccess($projectId, $userId)
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
$projectId = 'projectId_example'; // string | The ID of the project.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->removeProjectUserAccess($projectId, $userId);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->removeProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **userId** | **string**| The ID of the user. |

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
removeUserProjectAccess($userId, $projectId)
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
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $apiInstance->removeUserProjectAccess($userId, $projectId);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->removeUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **projectId** | **string**| The ID of the project. |

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
updateProjectUserAccess($projectId, $userId, $updateProjectUserAccessRequest)
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
$projectId = 'projectId_example'; // string | The ID of the project.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$updateProjectUserAccessRequest = new \Upsun\Model\UpdateProjectUserAccessRequest(); // \Upsun\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateProjectUserAccess($projectId, $userId, $updateProjectUserAccessRequest);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->updateProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**| The ID of the project. |
 **userId** | **string**| The ID of the user. |
 **updateProjectUserAccessRequest** | [**\Upsun\Model\UpdateProjectUserAccessRequest**](../Model/UpdateProjectUserAccessRequest.md)|  | [optional]

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
updateUserProjectAccess($userId, $projectId, $updateProjectUserAccessRequest)
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
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$projectId = 'projectId_example'; // string | The ID of the project.
$updateProjectUserAccessRequest = new \Upsun\Model\UpdateProjectUserAccessRequest(); // \Upsun\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateUserProjectAccess($userId, $projectId, $updateProjectUserAccessRequest);
} catch (Exception $e) {
    echo 'Exception when calling UserAccessApi->updateUserProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **projectId** | **string**| The ID of the project. |
 **updateProjectUserAccessRequest** | [**\Upsun\Model\UpdateProjectUserAccessRequest**](../Model/UpdateProjectUserAccessRequest.md)|  | [optional]

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
