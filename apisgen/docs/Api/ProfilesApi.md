# OpenAPI\Client\ProfilesApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getOrgAddress()**](ProfilesApi.md#getOrgAddress) | **GET** /organizations/{organization_id}/address | Get address
[**getOrgProfile()**](ProfilesApi.md#getOrgProfile) | **GET** /organizations/{organization_id}/profile | Get profile
[**updateOrgAddress()**](ProfilesApi.md#updateOrgAddress) | **PATCH** /organizations/{organization_id}/address | Update address
[**updateOrgProfile()**](ProfilesApi.md#updateOrgProfile) | **PATCH** /organizations/{organization_id}/profile | Update profile


## `getOrgAddress()`

```php
getOrgAddress($organization_id): \OpenAPI\Client\Model\Address
```

Get address

Retrieves the address for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgAddress($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->getOrgAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\OpenAPI\Client\Model\Address**](../Model/Address.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgProfile()`

```php
getOrgProfile($organization_id): \OpenAPI\Client\Model\Profile
```

Get profile

Retrieves the profile for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgProfile($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->getOrgProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgAddress()`

```php
updateOrgAddress($organization_id, $address): \OpenAPI\Client\Model\Address
```

Update address

Updates the address for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$address = new \OpenAPI\Client\Model\Address(); // \OpenAPI\Client\Model\Address

try {
    $result = $apiInstance->updateOrgAddress($organization_id, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->updateOrgAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **address** | [**\OpenAPI\Client\Model\Address**](../Model/Address.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Address**](../Model/Address.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgProfile()`

```php
updateOrgProfile($organization_id, $update_org_profile_request): \OpenAPI\Client\Model\Profile
```

Update profile

Updates the profile for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$update_org_profile_request = new \OpenAPI\Client\Model\UpdateOrgProfileRequest(); // \OpenAPI\Client\Model\UpdateOrgProfileRequest

try {
    $result = $apiInstance->updateOrgProfile($organization_id, $update_org_profile_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->updateOrgProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization. |
 **update_org_profile_request** | [**\OpenAPI\Client\Model\UpdateOrgProfileRequest**](../Model/UpdateOrgProfileRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Profile**](../Model/Profile.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
