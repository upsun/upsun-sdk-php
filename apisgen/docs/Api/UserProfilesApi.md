# OpenAPI\Client\UserProfilesApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProfilePicture()**](UserProfilesApi.md#createProfilePicture) | **POST** /profile/{uuid}/picture | Create a user profile picture
[**deleteProfilePicture()**](UserProfilesApi.md#deleteProfilePicture) | **DELETE** /profile/{uuid}/picture | Delete a user profile picture
[**getAddress()**](UserProfilesApi.md#getAddress) | **GET** /profiles/{userId}/address | Get a user address
[**getProfile()**](UserProfilesApi.md#getProfile) | **GET** /profiles/{userId} | Get a single user profile
[**listProfiles()**](UserProfilesApi.md#listProfiles) | **GET** /profiles | List user profiles
[**updateAddress()**](UserProfilesApi.md#updateAddress) | **PATCH** /profiles/{userId}/address | Update a user address
[**updateProfile()**](UserProfilesApi.md#updateProfile) | **PATCH** /profiles/{userId} | Update a user profile


## `createProfilePicture()`

```php
createProfilePicture($uuid): \OpenAPI\Client\Model\CreateProfilePicture200Response
```

Create a user profile picture

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$uuid = 'uuid_example'; // string | The uuid of the user

try {
    $result = $apiInstance->createProfilePicture($uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->createProfilePicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uuid** | **string**| The uuid of the user |

### Return type

[**\OpenAPI\Client\Model\CreateProfilePicture200Response**](../Model/CreateProfilePicture200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
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


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$uuid = 'uuid_example'; // string | The uuid of the user

try {
    $apiInstance->deleteProfilePicture($uuid);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->deleteProfilePicture: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **uuid** | **string**| The uuid of the user |

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

## `getAddress()`

```php
getAddress($user_id): \OpenAPI\Client\Model\GetAddress200Response
```

Get a user address

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = 'user_id_example'; // string | The UUID of the user

try {
    $result = $apiInstance->getAddress($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->getAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The UUID of the user |

### Return type

[**\OpenAPI\Client\Model\GetAddress200Response**](../Model/GetAddress200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProfile()`

```php
getProfile($user_id): \OpenAPI\Client\Model\Profile
```

Get a single user profile

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = 'user_id_example'; // string | The UUID of the user

try {
    $result = $apiInstance->getProfile($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->getProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The UUID of the user |

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProfiles()`

```php
listProfiles(): \OpenAPI\Client\Model\ListProfiles200Response
```

List user profiles

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
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

[**\OpenAPI\Client\Model\ListProfiles200Response**](../Model/ListProfiles200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateAddress()`

```php
updateAddress($user_id, $address): \OpenAPI\Client\Model\GetAddress200Response
```

Update a user address

Update a user address, supplying one or more key/value pairs to to change.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = 'user_id_example'; // string | The UUID of the user
$address = new \OpenAPI\Client\Model\Address(); // \OpenAPI\Client\Model\Address

try {
    $result = $apiInstance->updateAddress($user_id, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->updateAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The UUID of the user |
 **address** | [**\OpenAPI\Client\Model\Address**](../Model/Address.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\GetAddress200Response**](../Model/GetAddress200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProfile()`

```php
updateProfile($user_id, $update_profile_request): \OpenAPI\Client\Model\Profile
```

Update a user profile

Update a user profile, supplying one or more key/value pairs to to change.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = 'user_id_example'; // string | The UUID of the user
$update_profile_request = new \OpenAPI\Client\Model\UpdateProfileRequest(); // \OpenAPI\Client\Model\UpdateProfileRequest

try {
    $result = $apiInstance->updateProfile($user_id, $update_profile_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserProfilesApi->updateProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| The UUID of the user |
 **update_profile_request** | [**\OpenAPI\Client\Model\UpdateProfileRequest**](../Model/UpdateProfileRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
