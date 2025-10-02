# [Upsun\Api\EnvironmentBackupsApi](../src/Api/EnvironmentBackupsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**backupEnvironment()**](EnvironmentBackupsApi.md#backupEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/backup | Create backup of environment | https://docs.upsun.com/api/#tag/Environment-Backups/operation/backup-environment |
| [**deleteProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#deleteProjectsEnvironmentsBackups) | **DELETE** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Delete an environment backup | https://docs.upsun.com/api/#tag/Environment-Backups/operation/delete-projects-environments-backups |
| [**getProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#getProjectsEnvironmentsBackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Get an environment backup&#39;s info | https://docs.upsun.com/api/#tag/Environment-Backups/operation/get-projects-environments-backups |
| [**listProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#listProjectsEnvironmentsBackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups | Get an environment&#39;s backup list | https://docs.upsun.com/api/#tag/Environment-Backups/operation/list-projects-environments-backups |
| [**restoreBackup()**](EnvironmentBackupsApi.md#restoreBackup) | **POST** /projects/{projectId}/environments/{environmentId}/backups/{backupId}/restore | Restore an environment snapshot | https://docs.upsun.com/api/#tag/Environment-Backups/operation/restore-backup |


## `backupEnvironment()`

```php
backupEnvironment($projectId, $environmentId, $environmentBackupInput): \Upsun\Model\AcceptedResponse
```

Create backup of environment

Trigger a new backup of an environment to be created. See the [Backups](https://docs.upsun.com/anchors/environments/backup/) section of the documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$environmentBackupInput = new \Upsun\Model\EnvironmentBackupInput(); // \Upsun\Model\EnvironmentBackupInput | 

try {
    $result = $apiInstance->backupEnvironment($projectId, $environmentId, $environmentBackupInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->backupEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **environmentBackupInput** | [**\Upsun\Model\EnvironmentBackupInput**](../Model/EnvironmentBackupInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsEnvironmentsBackups()`

```php
deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId): \Upsun\Model\AcceptedResponse
```

Delete an environment backup

Delete a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$backupId = 'backupId_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->deleteProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **backupId** | **string**|  | |

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

## `getProjectsEnvironmentsBackups()`

```php
getProjectsEnvironmentsBackups($projectId, $environmentId, $backupId): \Upsun\Model\Backup
```

Get an environment backup's info

Get the details of a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$backupId = 'backupId_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsBackups($projectId, $environmentId, $backupId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->getProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **backupId** | **string**|  | |

### Return type

[**\Upsun\Model\Backup**](../Model/Backup.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsBackups()`

```php
listProjectsEnvironmentsBackups($projectId, $environmentId): \Upsun\Model\Backup[]
```

Get an environment's backup list

Retrieve a list of objects representing backups of this environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsBackups($projectId, $environmentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->listProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |

### Return type

[**\Upsun\Model\Backup[]**](../Model/Backup.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `restoreBackup()`

```php
restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput): \Upsun\Model\AcceptedResponse
```

Restore an environment snapshot

Restore a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$environmentId = 'environmentId_example'; // string
$backupId = 'backupId_example'; // string
$environmentRestoreInput = new \Upsun\Model\EnvironmentRestoreInput(); // \Upsun\Model\EnvironmentRestoreInput | 

try {
    $result = $apiInstance->restoreBackup($projectId, $environmentId, $backupId, $environmentRestoreInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->restoreBackup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **environmentId** | **string**|  | |
| **backupId** | **string**|  | |
| **environmentRestoreInput** | [**\Upsun\Model\EnvironmentRestoreInput**](../Model/EnvironmentRestoreInput.md)|  | |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
