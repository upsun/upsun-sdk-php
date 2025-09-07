# Upsun\MFAApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**confirmTotpEnrollment()**](MFAApi.md#confirmTotpEnrollment) | **POST** /users/{user_id}/totp | Confirm TOTP enrollment
[**disableOrgMfaEnforcement()**](MFAApi.md#disableOrgMfaEnforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/disable | Disable organization MFA enforcement
[**enableOrgMfaEnforcement()**](MFAApi.md#enableOrgMfaEnforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/enable | Enable organization MFA enforcement
[**getOrgMfaEnforcement()**](MFAApi.md#getOrgMfaEnforcement) | **GET** /organizations/{organization_id}/mfa-enforcement | Get organization MFA settings
[**getTotpEnrollment()**](MFAApi.md#getTotpEnrollment) | **GET** /users/{user_id}/totp | Get information about TOTP enrollment
[**recreateRecoveryCodes()**](MFAApi.md#recreateRecoveryCodes) | **POST** /users/{user_id}/codes | Re-create recovery codes
[**sendOrgMfaReminders()**](MFAApi.md#sendOrgMfaReminders) | **POST** /organizations/{organization_id}/mfa/remind | Send MFA reminders to organization members
[**withdrawTotpEnrollment()**](MFAApi.md#withdrawTotpEnrollment) | **DELETE** /users/{user_id}/totp | Withdraw TOTP enrollment


## `confirmTotpEnrollment()`

```php
confirmTotpEnrollment($userId, $confirmTotpEnrollmentRequest): \Upsun\Model\ConfirmTotpEnrollment200Response
```

Confirm TOTP enrollment

Confirms the given TOTP enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$confirmTotpEnrollmentRequest = new \Upsun\Model\ConfirmTotpEnrollmentRequest(); // \Upsun\Model\ConfirmTotpEnrollmentRequest | 

try {
    $result = $apiInstance->confirmTotpEnrollment($userId, $confirmTotpEnrollmentRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->confirmTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |
 **confirmTotpEnrollmentRequest** | [**\Upsun\Model\ConfirmTotpEnrollmentRequest**](../Model/ConfirmTotpEnrollmentRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\ConfirmTotpEnrollment200Response**](../Model/ConfirmTotpEnrollment200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `disableOrgMfaEnforcement()`

```php
disableOrgMfaEnforcement($organizationId)
```

Disable organization MFA enforcement

Disables MFA enforcement for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.

try {
    $apiInstance->disableOrgMfaEnforcement($organizationId);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->disableOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |

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

## `enableOrgMfaEnforcement()`

```php
enableOrgMfaEnforcement($organizationId)
```

Enable organization MFA enforcement

Enables MFA enforcement for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.

try {
    $apiInstance->enableOrgMfaEnforcement($organizationId);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->enableOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |

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

## `getOrgMfaEnforcement()`

```php
getOrgMfaEnforcement($organizationId): \Upsun\Model\OrganizationMFAEnforcement
```

Get organization MFA settings

Retrieves MFA settings for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrgMfaEnforcement($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->getOrgMfaEnforcement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |

### Return type

[**\Upsun\Model\OrganizationMFAEnforcement**](../Model/OrganizationMFAEnforcement.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTotpEnrollment()`

```php
getTotpEnrollment($userId): \Upsun\Model\GetTotpEnrollment200Response
```

Get information about TOTP enrollment

Retrieves TOTP enrollment information.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->getTotpEnrollment($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->getTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |

### Return type

[**\Upsun\Model\GetTotpEnrollment200Response**](../Model/GetTotpEnrollment200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recreateRecoveryCodes()`

```php
recreateRecoveryCodes($userId): \Upsun\Model\ConfirmTotpEnrollment200Response
```

Re-create recovery codes

Re-creates recovery codes for the MFA enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $result = $apiInstance->recreateRecoveryCodes($userId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->recreateRecoveryCodes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |

### Return type

[**\Upsun\Model\ConfirmTotpEnrollment200Response**](../Model/ConfirmTotpEnrollment200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendOrgMfaReminders()`

```php
sendOrgMfaReminders($organizationId, $sendOrgMfaRemindersRequest): array<string,\Upsun\Model\SendOrgMfaReminders200ResponseValue>
```

Send MFA reminders to organization members

Sends a reminder about setting up MFA to the specified organization members.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$sendOrgMfaRemindersRequest = new \Upsun\Model\SendOrgMfaRemindersRequest(); // \Upsun\Model\SendOrgMfaRemindersRequest

try {
    $result = $apiInstance->sendOrgMfaReminders($organizationId, $sendOrgMfaRemindersRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->sendOrgMfaReminders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **sendOrgMfaRemindersRequest** | [**\Upsun\Model\SendOrgMfaRemindersRequest**](../Model/SendOrgMfaRemindersRequest.md)|  | [optional]

### Return type

[**array<string,\Upsun\Model\SendOrgMfaReminders200ResponseValue>**](../Model/SendOrgMfaReminders200ResponseValue.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `withdrawTotpEnrollment()`

```php
withdrawTotpEnrollment($userId)
```

Withdraw TOTP enrollment

Withdraws from the TOTP enrollment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\MFAApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$userId = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.

try {
    $apiInstance->withdrawTotpEnrollment($userId);
} catch (Exception $e) {
    echo 'Exception when calling MFAApi->withdrawTotpEnrollment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **string**| The ID of the user. |

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
