# Upsun\CertManagementApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsCertificates()**](CertManagementApi.md#createProjectsCertificates) | **POST** /projects/{projectId}/certificates | Add an SSL certificate
[**deleteProjectsCertificates()**](CertManagementApi.md#deleteProjectsCertificates) | **DELETE** /projects/{projectId}/certificates/{certificateId} | Delete an SSL certificate
[**getProjectsCertificates()**](CertManagementApi.md#getProjectsCertificates) | **GET** /projects/{projectId}/certificates/{certificateId} | Get an SSL certificate
[**listProjectsCertificates()**](CertManagementApi.md#listProjectsCertificates) | **GET** /projects/{projectId}/certificates | Get list of SSL certificates
[**updateProjectsCertificates()**](CertManagementApi.md#updateProjectsCertificates) | **PATCH** /projects/{projectId}/certificates/{certificateId} | Update an SSL certificate


## `createProjectsCertificates()`

```php
createProjectsCertificates($project_id, $certificate_create_input): \Upsun\Model\AcceptedResponse
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
$project_id = 'project_id_example'; // string
$certificate_create_input = new \Upsun\Model\CertificateCreateInput(); // \Upsun\Model\CertificateCreateInput | 

try {
    $result = $apiInstance->createProjectsCertificates($project_id, $certificate_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->createProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **certificate_create_input** | [**\Upsun\Model\CertificateCreateInput**](../Model/CertificateCreateInput.md)|  |

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
deleteProjectsCertificates($project_id, $certificate_id): \Upsun\Model\AcceptedResponse
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
$project_id = 'project_id_example'; // string
$certificate_id = 'certificate_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsCertificates($project_id, $certificate_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->deleteProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **certificate_id** | **string**|  |

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
getProjectsCertificates($project_id, $certificate_id): \Upsun\Model\Certificate
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
$project_id = 'project_id_example'; // string
$certificate_id = 'certificate_id_example'; // string

try {
    $result = $apiInstance->getProjectsCertificates($project_id, $certificate_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->getProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **certificate_id** | **string**|  |

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
listProjectsCertificates($project_id): \Upsun\Model\Certificate[]
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
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsCertificates($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->listProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

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
updateProjectsCertificates($project_id, $certificate_id, $certificate_patch): \Upsun\Model\AcceptedResponse
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
$project_id = 'project_id_example'; // string
$certificate_id = 'certificate_id_example'; // string
$certificate_patch = new \Upsun\Model\CertificatePatch(); // \Upsun\Model\CertificatePatch | 

try {
    $result = $apiInstance->updateProjectsCertificates($project_id, $certificate_id, $certificate_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->updateProjectsCertificates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **certificate_id** | **string**|  |
 **certificate_patch** | [**\Upsun\Model\CertificatePatch**](../Model/CertificatePatch.md)|  |

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
