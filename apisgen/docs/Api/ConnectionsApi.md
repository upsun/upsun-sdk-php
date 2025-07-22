# OpenAPI\Client\ConnectionsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteLoginConnection()**](ConnectionsApi.md#deleteLoginConnection) | **DELETE** /users/{user_id}/connections/{provider} | Delete a federated login connection |
| [**getLoginConnection()**](ConnectionsApi.md#getLoginConnection) | **GET** /users/{user_id}/connections/{provider} | Get a federated login connection |
| [**listLoginConnections()**](ConnectionsApi.md#listLoginConnections) | **GET** /users/{user_id}/connections | List federated login connections |


## `deleteLoginConnection()`

```php
deleteLoginConnection($provider, $user_id)
```

Delete a federated login connection

Deletes the specified connection.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$provider = 'provider_example'; // string | The name of the federation provider.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteLoginConnection($provider, $user_id);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->deleteLoginConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **provider** | **string**| The name of the federation provider. | |
| **user_id** | **string**| The ID of the user. | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLoginConnection()`

```php
getLoginConnection($provider, $user_id): \OpenAPI\Client\Model\Connection
```

Get a federated login connection

Retrieves the specified connection.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$provider = 'provider_example'; // string | The name of the federation provider.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getLoginConnection($provider, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->getLoginConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **provider** | **string**| The name of the federation provider. | |
| **user_id** | **string**| The ID of the user. | |

### Return type

[**\OpenAPI\Client\Model\Connection**](../Model/Connection.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listLoginConnections()`

```php
listLoginConnections($user_id): \OpenAPI\Client\Model\Connection[]
```

List federated login connections

Retrieves a list of connections associated with a single user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->listLoginConnections($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->listLoginConnections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |

### Return type

[**\OpenAPI\Client\Model\Connection[]**](../Model/Connection.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
