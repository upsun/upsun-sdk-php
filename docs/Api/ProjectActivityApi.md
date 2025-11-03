# [Upsun\Api\ProjectActivityApi](../src/Api/ProjectActivityApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**actionProjectsActivitiesCancel()**](ProjectActivityApi.md#actionProjectsActivitiesCancel) | **POST** /projects/{projectId}/activities/{activityId}/cancel | Cancel a project activity | https://docs.upsun.com/api/#tag/Project-Activity/operation/action-projects-activities-cancel |
| [**getProjectsActivities()**](ProjectActivityApi.md#getProjectsActivities) | **GET** /projects/{projectId}/activities/{activityId} | Get a project activity log entry | https://docs.upsun.com/api/#tag/Project-Activity/operation/get-projects-activities |
| [**listProjectsActivities()**](ProjectActivityApi.md#listProjectsActivities) | **GET** /projects/{projectId}/activities | Get project activity log | https://docs.upsun.com/api/#tag/Project-Activity/operation/list-projects-activities |


## `actionProjectsActivitiesCancel()`

```php
actionProjectsActivitiesCancel($projectId, $activityId): \Upsun\Model\AcceptedResponse
```

Cancel a project activity

Cancel a single activity as specified by an `id` returned by the [Get project activity log](#tag/Project-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1activities%2Fget) endpoint.  Please note that not all activities are cancelable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$activityId = 'activityId_example'; // string

try {
    $result = $apiInstance->actionProjectsActivitiesCancel($projectId, $activityId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->actionProjectsActivitiesCancel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **activityId** | **string**|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsActivities()`

```php
getProjectsActivities($projectId, $activityId): \Upsun\Model\Activity
```

Get a project activity log entry

Retrieve a single activity log entry as specified by an `id` returned by the [Get project activity log](#tag/Project-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1activities%2Fget) endpoint. See the documentation on that endpoint for details about the information this endpoint can return.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$activityId = 'activityId_example'; // string

try {
    $result = $apiInstance->getProjectsActivities($projectId, $activityId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->getProjectsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **activityId** | **string**|  | |

### Return type

[**\Upsun\Model\Activity**](../Model/Activity.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsActivities()`

```php
listProjectsActivities($projectId): \Upsun\Model\Activity[]
```

Get project activity log

Retrieve a project's activity log including logging actions in all environments within a project. This returns a list of objects with records of actions such as:  - Commits being pushed to the repository - A new environment being branched out from the specified environment - A snapshot being created of the specified environment  The object includes a timestamp of when the action occurred (`created_at`), when the action concluded (`updated_at`), the current `state` of the action, the action's completion percentage (`completion_percent`), the `environments` it applies to and when the activity expires (`expires_at`).  There are other related information in the `payload`. The contents of the `payload` varies based on the `type` of the activity. For example:  - An `environment.branch` action's `payload` can contain objects representing the environment's `parent` environment and the branching action's `outcome`.  - An `environment.push` action's `payload` can contain objects representing the `environment`, the specific `commits` included in the push, and the `user` who pushed.  Expired activities are removed from the project activity log, except the last 100 expired objects provided they are not of type `environment.cron` or `environment.backup`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ProjectActivityApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsActivities($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectActivityApi->listProjectsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\Activity[]**](../Model/Activity.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
