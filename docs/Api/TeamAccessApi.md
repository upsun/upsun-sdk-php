# [Upsun\Api\TeamAccessApi](../src/Api/TeamAccessApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getProjectTeamAccess()**](TeamAccessApi.md#getProjectTeamAccess) | **GET** /projects/{project_id}/team-access/{team_id} | Get team access for a project | https://docs.upsun.com/api/#tag/Team-Access/operation/get-project-team-access |
| [**getTeamProjectAccess()**](TeamAccessApi.md#getTeamProjectAccess) | **GET** /teams/{team_id}/project-access/{project_id} | Get project access for a team | https://docs.upsun.com/api/#tag/Team-Access/operation/get-team-project-access |
| [**grantProjectTeamAccess()**](TeamAccessApi.md#grantProjectTeamAccess) | **POST** /projects/{project_id}/team-access | Grant team access to a project | https://docs.upsun.com/api/#tag/Team-Access/operation/grant-project-team-access |
| [**grantTeamProjectAccess()**](TeamAccessApi.md#grantTeamProjectAccess) | **POST** /teams/{team_id}/project-access | Grant project access to a team | https://docs.upsun.com/api/#tag/Team-Access/operation/grant-team-project-access |
| [**listProjectTeamAccess()**](TeamAccessApi.md#listProjectTeamAccess) | **GET** /projects/{project_id}/team-access | List team access for a project | https://docs.upsun.com/api/#tag/Team-Access/operation/list-project-team-access |
| [**listTeamProjectAccess()**](TeamAccessApi.md#listTeamProjectAccess) | **GET** /teams/{team_id}/project-access | List project access for a team | https://docs.upsun.com/api/#tag/Team-Access/operation/list-team-project-access |
| [**removeProjectTeamAccess()**](TeamAccessApi.md#removeProjectTeamAccess) | **DELETE** /projects/{project_id}/team-access/{team_id} | Remove team access for a project | https://docs.upsun.com/api/#tag/Team-Access/operation/remove-project-team-access |
| [**removeTeamProjectAccess()**](TeamAccessApi.md#removeTeamProjectAccess) | **DELETE** /teams/{team_id}/project-access/{project_id} | Remove project access for a team | https://docs.upsun.com/api/#tag/Team-Access/operation/remove-team-project-access |


## `getProjectTeamAccess()`

```php
getProjectTeamAccess($projectId, $teamId): \Upsun\Model\TeamProjectAccess
```

Get team access for a project

Retrieves the team's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | The ID of the project.
$teamId = 'teamId_example'; // string | The ID of the team.

try {
    $result = $apiInstance->getProjectTeamAccess($projectId, $teamId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->getProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| The ID of the project. | |
| **teamId** | **string**| The ID of the team. | |

### Return type

[**\Upsun\Model\TeamProjectAccess**](../Model/TeamProjectAccess.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTeamProjectAccess()`

```php
getTeamProjectAccess($teamId, $projectId): \Upsun\Model\TeamProjectAccess
```

Get project access for a team

Retrieves the team's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $result = $apiInstance->getTeamProjectAccess($teamId, $projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->getTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **projectId** | **string**| The ID of the project. | |

### Return type

[**\Upsun\Model\TeamProjectAccess**](../Model/TeamProjectAccess.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `grantProjectTeamAccess()`

```php
grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner)
```

Grant team access to a project

Grants one or more team access to a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | The ID of the project.
$grantProjectTeamAccessRequestInner = array(new \Upsun\Model\GrantProjectTeamAccessRequestInner()); // \Upsun\Model\GrantProjectTeamAccessRequestInner[]

try {
    $apiInstance->grantProjectTeamAccess($projectId, $grantProjectTeamAccessRequestInner);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->grantProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| The ID of the project. | |
| **grantProjectTeamAccessRequestInner** | [**\Upsun\Model\GrantProjectTeamAccessRequestInner[]**](../Model/GrantProjectTeamAccessRequestInner.md)|  | |

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

## `grantTeamProjectAccess()`

```php
grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner)
```

Grant project access to a team

Adds the team to one or more specified projects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$grantTeamProjectAccessRequestInner = array(new \Upsun\Model\GrantTeamProjectAccessRequestInner()); // \Upsun\Model\GrantTeamProjectAccessRequestInner[]

try {
    $apiInstance->grantTeamProjectAccess($teamId, $grantTeamProjectAccessRequestInner);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->grantTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **grantTeamProjectAccessRequestInner** | [**\Upsun\Model\GrantTeamProjectAccessRequestInner[]**](../Model/GrantTeamProjectAccessRequestInner.md)|  | |

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

## `listProjectTeamAccess()`

```php
listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListProjectTeamAccess200Response
```

List team access for a project

Returns a list of items representing the project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | The ID of the project.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listProjectTeamAccess($projectId, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->listProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| The ID of the project. | |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\Upsun\Model\ListProjectTeamAccess200Response**](../Model/ListProjectTeamAccess200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTeamProjectAccess()`

```php
listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListProjectTeamAccess200Response
```

List project access for a team

Returns a list of items representing the team's project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listTeamProjectAccess($teamId, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->listTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\Upsun\Model\ListProjectTeamAccess200Response**](../Model/ListProjectTeamAccess200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeProjectTeamAccess()`

```php
removeProjectTeamAccess($projectId, $teamId)
```

Remove team access for a project

Removes the team from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string | The ID of the project.
$teamId = 'teamId_example'; // string | The ID of the team.

try {
    $apiInstance->removeProjectTeamAccess($projectId, $teamId);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->removeProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**| The ID of the project. | |
| **teamId** | **string**| The ID of the team. | |

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

## `removeTeamProjectAccess()`

```php
removeTeamProjectAccess($teamId, $projectId)
```

Remove project access for a team

Removes the team from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $apiInstance->removeTeamProjectAccess($teamId, $projectId);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->removeTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **projectId** | **string**| The ID of the project. | |

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
