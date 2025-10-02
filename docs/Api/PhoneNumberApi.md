# [Upsun\Api\PhoneNumberApi](../src/Api/PhoneNumberApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**confirmPhoneNumber()**](PhoneNumberApi.md#confirmPhoneNumber) | **POST** /users/{user_id}/phonenumber/{sid} | Confirm phone number | https://docs.upsun.com/api/#tag/PhoneNumber/operation/confirm-phone-number |
| [**verifyPhoneNumber()**](PhoneNumberApi.md#verifyPhoneNumber) | **POST** /users/{user_id}/phonenumber | Verify phone number | https://docs.upsun.com/api/#tag/PhoneNumber/operation/verify-phone-number |


## `confirmPhoneNumber()`

```php
confirmPhoneNumber($sid, $userId, $confirmPhoneNumberRequest)
```

Confirm phone number

Confirms phone number using a verification code.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\PhoneNumberApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sid = 'sid_example'; // string | The session ID obtained from `POST /users/{user_id}/phonenumber`.
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$confirmPhoneNumberRequest = new \Upsun\Model\ConfirmPhoneNumberRequest(); // \Upsun\Model\ConfirmPhoneNumberRequest

try {
    $apiInstance->confirmPhoneNumber($sid, $userId, $confirmPhoneNumberRequest);
} catch (Exception $e) {
    echo 'Exception when calling PhoneNumberApi->confirmPhoneNumber: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sid** | **string**| The session ID obtained from &#x60;POST /users/{user_id}/phonenumber&#x60;. | |
| **userId** | **string**| The ID of the user. | |
| **confirmPhoneNumberRequest** | [**\Upsun\Model\ConfirmPhoneNumberRequest**](../Model/ConfirmPhoneNumberRequest.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPhoneNumber()`

```php
verifyPhoneNumber($userId, $verifyPhoneNumberRequest): \Upsun\Model\VerifyPhoneNumber200Response
```

Verify phone number

Starts a phone number verification session.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\PhoneNumberApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$verifyPhoneNumberRequest = new \Upsun\Model\VerifyPhoneNumberRequest(); // \Upsun\Model\VerifyPhoneNumberRequest

try {
    $result = $apiInstance->verifyPhoneNumber($userId, $verifyPhoneNumberRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PhoneNumberApi->verifyPhoneNumber: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **verifyPhoneNumberRequest** | [**\Upsun\Model\VerifyPhoneNumberRequest**](../Model/VerifyPhoneNumberRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\VerifyPhoneNumber200Response**](../Model/VerifyPhoneNumber200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
