# OpenAPI\Client\ThirdPartyIntegrationsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#createProjectsIntegrations) | **POST** /projects/{projectId}/integrations | Integrate project with a third-party service |
| [**deleteProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#deleteProjectsIntegrations) | **DELETE** /projects/{projectId}/integrations/{integrationId} | Delete an existing third-party integration |
| [**getProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#getProjectsIntegrations) | **GET** /projects/{projectId}/integrations/{integrationId} | Get information about an existing third-party integration |
| [**listProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#listProjectsIntegrations) | **GET** /projects/{projectId}/integrations | Get list of existing integrations for a project |
| [**updateProjectsIntegrations()**](ThirdPartyIntegrationsApi.md#updateProjectsIntegrations) | **PATCH** /projects/{projectId}/integrations/{integrationId} | Update an existing third-party integration |


## `createProjectsIntegrations()`

```php
createProjectsIntegrations($project_id, $integration_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Integrate project with a third-party service

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$integration_create_input = new \OpenAPI\Client\Model\IntegrationCreateInput(); // \OpenAPI\Client\Model\IntegrationCreateInput | 

try {
    $result = $apiInstance->createProjectsIntegrations($project_id, $integration_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->createProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **integration_create_input** | [**\OpenAPI\Client\Model\IntegrationCreateInput**](../Model/IntegrationCreateInput.md)|  | |

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

## `deleteProjectsIntegrations()`

```php
deleteProjectsIntegrations($project_id, $integration_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$integration_id = 'integration_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsIntegrations($project_id, $integration_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->deleteProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **integration_id** | **string**|  | |

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

## `getProjectsIntegrations()`

```php
getProjectsIntegrations($project_id, $integration_id): \OpenAPI\Client\Model\Integration
```

Get information about an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$integration_id = 'integration_id_example'; // string

try {
    $result = $apiInstance->getProjectsIntegrations($project_id, $integration_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->getProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **integration_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\Integration**](../Model/Integration.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsIntegrations()`

```php
listProjectsIntegrations($project_id): \OpenAPI\Client\Model\Integration[]
```

Get list of existing integrations for a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsIntegrations($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->listProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\Integration[]**](../Model/Integration.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsIntegrations()`

```php
updateProjectsIntegrations($project_id, $integration_id, $integration_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update an existing third-party integration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ThirdPartyIntegrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$integration_id = 'integration_id_example'; // string
$integration_patch = new \OpenAPI\Client\Model\IntegrationPatch(); // \OpenAPI\Client\Model\IntegrationPatch | 

try {
    $result = $apiInstance->updateProjectsIntegrations($project_id, $integration_id, $integration_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThirdPartyIntegrationsApi->updateProjectsIntegrations: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **integration_id** | **string**|  | |
| **integration_patch** | [**\OpenAPI\Client\Model\IntegrationPatch**](../Model/IntegrationPatch.md)|  | |

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
