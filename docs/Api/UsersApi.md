# [Upsun\Api\UsersApi](../src/Api/UsersApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getCurrentUser()**](UsersApi.md#getCurrentUser) | **GET** /users/me | Get the current user | https://docs.upsun.com/api/#tag/Users/operation/get-current-user |
| [**getCurrentUserDeprecated()**](UsersApi.md#getCurrentUserDeprecated) | **GET** /me | Get current logged-in user info | https://docs.upsun.com/api/#tag/Users/operation/get-current-user-deprecated |
| [**getCurrentUserVerificationStatus()**](UsersApi.md#getCurrentUserVerificationStatus) | **POST** /me/phone | Check if phone verification is required | https://docs.upsun.com/api/#tag/Users/operation/get-current-user-verification-status |
| [**getCurrentUserVerificationStatusFull()**](UsersApi.md#getCurrentUserVerificationStatusFull) | **POST** /me/verification | Check if verification is required | https://docs.upsun.com/api/#tag/Users/operation/get-current-user-verification-status-full |
| [**getUser()**](UsersApi.md#getUser) | **GET** /users/{user_id} | Get a user | https://docs.upsun.com/api/#tag/Users/operation/get-user |
| [**getUserByEmailAddress()**](UsersApi.md#getUserByEmailAddress) | **GET** /users/email&#x3D;{email} | Get a user by email | https://docs.upsun.com/api/#tag/Users/operation/get-user-by-email-address |
| [**getUserByUsername()**](UsersApi.md#getUserByUsername) | **GET** /users/username&#x3D;{username} | Get a user by username | https://docs.upsun.com/api/#tag/Users/operation/get-user-by-username |
| [**resetEmailAddress()**](UsersApi.md#resetEmailAddress) | **POST** /users/{user_id}/emailaddress | Reset email address | https://docs.upsun.com/api/#tag/Users/operation/reset-email-address |
| [**resetPassword()**](UsersApi.md#resetPassword) | **POST** /users/{user_id}/resetpassword | Reset user password | https://docs.upsun.com/api/#tag/Users/operation/reset-password |
| [**updateUser()**](UsersApi.md#updateUser) | **PATCH** /users/{user_id} | Update a user | https://docs.upsun.com/api/#tag/Users/operation/update-user |


## `getCurrentUser()`

```php
getCurrentUser(): \Upsun\Model\User
```

Get the current user

Retrieves the current user, determined from the used access token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCurrentUser();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getCurrentUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCurrentUserDeprecated()`

```php
getCurrentUserDeprecated(): \Upsun\Model\CurrentUser
```

Get current logged-in user info

Retrieve information about the currently logged-in user (the user associated with the access token).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCurrentUserDeprecated();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getCurrentUserDeprecated: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\CurrentUser**](../Model/CurrentUser.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCurrentUserVerificationStatus()`

```php
getCurrentUserVerificationStatus(): \Upsun\Model\GetCurrentUserVerificationStatus200Response
```

Check if phone verification is required

Find out if the current logged in user requires phone verification to create projects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCurrentUserVerificationStatus();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getCurrentUserVerificationStatus: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\GetCurrentUserVerificationStatus200Response**](../Model/GetCurrentUserVerificationStatus200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCurrentUserVerificationStatusFull()`

```php
getCurrentUserVerificationStatusFull(): \Upsun\Model\GetCurrentUserVerificationStatusFull200Response
```

Check if verification is required

Find out if the current logged in user requires verification (phone or staff) to create projects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getCurrentUserVerificationStatusFull();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getCurrentUserVerificationStatusFull: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\GetCurrentUserVerificationStatusFull200Response**](../Model/GetCurrentUserVerificationStatusFull200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUser()`

```php
getUser($userId): \Upsun\Model\User
```

Get a user

Retrieves the specified user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getUser($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |

### Return type

[**\Upsun\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserByEmailAddress()`

```php
getUserByEmailAddress($email): \Upsun\Model\User
```

Get a user by email

Retrieves a user matching the specified email address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$email = hello@example.com; // string | The user's email address.

try {
    $result = $apiInstance->getUserByEmailAddress($email);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUserByEmailAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **email** | **string**| The user&#39;s email address. | |

### Return type

[**\Upsun\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserByUsername()`

```php
getUserByUsername($username): \Upsun\Model\User
```

Get a user by username

Retrieves a user matching the specified username.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$username = platform-sh; // string | The user's username.

try {
    $result = $apiInstance->getUserByUsername($username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUserByUsername: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **username** | **string**| The user&#39;s username. | |

### Return type

[**\Upsun\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resetEmailAddress()`

```php
resetEmailAddress($userId, $resetEmailAddressRequest)
```

Reset email address

Requests a reset of the user's email address. A confirmation email will be sent to the new address when the request is accepted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$resetEmailAddressRequest = new \Upsun\Model\ResetEmailAddressRequest(); // \Upsun\Model\ResetEmailAddressRequest | 

try {
    $apiInstance->resetEmailAddress($userId, $resetEmailAddressRequest);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->resetEmailAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **resetEmailAddressRequest** | [**\Upsun\Model\ResetEmailAddressRequest**](../Model/ResetEmailAddressRequest.md)|  | [optional] |

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

## `resetPassword()`

```php
resetPassword($userId)
```

Reset user password

Requests a reset of the user's password. A password reset email will be sent to the user when the request is accepted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->resetPassword($userId);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->resetPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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

## `updateUser()`

```php
updateUser($userId, $updateUserRequest): \Upsun\Model\User
```

Update a user

Updates the specified user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$updateUserRequest = new \Upsun\Model\UpdateUserRequest(); // \Upsun\Model\UpdateUserRequest

try {
    $result = $apiInstance->updateUser($userId, $updateUserRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->updateUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The ID of the user. | |
| **updateUserRequest** | [**\Upsun\Model\UpdateUserRequest**](../Model/UpdateUserRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
