# OpenAPI\Client\PhoneNumberApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**confirmPhoneNumber()**](PhoneNumberApi.md#confirmPhoneNumber) | **POST** /users/{user_id}/phonenumber/{sid} | Confirm phone number
[**verifyPhoneNumber()**](PhoneNumberApi.md#verifyPhoneNumber) | **POST** /users/{user_id}/phonenumber | Verify phone number


## `confirmPhoneNumber()`

```php
confirmPhoneNumber($sid, $user_id, $confirm_phone_number_request)
```

Confirm phone number

Confirms phone number using a verification code.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PhoneNumberApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$sid = 'sid_example'; // string | The session ID obtained from `POST /users/{user_id}/phonenumber`.
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$confirm_phone_number_request = new \OpenAPI\Client\Model\ConfirmPhoneNumberRequest(); // \OpenAPI\Client\Model\ConfirmPhoneNumberRequest

try {
    $apiInstance->confirmPhoneNumber($sid, $user_id, $confirm_phone_number_request);
} catch (Exception $e) {
    echo 'Exception when calling PhoneNumberApi->confirmPhoneNumber: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sid** | **string**| The session ID obtained from &#x60;POST /users/{user_id}/phonenumber&#x60;. |
 **user_id** | **string**| The ID of the user. |
 **confirm_phone_number_request** | [**\OpenAPI\Client\Model\ConfirmPhoneNumberRequest**](../Model/ConfirmPhoneNumberRequest.md)|  | [optional]

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPhoneNumber()`

```php
verifyPhoneNumber($user_id, $verify_phone_number_request): \OpenAPI\Client\Model\VerifyPhoneNumber200Response
```

Verify phone number

Starts a phone number verification session.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PhoneNumberApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$verify_phone_number_request = new \OpenAPI\Client\Model\VerifyPhoneNumberRequest(); // \OpenAPI\Client\Model\VerifyPhoneNumberRequest

try {
    $result = $apiInstance->verifyPhoneNumber($user_id, $verify_phone_number_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PhoneNumberApi->verifyPhoneNumber: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The ID of the user. |
 **verify_phone_number_request** | [**\OpenAPI\Client\Model\VerifyPhoneNumberRequest**](../Model/VerifyPhoneNumberRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\VerifyPhoneNumber200Response**](../Model/VerifyPhoneNumber200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
