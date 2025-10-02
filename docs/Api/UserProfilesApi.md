# [Upsun\Api\UserProfilesApi](../src/Api/UserProfilesApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createProfilePicture()**](UserProfilesApi.md#createProfilePicture) | **POST** /profile/{uuid}/picture | Create a user profile picture | https://docs.upsun.com/api/#tag/User-Profiles/operation/create-profile-picture |
| [**deleteProfilePicture()**](UserProfilesApi.md#deleteProfilePicture) | **DELETE** /profile/{uuid}/picture | Delete a user profile picture | https://docs.upsun.com/api/#tag/User-Profiles/operation/delete-profile-picture |
| [**getAddress()**](UserProfilesApi.md#getAddress) | **GET** /profiles/{userId}/address | Get a user address | https://docs.upsun.com/api/#tag/User-Profiles/operation/get-address |
| [**getProfile()**](UserProfilesApi.md#getProfile) | **GET** /profiles/{userId} | Get a single user profile | https://docs.upsun.com/api/#tag/User-Profiles/operation/get-profile |
| [**listProfiles()**](UserProfilesApi.md#listProfiles) | **GET** /profiles | List user profiles | https://docs.upsun.com/api/#tag/User-Profiles/operation/list-profiles |
| [**updateAddress()**](UserProfilesApi.md#updateAddress) | **PATCH** /profiles/{userId}/address | Update a user address | https://docs.upsun.com/api/#tag/User-Profiles/operation/update-address |
| [**updateProfile()**](UserProfilesApi.md#updateProfile) | **PATCH** /profiles/{userId} | Update a user profile | https://docs.upsun.com/api/#tag/User-Profiles/operation/update-profile |


## `createProfilePicture()`

```php
createProfilePicture($uuid, $file): \Upsun\Model\CreateProfilePicture200Response
```

Create a user profile picture

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$uuid = 'uuid_example'; // string | The uuid of the user
$file = '/path/to/file.txt'; // \SplFileObject | The image file to upload.

try {
    $result = $apiInstance->createProfilePicture($uuid, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->createProfilePicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| The uuid of the user | |
| **file** | **\SplFileObject****\SplFileObject**| The image file to upload. | [optional] |

### Return type

[**\Upsun\Model\CreateProfilePicture200Response**](../Model/CreateProfilePicture200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProfilePicture()`

```php
deleteProfilePicture($uuid)
```

Delete a user profile picture

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$uuid = 'uuid_example'; // string | The uuid of the user

try {
    $apiInstance->deleteProfilePicture($uuid);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->deleteProfilePicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| The uuid of the user | |

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

## `getAddress()`

```php
getAddress($userId): \Upsun\Model\GetAddress200Response
```

Get a user address

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = 'userId_example'; // string | The UUID of the user

try {
    $result = $apiInstance->getAddress($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->getAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The UUID of the user | |

### Return type

[**\Upsun\Model\GetAddress200Response**](../Model/GetAddress200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfile()`

```php
getProfile($userId): \Upsun\Model\Profile
```

Get a single user profile

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = 'userId_example'; // string | The UUID of the user

try {
    $result = $apiInstance->getProfile($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->getProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The UUID of the user | |

### Return type

[**\Upsun\Model\Profile**](../Model/Profile.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProfiles()`

```php
listProfiles(): \Upsun\Model\ListProfiles200Response
```

List user profiles

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listProfiles();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->listProfiles: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Upsun\Model\ListProfiles200Response**](../Model/ListProfiles200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateAddress()`

```php
updateAddress($userId, $address): \Upsun\Model\GetAddress200Response
```

Update a user address

Update a user address, supplying one or more key/value pairs to to change.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = 'userId_example'; // string | The UUID of the user
$address = new \Upsun\Model\Address(); // \Upsun\Model\Address

try {
    $result = $apiInstance->updateAddress($userId, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->updateAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The UUID of the user | |
| **address** | [**\Upsun\Model\Address**](../Model/Address.md)|  | [optional] |

### Return type

[**\Upsun\Model\GetAddress200Response**](../Model/GetAddress200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProfile()`

```php
updateProfile($userId, $updateProfileRequest): \Upsun\Model\Profile
```

Update a user profile

Update a user profile, supplying one or more key/value pairs to to change.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userId = 'userId_example'; // string | The UUID of the user
$updateProfileRequest = new \Upsun\Model\UpdateProfileRequest(); // \Upsun\Model\UpdateProfileRequest

try {
    $result = $apiInstance->updateProfile($userId, $updateProfileRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->updateProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **userId** | **string**| The UUID of the user | |
| **updateProfileRequest** | [**\Upsun\Model\UpdateProfileRequest**](../Model/UpdateProfileRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\Profile**](../Model/Profile.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
