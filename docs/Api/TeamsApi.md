# Upsun\TeamsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTeam()**](TeamsApi.md#createTeam) | **POST** /teams | Create team
[**createTeamMember()**](TeamsApi.md#createTeamMember) | **POST** /teams/{team_id}/members | Create team member
[**deleteTeam()**](TeamsApi.md#deleteTeam) | **DELETE** /teams/{team_id} | Delete team
[**deleteTeamMember()**](TeamsApi.md#deleteTeamMember) | **DELETE** /teams/{team_id}/members/{user_id} | Delete team member
[**getTeam()**](TeamsApi.md#getTeam) | **GET** /teams/{team_id} | Get team
[**getTeamMember()**](TeamsApi.md#getTeamMember) | **GET** /teams/{team_id}/members/{user_id} | Get team member
[**listTeamMembers()**](TeamsApi.md#listTeamMembers) | **GET** /teams/{team_id}/members | List team members
[**listTeams()**](TeamsApi.md#listTeams) | **GET** /teams | List teams
[**listUserTeams()**](TeamsApi.md#listUserTeams) | **GET** /users/{user_id}/teams | User teams
[**updateTeam()**](TeamsApi.md#updateTeam) | **PATCH** /teams/{team_id} | Update team


## `createTeam()`

```php
createTeam($create_team_request): \Upsun\Model\Team
```

Create team

Creates a new team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$create_team_request = new \Upsun\Model\CreateTeamRequest(); // \Upsun\Model\CreateTeamRequest

try {
    $result = $apiInstance->createTeam($create_team_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->createTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **create_team_request** | [**\Upsun\Model\CreateTeamRequest**](../Model/CreateTeamRequest.md)|  |

### Return type

[**\Upsun\Model\Team**](../Model/Team.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createTeamMember()`

```php
createTeamMember($team_id, $create_team_member_request): \Upsun\Model\TeamMember
```

Create team member

Creates a new team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.
$create_team_member_request = new \Upsun\Model\CreateTeamMemberRequest(); // \Upsun\Model\CreateTeamMemberRequest

try {
    $result = $apiInstance->createTeamMember($team_id, $create_team_member_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->createTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **create_team_member_request** | [**\Upsun\Model\CreateTeamMemberRequest**](../Model/CreateTeamMemberRequest.md)|  |

### Return type

[**\Upsun\Model\TeamMember**](../Model/TeamMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteTeam()`

```php
deleteTeam($team_id)
```

Delete team

Deletes the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.

try {
    $apiInstance->deleteTeam($team_id);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->deleteTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |

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

## `deleteTeamMember()`

```php
deleteTeamMember($team_id, $user_id)
```

Delete team member

Deletes the specified team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteTeamMember($team_id, $user_id);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->deleteTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **user_id** | **string**| The ID of the user. |

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

## `getTeam()`

```php
getTeam($team_id): \Upsun\Model\Team
```

Get team

Retrieves the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.

try {
    $result = $apiInstance->getTeam($team_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |

### Return type

[**\Upsun\Model\Team**](../Model/Team.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTeamMember()`

```php
getTeamMember($team_id, $user_id): \Upsun\Model\TeamMember
```

Get team member

Retrieves the specified team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getTeamMember($team_id, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **user_id** | **string**| The ID of the user. |

### Return type

[**\Upsun\Model\TeamMember**](../Model/TeamMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTeamMembers()`

```php
listTeamMembers($team_id, $page_before, $page_after, $sort): \Upsun\Model\ListTeamMembers200Response
```

List team members

Retrieves a list of users associated with a single team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listTeamMembers($team_id, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listTeamMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional]

### Return type

[**\Upsun\Model\ListTeamMembers200Response**](../Model/ListTeamMembers200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTeams()`

```php
listTeams($filter_organization_id, $filter_id, $filter_updated_at, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListTeams200Response
```

List teams

Retrieves a list of teams.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$filter_organization_id = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filter_id = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `id` using one or more operators.
$filter_updated_at = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listTeams($filter_organization_id, $filter_id, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listTeams: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filter_organization_id** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional]
 **filter_id** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional]
 **filter_updated_at** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional]

### Return type

[**\Upsun\Model\ListTeams200Response**](../Model/ListTeams200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listUserTeams()`

```php
listUserTeams($user_id, $filter_organization_id, $filter_updated_at, $page_size, $page_before, $page_after, $sort): \Upsun\Model\ListTeams200Response
```

User teams

Retrieves teams that the specified user is a member of.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filter_organization_id = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filter_updated_at = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listUserTeams($user_id, $filter_organization_id, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listUserTeams: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **filter_organization_id** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional]
 **filter_updated_at** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional]
 **page_size** | **int**| Determines the number of items to show. | [optional]
 **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional]

### Return type

[**\Upsun\Model\ListTeams200Response**](../Model/ListTeams200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateTeam()`

```php
updateTeam($team_id, $update_team_request): \Upsun\Model\Team
```

Update team

Updates the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$team_id = 'team_id_example'; // string | The ID of the team.
$update_team_request = new \Upsun\Model\UpdateTeamRequest(); // \Upsun\Model\UpdateTeamRequest

try {
    $result = $apiInstance->updateTeam($team_id, $update_team_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->updateTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **team_id** | **string**| The ID of the team. |
 **update_team_request** | [**\Upsun\Model\UpdateTeamRequest**](../Model/UpdateTeamRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Team**](../Model/Team.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
