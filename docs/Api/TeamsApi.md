# [Upsun\Api\TeamsApi](../src/Api/TeamsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createTeam()**](TeamsApi.md#createTeam) | **POST** /teams | Create team | https://docs.upsun.com/api/#tag/Teams/operation/create-team |
| [**createTeamMember()**](TeamsApi.md#createTeamMember) | **POST** /teams/{team_id}/members | Create team member | https://docs.upsun.com/api/#tag/Teams/operation/create-team-member |
| [**deleteTeam()**](TeamsApi.md#deleteTeam) | **DELETE** /teams/{team_id} | Delete team | https://docs.upsun.com/api/#tag/Teams/operation/delete-team |
| [**deleteTeamMember()**](TeamsApi.md#deleteTeamMember) | **DELETE** /teams/{team_id}/members/{user_id} | Delete team member | https://docs.upsun.com/api/#tag/Teams/operation/delete-team-member |
| [**getTeam()**](TeamsApi.md#getTeam) | **GET** /teams/{team_id} | Get team | https://docs.upsun.com/api/#tag/Teams/operation/get-team |
| [**getTeamMember()**](TeamsApi.md#getTeamMember) | **GET** /teams/{team_id}/members/{user_id} | Get team member | https://docs.upsun.com/api/#tag/Teams/operation/get-team-member |
| [**listTeamMembers()**](TeamsApi.md#listTeamMembers) | **GET** /teams/{team_id}/members | List team members | https://docs.upsun.com/api/#tag/Teams/operation/list-team-members |
| [**listTeams()**](TeamsApi.md#listTeams) | **GET** /teams | List teams | https://docs.upsun.com/api/#tag/Teams/operation/list-teams |
| [**listUserTeams()**](TeamsApi.md#listUserTeams) | **GET** /users/{user_id}/teams | User teams | https://docs.upsun.com/api/#tag/Teams/operation/list-user-teams |
| [**updateTeam()**](TeamsApi.md#updateTeam) | **PATCH** /teams/{team_id} | Update team | https://docs.upsun.com/api/#tag/Teams/operation/update-team |


## `createTeam()`

```php
createTeam($createTeamRequest): \Upsun\Model\Team
```

Create team

Creates a new team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$createTeamRequest = new \Upsun\Model\CreateTeamRequest(); // \Upsun\Model\CreateTeamRequest

try {
    $result = $apiInstance->createTeam($createTeamRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->createTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **createTeamRequest** | [**\Upsun\Model\CreateTeamRequest**](../Model/CreateTeamRequest.md)|  | |

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
createTeamMember($teamId, $createTeamMemberRequest): \Upsun\Model\TeamMember
```

Create team member

Creates a new team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$createTeamMemberRequest = new \Upsun\Model\CreateTeamMemberRequest(); // \Upsun\Model\CreateTeamMemberRequest

try {
    $result = $apiInstance->createTeamMember($teamId, $createTeamMemberRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->createTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **createTeamMemberRequest** | [**\Upsun\Model\CreateTeamMemberRequest**](../Model/CreateTeamMemberRequest.md)|  | |

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
deleteTeam($teamId)
```

Delete team

Deletes the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.

try {
    $apiInstance->deleteTeam($teamId);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->deleteTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |

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
deleteTeamMember($teamId, $userId)
```

Delete team member

Deletes the specified team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteTeamMember($teamId, $userId);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->deleteTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **userId** | **string**| The ID of the user. | |

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
getTeam($teamId): \Upsun\Model\Team
```

Get team

Retrieves the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.

try {
    $result = $apiInstance->getTeam($teamId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |

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
getTeamMember($teamId, $userId): \Upsun\Model\TeamMember
```

Get team member

Retrieves the specified team member.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getTeamMember($teamId, $userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **userId** | **string**| The ID of the user. | |

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
listTeamMembers($teamId, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListTeamMembers200Response
```

List team members

Retrieves a list of users associated with a single team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listTeamMembers($teamId, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listTeamMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional] |

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
listTeams($filterOrganizationId, $filterId, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListTeams200Response
```

List teams

Retrieves a list of teams.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$filterOrganizationId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filterId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `id` using one or more operators.
$filterUpdatedAt = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listTeams($filterOrganizationId, $filterId, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listTeams: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filterOrganizationId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional] |
| **filterId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional] |
| **filterUpdatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional] |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional] |

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
listUserTeams($userId, $filterOrganizationId, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListTeams200Response
```

User teams

Retrieves teams that the specified user is a member of.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filterOrganizationId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `organization_id` using one or more operators.
$filterUpdatedAt = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = 'sort_example'; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.

try {
    $result = $apiInstance->listUserTeams($userId, $filterOrganizationId, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->listUserTeams: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **filterOrganizationId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;organization_id&#x60; using one or more operators. | [optional] |
| **filterUpdatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional] |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending. | [optional] |

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
updateTeam($teamId, $updateTeamRequest): \Upsun\Model\Team
```

Update team

Updates the specified team.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$teamId = 'teamId_example'; // string | The ID of the team.
$updateTeamRequest = new \Upsun\Model\UpdateTeamRequest(); // \Upsun\Model\UpdateTeamRequest

try {
    $result = $apiInstance->updateTeam($teamId, $updateTeamRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->updateTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **teamId** | **string**| The ID of the team. | |
| **updateTeamRequest** | [**\Upsun\Model\UpdateTeamRequest**](../Model/UpdateTeamRequest.md)|  | [optional] |

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
