# OpenAPI\Client\EnvironmentBackupsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**backupEnvironment()**](EnvironmentBackupsApi.md#backupEnvironment) | **POST** /projects/{projectId}/environments/{environmentId}/backup | Create snapshot of environment
[**deleteProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#deleteProjectsEnvironmentsBackups) | **DELETE** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Delete an environment snapshot
[**getProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#getProjectsEnvironmentsBackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Get an environment snapshot&#39;s info
[**listProjectsEnvironmentsBackups()**](EnvironmentBackupsApi.md#listProjectsEnvironmentsBackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups | Get an environment&#39;s snapshot list
[**restoreBackup()**](EnvironmentBackupsApi.md#restoreBackup) | **POST** /projects/{projectId}/environments/{environmentId}/backups/{backupId}/restore | Restore an environment snapshot


## `backupEnvironment()`

```php
backupEnvironment($project_id, $environment_id, $environment_backup_input): \OpenAPI\Client\Model\AcceptedResponse
```

Create snapshot of environment

Trigger a new snapshot of an environment to be created. See the [Snapshot and Restore](https://docs.platform.sh/administration/snapshot-and-restore.html) section of the documentation for more information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$environment_backup_input = new \OpenAPI\Client\Model\EnvironmentBackupInput(); // \OpenAPI\Client\Model\EnvironmentBackupInput | 

try {
    $result = $apiInstance->backupEnvironment($project_id, $environment_id, $environment_backup_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->backupEnvironment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **environment_backup_input** | [**\OpenAPI\Client\Model\EnvironmentBackupInput**](../Model/EnvironmentBackupInput.md)|  |

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

## `deleteProjectsEnvironmentsBackups()`

```php
deleteProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete an environment snapshot

Delete a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$backup_id = 'backup_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->deleteProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **backup_id** | **string**|  |

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

## `getProjectsEnvironmentsBackups()`

```php
getProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id): \OpenAPI\Client\Model\Backup
```

Get an environment snapshot's info

Get the details of a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$backup_id = 'backup_id_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsBackups($project_id, $environment_id, $backup_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->getProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **backup_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Backup**](../Model/Backup.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsBackups()`

```php
listProjectsEnvironmentsBackups($project_id, $environment_id): \OpenAPI\Client\Model\Backup[]
```

Get an environment's snapshot list

Retrieve a list of objects representing backups of this environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsBackups($project_id, $environment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->listProjectsEnvironmentsBackups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Backup[]**](../Model/Backup.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `restoreBackup()`

```php
restoreBackup($project_id, $environment_id, $backup_id, $environment_restore_input): \OpenAPI\Client\Model\AcceptedResponse
```

Restore an environment snapshot

Restore a specific backup from an environment using the `id` of the entry retrieved by the [Get backups list](#tag/Environment-Backups%2Fpaths%2F~1projects~1%7BprojectId%7D~1environments~1%7BenvironmentId%7D~1backups%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentBackupsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$backup_id = 'backup_id_example'; // string
$environment_restore_input = new \OpenAPI\Client\Model\EnvironmentRestoreInput(); // \OpenAPI\Client\Model\EnvironmentRestoreInput | 

try {
    $result = $apiInstance->restoreBackup($project_id, $environment_id, $backup_id, $environment_restore_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentBackupsApi->restoreBackup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **backup_id** | **string**|  |
 **environment_restore_input** | [**\OpenAPI\Client\Model\EnvironmentRestoreInput**](../Model/EnvironmentRestoreInput.md)|  |

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
