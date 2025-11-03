# [Upsun\Api\ApiTokensApi](../src/Api/ApiTokensApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createApiToken()**](ApiTokensApi.md#createApiToken) | **POST** /users/{user_id}/api-tokens | Create an API token | https://docs.upsun.com/api/#tag/Api-Tokens/operation/create-api-token |
| [**deleteApiToken()**](ApiTokensApi.md#deleteApiToken) | **DELETE** /users/{user_id}/api-tokens/{token_id} | Delete an API token | https://docs.upsun.com/api/#tag/Api-Tokens/operation/delete-api-token |
| [**getApiToken()**](ApiTokensApi.md#getApiToken) | **GET** /users/{user_id}/api-tokens/{token_id} | Get an API token | https://docs.upsun.com/api/#tag/Api-Tokens/operation/get-api-token |
| [**listApiTokens()**](ApiTokensApi.md#listApiTokens) | **GET** /users/{user_id}/api-tokens | List a user&#39;s API tokens | https://docs.upsun.com/api/#tag/Api-Tokens/operation/list-api-tokens |


## `createApiToken()`

```php
createApiToken($userId, $createApiTokenRequest): \Upsun\Model\ApiToken
```

Create an API token

Creates an API token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ApiTokensApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$createApiTokenRequest = new \Upsun\Model\CreateApiTokenRequest(); // \Upsun\Model\CreateApiTokenRequest

try {
    $result = $apiInstance->createApiToken($userId, $createApiTokenRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ApiTokensApi->createApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **createApiTokenRequest** | [**\Upsun\Model\CreateApiTokenRequest**](../Model/CreateApiTokenRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\ApiToken**](../Model/ApiToken.md)

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


$apiInstance = new Upsun\Api\ApiTokensApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$tokenId = 'tokenId_example'; // string | The ID of the token.

try {
    $apiInstance->deleteApiToken($userId, $tokenId);
} catch (Exception $e) {
    echo 'Exception when calling ApiTokensApi->deleteApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **tokenId** | **string**| The ID of the token. | |

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
getApiToken($userId, $tokenId): \Upsun\Model\ApiToken
```

Get an API token

Retrieves the specified API token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ApiTokensApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$tokenId = 'tokenId_example'; // string | The ID of the token.

try {
    $result = $apiInstance->getApiToken($userId, $tokenId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ApiTokensApi->getApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **tokenId** | **string**| The ID of the token. | |

### Return type

[**\Upsun\Model\ApiToken**](../Model/ApiToken.md)

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
listApiTokens($userId): \Upsun\Model\ApiToken[]
```

List a user's API tokens

Retrieves a list of API tokens associated with a single user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\ApiTokensApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->listApiTokens($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ApiTokensApi->listApiTokens: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |

### Return type

[**\Upsun\Model\ApiToken[]**](../Model/ApiToken.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
