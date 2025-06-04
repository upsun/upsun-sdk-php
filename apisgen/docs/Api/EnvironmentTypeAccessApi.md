# OpenAPI\Client\EnvironmentTypeAccessApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createEnvironmentTypeAccess()**](EnvironmentTypeAccessApi.md#createEnvironmentTypeAccess) | **POST** /projects/{projectId}/environment-types/{environmentTypeId}/access | Add a user to an environment ACL |
| [**deleteEnvironmentTypeAccess()**](EnvironmentTypeAccessApi.md#deleteEnvironmentTypeAccess) | **DELETE** /projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId} | Remove a user from an environment type |
| [**getEnvironmentTypeAccess()**](EnvironmentTypeAccessApi.md#getEnvironmentTypeAccess) | **GET** /projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId} | Get a single environment type&#39;s ACL entry |
| [**listEnvironmentTypeAccess()**](EnvironmentTypeAccessApi.md#listEnvironmentTypeAccess) | **GET** /projects/{projectId}/environment-types/{environmentTypeId}/access | Get an environment type&#39;s access control list |
| [**updateEnvironmentTypeAccess()**](EnvironmentTypeAccessApi.md#updateEnvironmentTypeAccess) | **PATCH** /projects/{projectId}/environment-types/{environmentTypeId}/access/{environmentTypeAccessId} | Update an environment type user&#39;s role |


## `createEnvironmentTypeAccess()`

```php
createEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Add a user to an environment ACL

Add a user to an environment type's access control list  > **Note**: > > For more granular control and invitation by email, use [`/invitations`](#tag/Invitation).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string
$environment_type_access_create_input = new \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput(); // \OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput | 

try {
    $result = $apiInstance->createEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeAccessApi->createEnvironmentTypeAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **environment_type_id** | **string**|  | |
| **environment_type_access_create_input** | [**\OpenAPI\Client\Model\EnvironmentTypeAccessCreateInput**](../Model/EnvironmentTypeAccessCreateInput.md)|  | |

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

## `deleteEnvironmentTypeAccess()`

```php
deleteEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id): \OpenAPI\Client\Model\AcceptedResponse
```

Remove a user from an environment type

Remove a user from an environment type's access control list. using the `id` of the entry in the access control list retrieved with the [Get environment type access control list](#tag/Environment-Type-Access/paths/~1projects~1{projectId}~1environment-types~1{environmentTypeId}~1access/get) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string
$environment_type_access_id = 'environment_type_access_id_example'; // string

try {
    $result = $apiInstance->deleteEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeAccessApi->deleteEnvironmentTypeAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **environment_type_id** | **string**|  | |
| **environment_type_access_id** | **string**|  | |

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

## `getEnvironmentTypeAccess()`

```php
getEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id): \OpenAPI\Client\Model\EnvironmentTypeAccess
```

Get a single environment type's ACL entry

Retrieve the details of a user from an environment type's access control list using the `id` of the entry in the access control list retrieved with the [Get environment type's access control list](#tag/Environment-Type-Access/paths/~1projects~1{projectId}~1environment-types~1{environmentTypeId}~1access/get) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string
$environment_type_access_id = 'environment_type_access_id_example'; // string

try {
    $result = $apiInstance->getEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeAccessApi->getEnvironmentTypeAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **environment_type_id** | **string**|  | |
| **environment_type_access_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\EnvironmentTypeAccess**](../Model/EnvironmentTypeAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listEnvironmentTypeAccess()`

```php
listEnvironmentTypeAccess($project_id, $environment_type_id): \OpenAPI\Client\Model\EnvironmentTypeAccess[]
```

Get an environment type's access control list

Retrieve a list of objects for users and their roles for the given environment type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string

try {
    $result = $apiInstance->listEnvironmentTypeAccess($project_id, $environment_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeAccessApi->listEnvironmentTypeAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **environment_type_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\EnvironmentTypeAccess[]**](../Model/EnvironmentTypeAccess.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateEnvironmentTypeAccess()`

```php
updateEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update an environment type user's role

Update the role of a user from an environment type's access control list using the `id` of the entry in the access control list retrieved with the [Get environment access control list](#tag/Environment-Type-Access/paths/~1projects~1{projectId}~1environment-types~1{environmentTypeId}~1access/get) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\EnvironmentTypeAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_type_id = 'environment_type_id_example'; // string
$environment_type_access_id = 'environment_type_access_id_example'; // string
$environment_type_access_patch = new \OpenAPI\Client\Model\EnvironmentTypeAccessPatch(); // \OpenAPI\Client\Model\EnvironmentTypeAccessPatch | 

try {
    $result = $apiInstance->updateEnvironmentTypeAccess($project_id, $environment_type_id, $environment_type_access_id, $environment_type_access_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnvironmentTypeAccessApi->updateEnvironmentTypeAccess: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **project_id** | **string**|  | |
| **environment_type_id** | **string**|  | |
| **environment_type_access_id** | **string**|  | |
| **environment_type_access_patch** | [**\OpenAPI\Client\Model\EnvironmentTypeAccessPatch**](../Model/EnvironmentTypeAccessPatch.md)|  | |

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
