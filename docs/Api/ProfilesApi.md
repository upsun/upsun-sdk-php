# [Upsun\Api\ProfilesApi](../src/Api/ProfilesApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getOrgAddress()**](ProfilesApi.md#getOrgAddress) | **GET** /organizations/{organization_id}/address | Get address | https://docs.upsun.com/api/#tag/Profiles/operation/get-org-address |
| [**getOrgProfile()**](ProfilesApi.md#getOrgProfile) | **GET** /organizations/{organization_id}/profile | Get profile | https://docs.upsun.com/api/#tag/Profiles/operation/get-org-profile |
| [**updateOrgAddress()**](ProfilesApi.md#updateOrgAddress) | **PATCH** /organizations/{organization_id}/address | Update address | https://docs.upsun.com/api/#tag/Profiles/operation/update-org-address |
| [**updateOrgProfile()**](ProfilesApi.md#updateOrgProfile) | **PATCH** /organizations/{organization_id}/profile | Update profile | https://docs.upsun.com/api/#tag/Profiles/operation/update-org-profile |


## `getOrgAddress()`

```php
getOrgAddress($organizationId): \Upsun\Model\Address
```

Get address

Retrieves the address for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgAddress($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->getOrgAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\Upsun\Model\Address**](../Model/Address.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgProfile()`

```php
getOrgProfile($organizationId): \Upsun\Model\Profile
```

Get profile

Retrieves the profile for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgProfile($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->getOrgProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\Upsun\Model\Profile**](../Model/Profile.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgAddress()`

```php
updateOrgAddress($organizationId, $address): \Upsun\Model\Address
```

Update address

Updates the address for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$address = new \Upsun\Model\Address(); // \Upsun\Model\Address

try {
    $result = $apiInstance->updateOrgAddress($organizationId, $address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->updateOrgAddress: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **address** | [**\Upsun\Model\Address**](../Model/Address.md)|  | [optional] |

### Return type

[**\Upsun\Model\Address**](../Model/Address.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgProfile()`

```php
updateOrgProfile($organizationId, $updateOrgProfileRequest): \Upsun\Model\Profile
```

Update profile

Updates the profile for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\ProfilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$updateOrgProfileRequest = new \Upsun\Model\UpdateOrgProfileRequest(); // \Upsun\Model\UpdateOrgProfileRequest

try {
    $result = $apiInstance->updateOrgProfile($organizationId, $updateOrgProfileRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfilesApi->updateOrgProfile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **updateOrgProfileRequest** | [**\Upsun\Model\UpdateOrgProfileRequest**](../Model/UpdateOrgProfileRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\Profile**](../Model/Profile.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
