# [Upsun\Api\ConnectionsApi](../src/Api/ConnectionsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**deleteLoginConnection()**](ConnectionsApi.md#deleteLoginConnection) | **DELETE** /users/{user_id}/connections/{provider} | Delete a federated login connection | https://docs.upsun.com/api/#tag/Connections/operation/delete-login-connection |
| [**getLoginConnection()**](ConnectionsApi.md#getLoginConnection) | **GET** /users/{user_id}/connections/{provider} | Get a federated login connection | https://docs.upsun.com/api/#tag/Connections/operation/get-login-connection |
| [**listLoginConnections()**](ConnectionsApi.md#listLoginConnections) | **GET** /users/{user_id}/connections | List federated login connections | https://docs.upsun.com/api/#tag/Connections/operation/list-login-connections |


## `deleteLoginConnection()`

```php
deleteLoginConnection($provider, $userId)
```

Delete a federated login connection

Deletes the specified connection.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$provider = 'provider_example'; // string | The name of the federation provider.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->deleteLoginConnection($provider, $userId);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->deleteLoginConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **provider** | **string**| The name of the federation provider. | |
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

## `getLoginConnection()`

```php
getLoginConnection($provider, $userId): \Upsun\Model\Connection
```

Get a federated login connection

Retrieves the specified connection.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$provider = 'provider_example'; // string | The name of the federation provider.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getLoginConnection($provider, $userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->getLoginConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **provider** | **string**| The name of the federation provider. | |
| **userId** | **string**| The ID of the user. | |

### Return type

[**\Upsun\Model\Connection**](../Model/Connection.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listLoginConnections()`

```php
listLoginConnections($userId): \Upsun\Model\Connection[]
```

List federated login connections

Retrieves a list of connections associated with a single user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->listLoginConnections($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ConnectionsApi->listLoginConnections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |

### Return type

[**\Upsun\Model\Connection[]**](../Model/Connection.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
