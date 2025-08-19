# OpenAPI\Client\SSHKeysApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSshKey()**](SSHKeysApi.md#createSshKey) | **POST** /ssh_keys | Add a new public SSH key to a user |
| [**deleteSshKey()**](SSHKeysApi.md#deleteSshKey) | **DELETE** /ssh_keys/{key_id} | Delete an SSH key |
| [**getSshKey()**](SSHKeysApi.md#getSshKey) | **GET** /ssh_keys/{key_id} | Get an SSH key |


## `createSshKey()`

```php
createSshKey($create_ssh_key_request): \OpenAPI\Client\Model\SSHKey
```

Add a new public SSH key to a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_ssh_key_request = new \OpenAPI\Client\Model\CreateSshKeyRequest(); // \OpenAPI\Client\Model\CreateSshKeyRequest

try {
    $result = $apiInstance->createSshKey($create_ssh_key_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->createSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_ssh_key_request** | [**\OpenAPI\Client\Model\CreateSshKeyRequest**](../Model/CreateSshKeyRequest.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSshKey()`

```php
deleteSshKey($key_id)
```

Delete an SSH key

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$key_id = 56; // int | The ID of the ssh key.

try {
    $apiInstance->deleteSshKey($key_id);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->deleteSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **key_id** | **int**| The ID of the ssh key. | |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSshKey()`

```php
getSshKey($key_id): \OpenAPI\Client\Model\SSHKey
```

Get an SSH key

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$key_id = 56; // int | The ID of the ssh key.

try {
    $result = $apiInstance->getSshKey($key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->getSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **key_id** | **int**| The ID of the ssh key. | |

### Return type

[**\OpenAPI\Client\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
