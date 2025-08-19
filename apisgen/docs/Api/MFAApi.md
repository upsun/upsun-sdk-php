# OpenAPI\Client\MFAApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**confirmTotpEnrollment()**](MFAApi.md#confirmTotpEnrollment) | **POST** /users/{user_id}/totp | Confirm TOTP enrollment |
| [**disableOrgMfaEnforcement()**](MFAApi.md#disableOrgMfaEnforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/disable | Disable organization MFA enforcement |
| [**enableOrgMfaEnforcement()**](MFAApi.md#enableOrgMfaEnforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/enable | Enable organization MFA enforcement |
| [**getOrgMfaEnforcement()**](MFAApi.md#getOrgMfaEnforcement) | **GET** /organizations/{organization_id}/mfa-enforcement | Get organization MFA settings |
| [**getTotpEnrollment()**](MFAApi.md#getTotpEnrollment) | **GET** /users/{user_id}/totp | Get information about TOTP enrollment |
| [**recreateRecoveryCodes()**](MFAApi.md#recreateRecoveryCodes) | **POST** /users/{user_id}/codes | Re-create recovery codes |
| [**sendOrgMfaReminders()**](MFAApi.md#sendOrgMfaReminders) | **POST** /organizations/{organization_id}/mfa/remind | Send MFA reminders to organization members |
| [**withdrawTotpEnrollment()**](MFAApi.md#withdrawTotpEnrollment) | **DELETE** /users/{user_id}/totp | Withdraw TOTP enrollment |


## `confirmTotpEnrollment()`

```php
confirmTotpEnrollment($user_id, $confirm_totp_enrollment_request): \OpenAPI\Client\Model\ConfirmTotpEnrollment200Response
```

Confirm TOTP enrollment

Confirms the given TOTP enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$confirm_totp_enrollment_request = new \OpenAPI\Client\Model\ConfirmTotpEnrollmentRequest(); // \OpenAPI\Client\Model\ConfirmTotpEnrollmentRequest | 

try {
    $result = $apiInstance->confirmTotpEnrollment($user_id, $confirm_totp_enrollment_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->confirmTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **confirm_totp_enrollment_request** | [**\OpenAPI\Client\Model\ConfirmTotpEnrollmentRequest**](../Model/ConfirmTotpEnrollmentRequest.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\ConfirmTotpEnrollment200Response**](../Model/ConfirmTotpEnrollment200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `disableOrgMfaEnforcement()`

```php
disableOrgMfaEnforcement($organization_id)
```

Disable organization MFA enforcement

Disables MFA enforcement for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $apiInstance->disableOrgMfaEnforcement($organization_id);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->disableOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |

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

## `enableOrgMfaEnforcement()`

```php
enableOrgMfaEnforcement($organization_id)
```

Enable organization MFA enforcement

Enables MFA enforcement for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $apiInstance->enableOrgMfaEnforcement($organization_id);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->enableOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |

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

## `getOrgMfaEnforcement()`

```php
getOrgMfaEnforcement($organization_id): \OpenAPI\Client\Model\OrganizationMFAEnforcement
```

Get organization MFA settings

Retrieves MFA settings for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgMfaEnforcement($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->getOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\OpenAPI\Client\Model\OrganizationMFAEnforcement**](../Model/OrganizationMFAEnforcement.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTotpEnrollment()`

```php
getTotpEnrollment($user_id): \OpenAPI\Client\Model\GetTotpEnrollment200Response
```

Get information about TOTP enrollment

Retrieves TOTP enrollment information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getTotpEnrollment($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->getTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |

### Return type

[**\OpenAPI\Client\Model\GetTotpEnrollment200Response**](../Model/GetTotpEnrollment200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recreateRecoveryCodes()`

```php
recreateRecoveryCodes($user_id): \OpenAPI\Client\Model\ConfirmTotpEnrollment200Response
```

Re-create recovery codes

Re-creates recovery codes for the MFA enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->recreateRecoveryCodes($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->recreateRecoveryCodes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |

### Return type

[**\OpenAPI\Client\Model\ConfirmTotpEnrollment200Response**](../Model/ConfirmTotpEnrollment200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendOrgMfaReminders()`

```php
sendOrgMfaReminders($organization_id, $send_org_mfa_reminders_request): array<string,\OpenAPI\Client\Model\SendOrgMfaReminders200ResponseValue>
```

Send MFA reminders to organization members

Sends a reminder about setting up MFA to the specified organization members.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$send_org_mfa_reminders_request = new \OpenAPI\Client\Model\SendOrgMfaRemindersRequest(); // \OpenAPI\Client\Model\SendOrgMfaRemindersRequest

try {
    $result = $apiInstance->sendOrgMfaReminders($organization_id, $send_org_mfa_reminders_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->sendOrgMfaReminders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **send_org_mfa_reminders_request** | [**\OpenAPI\Client\Model\SendOrgMfaRemindersRequest**](../Model/SendOrgMfaRemindersRequest.md)|  | [optional] |

### Return type

[**array<string,\OpenAPI\Client\Model\SendOrgMfaReminders200ResponseValue>**](../Model/SendOrgMfaReminders200ResponseValue.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `withdrawTotpEnrollment()`

```php
withdrawTotpEnrollment($user_id)
```

Withdraw TOTP enrollment

Withdraws from the TOTP enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->withdrawTotpEnrollment($user_id);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->withdrawTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |

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
