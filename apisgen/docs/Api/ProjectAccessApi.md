# OpenAPI\Client\ProjectAccessApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createProjectsAccess()**](ProjectAccessApi.md#createProjectsAccess) | **POST** /projects/{projectId}/access | Add a user to a project ACL |
| [**deleteProjectsAccess()**](ProjectAccessApi.md#deleteProjectsAccess) | **DELETE** /projects/{projectId}/access/{projectAccessId} | Remove a user from a project |
| [**getProjectUserAccess()**](ProjectAccessApi.md#getProjectUserAccess) | **GET** /projects/{project_id}/user-access/{user_id} | Get user access for a project |
| [**getProjectsAccess()**](ProjectAccessApi.md#getProjectsAccess) | **GET** /projects/{projectId}/access/{projectAccessId} | Get a single project ACL entry |
| [**grantProjectUserAccess()**](ProjectAccessApi.md#grantProjectUserAccess) | **POST** /projects/{project_id}/user-access | Grant user access to a project |
| [**listProjectUserAccess()**](ProjectAccessApi.md#listProjectUserAccess) | **GET** /projects/{project_id}/user-access | List user access for a project |
| [**listProjectsAccess()**](ProjectAccessApi.md#listProjectsAccess) | **GET** /projects/{projectId}/access | Get a project&#39;s access control list |
| [**removeProjectUserAccess()**](ProjectAccessApi.md#removeProjectUserAccess) | **DELETE** /projects/{project_id}/user-access/{user_id} | Remove user access for a project |
| [**updateProjectUserAccess()**](ProjectAccessApi.md#updateProjectUserAccess) | **PATCH** /projects/{project_id}/user-access/{user_id} | Update user access for a project |
| [**updateProjectsAccess()**](ProjectAccessApi.md#updateProjectsAccess) | **PATCH** /projects/{projectId}/access/{projectAccessId} | Update a project user&#39;s role |


## `createProjectsAccess()`

```php
createProjectsAccess($project_id, $project_access_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Add a user to a project ACL

Add a user to a project's access control list  > **Note**: > > For more granular control and invitation by email, use [`/invitations`](#tag/Invitation).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_access_create_input = new \OpenAPI\Client\Model\ProjectAccessCreateInput(); // \OpenAPI\Client\Model\ProjectAccessCreateInput | 

try {
    $result = $apiInstance->createProjectsAccess($project_id, $project_access_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->createProjectsAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **project_access_create_input** | [**\OpenAPI\Client\Model\ProjectAccessCreateInput**](../Model/ProjectAccessCreateInput.md)|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsAccess()`

```php
deleteProjectsAccess($project_id, $project_access_id): \OpenAPI\Client\Model\AcceptedResponse
```

Remove a user from a project

Remove a user from a project's access control list using the `id` of the entry in the access control list retrieved with the [Get project access control list](#tag/Project-Access%2Fpaths%2F~1projects~1%7BprojectId%7D~1access%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_access_id = 'project_access_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsAccess($project_id, $project_access_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->deleteProjectsAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **project_access_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectUserAccess()`

```php
getProjectUserAccess($project_id, $user_id): \OpenAPI\Client\Model\UserProjectAccess
```

Get user access for a project

Retrieves the user's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getProjectUserAccess($project_id, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->getProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project. | |
| **user_id** | **string**| The ID of the user. | |

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

## `getProjectsAccess()`

```php
getProjectsAccess($project_id, $project_access_id): \OpenAPI\Client\Model\ProjectAccess
```

Get a single project ACL entry

Retrieve the details of a user from a project's access control list using the `id` of the entry in the access control list retrieved with the [Get project access control list](#tag/Project-Access%2Fpaths%2F~1projects~1%7BprojectId%7D~1access%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_access_id = 'project_access_id_example'; // string

try {
    $result = $apiInstance->getProjectsAccess($project_id, $project_access_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->getProjectsAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **project_access_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\ProjectAccess**](../Model/ProjectAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

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


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$grant_project_user_access_request_inner = array(new \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner()); // \OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[]

try {
    $apiInstance->grantProjectUserAccess($project_id, $grant_project_user_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->grantProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project. | |
| **grant_project_user_access_request_inner** | [**\OpenAPI\Client\Model\GrantProjectUserAccessRequestInner[]**](../Model/GrantProjectUserAccessRequestInner.md)|  | |

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

## `listProjectUserAccess()`

```php
listProjectUserAccess($project_id, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListProjectUserAccess200Response
```

List user access for a project

Returns a list of items representing the project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
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
    echo 'Exception when calling ProjectAccessApi->listProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project. | |
| **page_size** | **int**| Determines the number of items to show. | [optional] |
| **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

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

## `listProjectsAccess()`

```php
listProjectsAccess($project_id): \OpenAPI\Client\Model\ProjectAccess[]
```

Get a project's access control list

Retrieve a list of objects specifying the users with access to a project and those users' roles.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsAccess($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->listProjectsAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\ProjectAccess[]**](../Model/ProjectAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

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


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->removeProjectUserAccess($project_id, $user_id);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->removeProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project. | |
| **user_id** | **string**| The ID of the user. | |

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


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$update_project_user_access_request = new \OpenAPI\Client\Model\UpdateProjectUserAccessRequest(); // \OpenAPI\Client\Model\UpdateProjectUserAccessRequest

try {
    $apiInstance->updateProjectUserAccess($project_id, $user_id, $update_project_user_access_request);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->updateProjectUserAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**| The ID of the project. | |
| **user_id** | **string**| The ID of the user. | |
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

## `updateProjectsAccess()`

```php
updateProjectsAccess($project_id, $project_access_id, $project_access_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update a project user's role

Change the role of a user from a project's access control list using the `id` of the entry in the access control list retrieved with the [Get project access control list](#tag/Project-Access%2Fpaths%2F~1projects~1%7BprojectId%7D~1access%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$project_access_id = 'project_access_id_example'; // string
$project_access_patch = new \OpenAPI\Client\Model\ProjectAccessPatch(); // \OpenAPI\Client\Model\ProjectAccessPatch | 

try {
    $result = $apiInstance->updateProjectsAccess($project_id, $project_access_id, $project_access_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectAccessApi->updateProjectsAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **project_access_id** | **string**|  | |
| **project_access_patch** | [**\OpenAPI\Client\Model\ProjectAccessPatch**](../Model/ProjectAccessPatch.md)|  | |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
