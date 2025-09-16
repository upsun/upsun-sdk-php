# Upsun\CertManagementApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsCertificates()**](CertManagementApi.md#createProjectsCertificates) | **POST** /projects/{projectId}/certificates | Add an SSL certificate
[**deleteProjectsCertificates()**](CertManagementApi.md#deleteProjectsCertificates) | **DELETE** /projects/{projectId}/certificates/{certificateId} | Delete an SSL certificate
[**getProjectsCertificates()**](CertManagementApi.md#getProjectsCertificates) | **GET** /projects/{projectId}/certificates/{certificateId} | Get an SSL certificate
[**listProjectsCertificates()**](CertManagementApi.md#listProjectsCertificates) | **GET** /projects/{projectId}/certificates | Get list of SSL certificates
[**updateProjectsCertificates()**](CertManagementApi.md#updateProjectsCertificates) | **PATCH** /projects/{projectId}/certificates/{certificateId} | Update an SSL certificate


## `createProjectsCertificates()`

```php
createProjectsCertificates($projectId, $certificateCreateInput): \Upsun\Model\AcceptedResponse
```

Add an SSL certificate

Add a single SSL certificate to a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateCreateInput = new \Upsun\Model\CertificateCreateInput(); // \Upsun\Model\CertificateCreateInput | 

try {
    $result = $apiInstance->createProjectsCertificates($projectId, $certificateCreateInput);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->createProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **certificateCreateInput** | [**\Upsun\Model\CertificateCreateInput**](../Model/CertificateCreateInput.md)|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsCertificates()`

```php
deleteProjectsCertificates($projectId, $certificateId): \Upsun\Model\AcceptedResponse
```

Delete an SSL certificate

Delete a single SSL certificate associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateId = 'certificateId_example'; // string

try {
    $result = $apiInstance->deleteProjectsCertificates($projectId, $certificateId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->deleteProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **certificateId** | **string**|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsCertificates()`

```php
getProjectsCertificates($projectId, $certificateId): \Upsun\Model\Certificate
```

Get an SSL certificate

Retrieve information about a single SSL certificate associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateId = 'certificateId_example'; // string

try {
    $result = $apiInstance->getProjectsCertificates($projectId, $certificateId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->getProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **certificateId** | **string**|  |

### Return type

[**\Upsun\Model\Certificate**](../Model/Certificate.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsCertificates()`

```php
listProjectsCertificates($projectId): \Upsun\Model\Certificate[]
```

Get list of SSL certificates

Retrieve a list of objects representing the SSL certificates associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsCertificates($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->listProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |

### Return type

[**\Upsun\Model\Certificate[]**](../Model/Certificate.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsCertificates()`

```php
updateProjectsCertificates($projectId, $certificateId, $certificatePatch): \Upsun\Model\AcceptedResponse
```

Update an SSL certificate

Update a single SSL certificate associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateId = 'certificateId_example'; // string
$certificatePatch = new \Upsun\Model\CertificatePatch(); // \Upsun\Model\CertificatePatch | 

try {
    $result = $apiInstance->updateProjectsCertificates($projectId, $certificateId, $certificatePatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->updateProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **projectId** | **string**|  |
 **certificateId** | **string**|  |
 **certificatePatch** | [**\Upsun\Model\CertificatePatch**](../Model/CertificatePatch.md)|  |

### Return type

[**\Upsun\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
