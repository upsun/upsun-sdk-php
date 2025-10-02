# [Upsun\Api\CertificateProvisionerApi](../src/Api/CertificateProvisionerApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getProjectsProvisioners()**](CertificateProvisionerApi.md#getProjectsProvisioners) | **GET** /projects/{projectId}/provisioners/{certificateProvisionerDocumentId} |  | https://docs.upsun.com/api/#tag/CertificateProvisioner/operation/get-projects-provisioners |
| [**listProjectsProvisioners()**](CertificateProvisionerApi.md#listProjectsProvisioners) | **GET** /projects/{projectId}/provisioners |  | https://docs.upsun.com/api/#tag/CertificateProvisioner/operation/list-projects-provisioners |
| [**updateProjectsProvisioners()**](CertificateProvisionerApi.md#updateProjectsProvisioners) | **PATCH** /projects/{projectId}/provisioners/{certificateProvisionerDocumentId} |  | https://docs.upsun.com/api/#tag/CertificateProvisioner/operation/update-projects-provisioners |


## `getProjectsProvisioners()`

```php
getProjectsProvisioners($projectId, $certificateProvisionerDocumentId): \Upsun\Model\CertificateProvisioner
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertificateProvisionerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateProvisionerDocumentId = 'certificateProvisionerDocumentId_example'; // string

try {
    $result = $apiInstance->getProjectsProvisioners($projectId, $certificateProvisionerDocumentId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertificateProvisionerApi->getProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateProvisionerDocumentId** | **string**|  | |

### Return type

[**\Upsun\Model\CertificateProvisioner**](../Model/CertificateProvisioner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsProvisioners()`

```php
listProjectsProvisioners($projectId): \Upsun\Model\CertificateProvisioner[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertificateProvisionerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsProvisioners($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertificateProvisionerApi->listProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\CertificateProvisioner[]**](../Model/CertificateProvisioner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsProvisioners()`

```php
updateProjectsProvisioners($projectId, $certificateProvisionerDocumentId, $certificateProvisionerPatch): \Upsun\Model\AcceptedResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertificateProvisionerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$certificateProvisionerDocumentId = 'certificateProvisionerDocumentId_example'; // string
$certificateProvisionerPatch = new \Upsun\Model\CertificateProvisionerPatch(); // \Upsun\Model\CertificateProvisionerPatch | 

try {
    $result = $apiInstance->updateProjectsProvisioners($projectId, $certificateProvisionerDocumentId, $certificateProvisionerPatch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertificateProvisionerApi->updateProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateProvisionerDocumentId** | **string**|  | |
| **certificateProvisionerPatch** | [**\Upsun\Model\CertificateProvisionerPatch**](../Model/CertificateProvisionerPatch.md)|  | |

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
