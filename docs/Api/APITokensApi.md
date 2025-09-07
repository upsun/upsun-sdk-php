# Upsun\APITokensApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createApiToken()**](APITokensApi.md#createApiToken) | **POST** /users/{user_id}/api-tokens | Create an API token
[**deleteApiToken()**](APITokensApi.md#deleteApiToken) | **DELETE** /users/{user_id}/api-tokens/{token_id} | Delete an API token
[**getApiToken()**](APITokensApi.md#getApiToken) | **GET** /users/{user_id}/api-tokens/{token_id} | Get an API token
[**listApiTokens()**](APITokensApi.md#listApiTokens) | **GET** /users/{user_id}/api-tokens | List a user&#39;s API tokens


## `createApiToken()`

```php
createApiToken($userId, $createApiTokenRequest): \Upsun\Model\APIToken
```

Create an API token

Creates an API token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$createApiTokenRequest = new \Upsun\Model\CreateApiTokenRequest(); // \Upsun\Model\CreateApiTokenRequest

try {
    $result = $apiInstance->createApiToken($userId, $createApiTokenRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->createApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **createApiTokenRequest** | [**\Upsun\Model\CreateApiTokenRequest**](../Model/CreateApiTokenRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\APIToken**](../Model/APIToken.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteApiToken()`

```php
deleteApiToken($userId, $tokenId)
```

Delete an API token

Deletes an API token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$tokenId = 'tokenId_example'; // string | The ID of the token.

try {
    $apiInstance->deleteApiToken($userId, $tokenId);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->deleteApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **tokenId** | **string**| The ID of the token. |

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

## `getApiToken()`

```php
getApiToken($userId, $tokenId): \Upsun\Model\APIToken
```

Get an API token

Retrieves the specified API token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$tokenId = 'tokenId_example'; // string | The ID of the token.

try {
    $result = $apiInstance->getApiToken($userId, $tokenId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->getApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **tokenId** | **string**| The ID of the token. |

### Return type

[**\Upsun\Model\APIToken**](../Model/APIToken.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listApiTokens()`

```php
listApiTokens($userId): \Upsun\Model\APIToken[]
```

List a user's API tokens

Retrieves a list of API tokens associated with a single user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->listApiTokens($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->listApiTokens: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |

### Return type

[**\Upsun\Model\APIToken[]**](../Model/APIToken.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
