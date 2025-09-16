# Upsun\SSHKeysApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createSshKey()**](SSHKeysApi.md#createSshKey) | **POST** /ssh_keys | Add a new public SSH key to a user
[**deleteSshKey()**](SSHKeysApi.md#deleteSshKey) | **DELETE** /ssh_keys/{key_id} | Delete an SSH key
[**getSshKey()**](SSHKeysApi.md#getSshKey) | **GET** /ssh_keys/{key_id} | Get an SSH key


## `createSshKey()`

```php
createSshKey($createSshKeyRequest): \Upsun\Model\SSHKey
```

Add a new public SSH key to a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$createSshKeyRequest = new \Upsun\Model\CreateSshKeyRequest(); // \Upsun\Model\CreateSshKeyRequest

try {
    $result = $apiInstance->createSshKey($createSshKeyRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->createSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **createSshKeyRequest** | [**\Upsun\Model\CreateSshKeyRequest**](../Model/CreateSshKeyRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\SSHKey**](../Model/SSHKey.md)

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



$apiInstance = new Upsun\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$keyId = 56; // int | The ID of the ssh key.

try {
    $apiInstance->deleteSshKey($keyId);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->deleteSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **keyId** | **int**| The ID of the ssh key. |

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
getSshKey($keyId): \Upsun\Model\SSHKey
```

Get an SSH key

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SSHKeysApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$keyId = 56; // int | The ID of the ssh key.

try {
    $result = $apiInstance->getSshKey($keyId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SSHKeysApi->getSshKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **keyId** | **int**| The ID of the ssh key. |

### Return type

[**\Upsun\Model\SSHKey**](../Model/SSHKey.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
