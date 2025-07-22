# OpenAPI\Client\APITokensApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createApiToken()**](APITokensApi.md#createApiToken) | **POST** /users/{user_id}/api-tokens | Create an API token
[**deleteApiToken()**](APITokensApi.md#deleteApiToken) | **DELETE** /users/{user_id}/api-tokens/{token_id} | Delete an API token
[**getApiToken()**](APITokensApi.md#getApiToken) | **GET** /users/{user_id}/api-tokens/{token_id} | Get an API token
[**listApiTokens()**](APITokensApi.md#listApiTokens) | **GET** /users/{user_id}/api-tokens | List a user&#39;s API tokens


## `createApiToken()`

```php
createApiToken($user_id, $create_api_token_request): \OpenAPI\Client\Model\APIToken
```

Create an API token

Creates an API token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$create_api_token_request = new \OpenAPI\Client\Model\CreateApiTokenRequest(); // \OpenAPI\Client\Model\CreateApiTokenRequest

try {
    $result = $apiInstance->createApiToken($user_id, $create_api_token_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->createApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **create_api_token_request** | [**\OpenAPI\Client\Model\CreateApiTokenRequest**](../Model/CreateApiTokenRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\APIToken**](../Model/APIToken.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteApiToken()`

```php
deleteApiToken($user_id, $token_id)
```

Delete an API token

Deletes an API token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$token_id = 'token_id_example'; // string | The ID of the token.

try {
    $apiInstance->deleteApiToken($user_id, $token_id);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->deleteApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **token_id** | **string**| The ID of the token. |

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

## `getApiToken()`

```php
getApiToken($user_id, $token_id): \OpenAPI\Client\Model\APIToken
```

Get an API token

Retrieves the specified API token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$token_id = 'token_id_example'; // string | The ID of the token.

try {
    $result = $apiInstance->getApiToken($user_id, $token_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->getApiToken: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **token_id** | **string**| The ID of the token. |

### Return type

[**\OpenAPI\Client\Model\APIToken**](../Model/APIToken.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listApiTokens()`

```php
listApiTokens($user_id): \OpenAPI\Client\Model\APIToken[]
```

List a user's API tokens

Retrieves a list of API tokens associated with a single user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->listApiTokens($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->listApiTokens: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |

### Return type

[**\OpenAPI\Client\Model\APIToken[]**](../Model/APIToken.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
