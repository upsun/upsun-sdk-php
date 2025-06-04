# OpenAPI\Client\ProjectActivityApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**actionProjectsActivitiesCancel()**](ProjectActivityApi.md#actionProjectsActivitiesCancel) | **POST** /projects/{projectId}/activities/{activityId}/cancel | Cancel a project activity |
| [**getProjectsActivities()**](ProjectActivityApi.md#getProjectsActivities) | **GET** /projects/{projectId}/activities/{activityId} | Get a project activity log entry |
| [**listProjectsActivities()**](ProjectActivityApi.md#listProjectsActivities) | **GET** /projects/{projectId}/activities | Get project activity log |


## `actionProjectsActivitiesCancel()`

```php
actionProjectsActivitiesCancel($project_id, $activity_id): \OpenAPI\Client\Model\AcceptedResponse
```

Cancel a project activity

Cancel a single activity as specified by an `id` returned by the [Get project activity log](#tag/Project-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1activities%2Fget) endpoint.  Please note that not all activities are cancelable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$activity_id = 'activity_id_example'; // string

try {
    $result = $apiInstance->actionProjectsActivitiesCancel($project_id, $activity_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->actionProjectsActivitiesCancel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **activity_id** | **string**|  | |

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

## `getProjectsActivities()`

```php
getProjectsActivities($project_id, $activity_id): \OpenAPI\Client\Model\Activity
```

Get a project activity log entry

Retrieve a single activity log entry as specified by an `id` returned by the [Get project activity log](#tag/Project-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1activities%2Fget) endpoint. See the documentation on that endpoint for details about the information this endpoint can return.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$activity_id = 'activity_id_example'; // string

try {
    $result = $apiInstance->getProjectsActivities($project_id, $activity_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->getProjectsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **activity_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\Activity**](../Model/Activity.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsActivities()`

```php
listProjectsActivities($project_id): \OpenAPI\Client\Model\Activity[]
```

Get project activity log

Retrieve a project's activity log including logging actions in all environments within a project. This returns a list of objects with records of actions such as:  - Commits being pushed to the repository - A new environment being branched out from the specified environment - A snapshot being created of the specified environment  The object includes a timestamp of when the action occurred (`created_at`), when the action concluded (`updated_at`), the current `state` of the action, the action's completion percentage (`completion_percent`), the `environments` it applies to and other related information in the `payload`.  The contents of the `payload` varies based on the `type` of the activity. For example:  - An `environment.branch` action's `payload` can contain objects representing the environment's `parent` environment and the branching action's `outcome`.  - An `environment.push` action's `payload` can contain objects representing the `environment`, the specific `commits` included in the push, and the `user` who pushed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsActivities($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->listProjectsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\Activity[]**](../Model/Activity.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
