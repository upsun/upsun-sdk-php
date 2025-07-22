# OpenAPI\Client\TeamAccessApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectTeamAccess()**](TeamAccessApi.md#getProjectTeamAccess) | **GET** /projects/{project_id}/team-access/{team_id} | Get team access for a project
[**getTeamProjectAccess()**](TeamAccessApi.md#getTeamProjectAccess) | **GET** /teams/{team_id}/project-access/{project_id} | Get project access for a team
[**grantProjectTeamAccess()**](TeamAccessApi.md#grantProjectTeamAccess) | **POST** /projects/{project_id}/team-access | Grant team access to a project
[**grantTeamProjectAccess()**](TeamAccessApi.md#grantTeamProjectAccess) | **POST** /teams/{team_id}/project-access | Grant project access to a team
[**listProjectTeamAccess()**](TeamAccessApi.md#listProjectTeamAccess) | **GET** /projects/{project_id}/team-access | List team access for a project
[**listTeamProjectAccess()**](TeamAccessApi.md#listTeamProjectAccess) | **GET** /teams/{team_id}/project-access | List project access for a team
[**removeProjectTeamAccess()**](TeamAccessApi.md#removeProjectTeamAccess) | **DELETE** /projects/{project_id}/team-access/{team_id} | Remove team access for a project
[**removeTeamProjectAccess()**](TeamAccessApi.md#removeTeamProjectAccess) | **DELETE** /teams/{team_id}/project-access/{project_id} | Remove project access for a team


## `getProjectTeamAccess()`

```php
getProjectTeamAccess($project_id, $team_id): \OpenAPI\Client\Model\TeamProjectAccess
```

Get team access for a project

Retrieves the team's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$team_id = 'team_id_example'; // string | The ID of the team.

try {
    $result = $apiInstance->getProjectTeamAccess($project_id, $team_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->getProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **team_id** | **string**| The ID of the team. |

### Return type

[**\OpenAPI\Client\Model\TeamProjectAccess**](../Model/TeamProjectAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTeamProjectAccess()`

```php
getTeamProjectAccess($team_id, $project_id): \OpenAPI\Client\Model\TeamProjectAccess
```

Get project access for a team

Retrieves the team's permissions for the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$team_id = 'team_id_example'; // string | The ID of the team.
$project_id = 'project_id_example'; // string | The ID of the project.

try {
    $result = $apiInstance->getTeamProjectAccess($team_id, $project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->getTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **project_id** | **string**| The ID of the project. |

### Return type

[**\OpenAPI\Client\Model\TeamProjectAccess**](../Model/TeamProjectAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `grantProjectTeamAccess()`

```php
grantProjectTeamAccess($project_id, $grant_project_team_access_request_inner)
```

Grant team access to a project

Grants one or more team access to a specific project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$grant_project_team_access_request_inner = array(new \OpenAPI\Client\Model\GrantProjectTeamAccessRequestInner()); // \OpenAPI\Client\Model\GrantProjectTeamAccessRequestInner[]

try {
    $apiInstance->grantProjectTeamAccess($project_id, $grant_project_team_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->grantProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **grant_project_team_access_request_inner** | [**\OpenAPI\Client\Model\GrantProjectTeamAccessRequestInner[]**](../Model/GrantProjectTeamAccessRequestInner.md)|  |

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

## `grantTeamProjectAccess()`

```php
grantTeamProjectAccess($team_id, $grant_team_project_access_request_inner)
```

Grant project access to a team

Adds the team to one or more specified projects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$team_id = 'team_id_example'; // string | The ID of the team.
$grant_team_project_access_request_inner = array(new \OpenAPI\Client\Model\GrantTeamProjectAccessRequestInner()); // \OpenAPI\Client\Model\GrantTeamProjectAccessRequestInner[]

try {
    $apiInstance->grantTeamProjectAccess($team_id, $grant_team_project_access_request_inner);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->grantTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **grant_team_project_access_request_inner** | [**\OpenAPI\Client\Model\GrantTeamProjectAccessRequestInner[]**](../Model/GrantTeamProjectAccessRequestInner.md)|  |

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

## `listProjectTeamAccess()`

```php
listProjectTeamAccess($project_id, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListTeamProjectAccess200Response
```

List team access for a project

Returns a list of items representing the project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listProjectTeamAccess($project_id, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->listProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
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

[**\OpenAPI\Client\Model\ListTeamProjectAccess200Response**](../Model/ListTeamProjectAccess200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTeamProjectAccess()`

```php
listTeamProjectAccess($team_id, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListTeamProjectAccess200Response
```

List project access for a team

Returns a list of items representing the team's project access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$team_id = 'team_id_example'; // string | The ID of the team.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `project_title`, `granted_at`, `updated_at`.

try {
    $result = $apiInstance->listTeamProjectAccess($team_id, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->listTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;project_title&#x60;, &#x60;granted_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListTeamProjectAccess200Response**](../Model/ListTeamProjectAccess200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeProjectTeamAccess()`

```php
removeProjectTeamAccess($project_id, $team_id)
```

Remove team access for a project

Removes the team from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string | The ID of the project.
$team_id = 'team_id_example'; // string | The ID of the team.

try {
    $apiInstance->removeProjectTeamAccess($project_id, $team_id);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->removeProjectTeamAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**| The ID of the project. |
 **team_id** | **string**| The ID of the team. |

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

## `removeTeamProjectAccess()`

```php
removeTeamProjectAccess($team_id, $project_id)
```

Remove project access for a team

Removes the team from the current project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TeamAccessApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$team_id = 'team_id_example'; // string | The ID of the team.
$project_id = 'project_id_example'; // string | The ID of the project.

try {
    $apiInstance->removeTeamProjectAccess($team_id, $project_id);
} catch (Exception $e) {
    echo 'Exception when calling TeamAccessApi->removeTeamProjectAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **project_id** | **string**| The ID of the project. |

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
