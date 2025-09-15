# Upsun\EnvironmentActivityApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**actionProjectsEnvironmentsActivitiesCancel()**](EnvironmentActivityApi.md#actionProjectsEnvironmentsActivitiesCancel) | **POST** /projects/{projectId}/environments/{environmentId}/activities/{activityId}/cancel | Cancel an environment activity
[**getProjectsEnvironmentsActivities()**](EnvironmentActivityApi.md#getProjectsEnvironmentsActivities) | **GET** /projects/{projectId}/environments/{environmentId}/activities/{activityId} | Get an environment activity log entry
[**listProjectsEnvironmentsActivities()**](EnvironmentActivityApi.md#listProjectsEnvironmentsActivities) | **GET** /projects/{projectId}/environments/{environmentId}/activities | Get environment activity log


## `actionProjectsEnvironmentsActivitiesCancel()`

```php
actionProjectsEnvironmentsActivitiesCancel($projectId, $environmentId, $activityId): \Upsun\Model\AcceptedResponse
```

Cancel an environment activity

Cancel a single activity as specified by an `id` returned by the [Get environment activities list](#tag/Environment-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1activities%2Fget) endpoint.  Please note that not all activities are cancelable.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentActivityApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$activityId = 'activityId_example'; // string

try {
    $result = $apiInstance->actionProjectsEnvironmentsActivitiesCancel($projectId, $environmentId, $activityId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentActivityApi->actionProjectsEnvironmentsActivitiesCancel: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |
 **activityId** | **string**|  |

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

## `getProjectsEnvironmentsActivities()`

```php
getProjectsEnvironmentsActivities($projectId, $environmentId, $activityId): \Upsun\Model\Activity
```

Get an environment activity log entry

Retrieve a single environment activity entry as specified by an `id` returned by the [Get environment activities list](#tag/Environment-Activity%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1activities%2Fget) endpoint. See the documentation on that endpoint for details about the information this endpoint can return.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentActivityApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$activityId = 'activityId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsActivities($projectId, $environmentId, $activityId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentActivityApi->getProjectsEnvironmentsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |
 **activityId** | **string**|  |

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

## `listProjectsEnvironmentsActivities()`

```php
listProjectsEnvironmentsActivities($projectId, $environmentId): \Upsun\Model\Activity[]
```

Get environment activity log

Retrieve an environment's activity log. This returns a list of object with records of actions such as:  - Commits being pushed to the repository - A new environment being branched out from the specified environment - A snapshot being created of the specified environment  The object includes a timestamp of when the action occurred (`created_at`), when the action concluded (`updated_at`), the current `state` of the action, the action's completion percentage (`completion_percent`), and other related information in the `payload`.  The contents of the `payload` varies based on the `type` of the activity. For example:  - An `environment.branch` action's `payload` can contain objects representing the `parent` environment and the branching action's `outcome`.  - An `environment.push` action's `payload` can contain objects representing the `environment`, the specific `commits` included in the push, and the `user` who pushed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentActivityApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsActivities($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentActivityApi->listProjectsEnvironmentsActivities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **environmentId** | **string**|  |

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
