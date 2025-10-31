# [Upsun\Api\SshKeysApi](../src/Api/SshKeysApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createSshKey()**](SshKeysApi.md#createSshKey) | **POST** /ssh_keys | Add a new public SSH key to a user | https://docs.upsun.com/api/#tag/Ssh-Keys/operation/create-ssh-key |
| [**deleteSshKey()**](SshKeysApi.md#deleteSshKey) | **DELETE** /ssh_keys/{key_id} | Delete an SSH key | https://docs.upsun.com/api/#tag/Ssh-Keys/operation/delete-ssh-key |
| [**getSshKey()**](SshKeysApi.md#getSshKey) | **GET** /ssh_keys/{key_id} | Get an SSH key | https://docs.upsun.com/api/#tag/Ssh-Keys/operation/get-ssh-key |


## `createSshKey()`

```php
createSshKey($createSshKeyRequest): \Upsun\Model\SshKey
```

Add a new public SSH key to a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SshKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$createSshKeyRequest = new \Upsun\Model\CreateSshKeyRequest(); // \Upsun\Model\CreateSshKeyRequest

try {
    $result = $apiInstance->createSshKey($createSshKeyRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SshKeysApi->createSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **createSshKeyRequest** | [**\Upsun\Model\CreateSshKeyRequest**](../Model/CreateSshKeyRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\SshKey**](../Model/SshKey.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSshKey()`

```php
deleteSshKey($keyId)
```

Delete an SSH key

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SshKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$keyId = 56; // int | The ID of the ssh key.

try {
    $apiInstance->deleteSshKey($keyId);
} catch (Exception $e) {
    echo 'Exception when calling SshKeysApi->deleteSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **keyId** | **int**| The ID of the ssh key. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSshKey()`

```php
getSshKey($keyId): \Upsun\Model\SshKey
```

Get an SSH key

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SshKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$keyId = 56; // int | The ID of the ssh key.

try {
    $result = $apiInstance->getSshKey($keyId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SshKeysApi->getSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **keyId** | **int**| The ID of the ssh key. | |

### Return type

[**\Upsun\Model\SshKey**](../Model/SshKey.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
