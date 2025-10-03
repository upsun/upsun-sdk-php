# [Upsun\Api\ThirdPartyIntegrationsApi](../src/Api/ThirdPartyIntegrationsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#createProjectsIntegrations) | **POST** /projects/{projectId}/integrations | Integrate project with a third-party service | https://docs.upsun.com/api/#tag/Third-Party-Integrations/operation/create-projects-integrations |
| [**deleteProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#deleteProjectsIntegrations) | **DELETE** /projects/{projectId}/integrations/{integrationId} | Delete an existing third-party integration | https://docs.upsun.com/api/#tag/Third-Party-Integrations/operation/delete-projects-integrations |
| [**getProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#getProjectsIntegrations) | **GET** /projects/{projectId}/integrations/{integrationId} | Get information about an existing third-party integration | https://docs.upsun.com/api/#tag/Third-Party-Integrations/operation/get-projects-integrations |
| [**listProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#listProjectsIntegrations) | **GET** /projects/{projectId}/integrations | Get list of existing integrations for a project | https://docs.upsun.com/api/#tag/Third-Party-Integrations/operation/list-projects-integrations |
| [**updateProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#updateProjectsIntegrations) | **PATCH** /projects/{projectId}/integrations/{integrationId} | Update an existing third-party integration | https://docs.upsun.com/api/#tag/Third-Party-Integrations/operation/update-projects-integrations |


## `createProjectsIntegrations()`

```php
createProjectsIntegrations($projectId, $integrationCreateInput): \Upsun\Model\AcceptedResponse
```

Integrate project with a third-party service

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$integrationCreateInput = new \Upsun\Model\IntegrationCreateInput(); // \Upsun\Model\IntegrationCreateInput | 

try {
    $result = $apiInstance->createProjectsIntegrations($projectId, $integrationCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->createProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **integrationCreateInput** | [**\Upsun\Model\IntegrationCreateInput**](../Model/IntegrationCreateInput.md)|  | |

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

## `deleteProjectsIntegrations()`

```php
deleteProjectsIntegrations($projectId, $integrationId): \Upsun\Model\AcceptedResponse
```

Delete an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$integrationId = 'integrationId_example'; // string

try {
    $result = $apiInstance->deleteProjectsIntegrations($projectId, $integrationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->deleteProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **integrationId** | **string**|  | |

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

## `getProjectsIntegrations()`

```php
getProjectsIntegrations($projectId, $integrationId): \Upsun\Model\AcceptedResponse
```

Get information about an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$integrationId = 'integrationId_example'; // string

try {
    $result = $apiInstance->getProjectsIntegrations($projectId, $integrationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->getProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **integrationId** | **string**|  | |

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

## `listProjectsIntegrations()`

```php
listProjectsIntegrations($projectId): \Upsun\Model\AcceptedResponse
```

Get list of existing integrations for a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsIntegrations($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->listProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

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

## `updateProjectsIntegrations()`

```php
updateProjectsIntegrations($projectId, $integrationId, $integrationPatch): \Upsun\Model\AcceptedResponse
```

Update an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$integrationId = 'integrationId_example'; // string
$integrationPatch = new \Upsun\Model\IntegrationPatch(); // \Upsun\Model\IntegrationPatch | 

try {
    $result = $apiInstance->updateProjectsIntegrations($projectId, $integrationId, $integrationPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->updateProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **integrationId** | **string**|  | |
| **integrationPatch** | [**\Upsun\Model\IntegrationPatch**](../Model/IntegrationPatch.md)|  | |

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
