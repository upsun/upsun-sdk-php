# [Upsun\Api\CertManagementApi](../src/Api/CertManagementApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createProjectsCertificates()**](CertManagementApi.md#createProjectsCertificates) | **POST** /projects/{projectId}/certificates | Add an SSL certificate | https://docs.upsun.com/api/#tag/Cert-Management/operation/create-projects-certificates |
| [**deleteProjectsCertificates()**](CertManagementApi.md#deleteProjectsCertificates) | **DELETE** /projects/{projectId}/certificates/{certificateId} | Delete an SSL certificate | https://docs.upsun.com/api/#tag/Cert-Management/operation/delete-projects-certificates |
| [**getProjectsCertificates()**](CertManagementApi.md#getProjectsCertificates) | **GET** /projects/{projectId}/certificates/{certificateId} | Get an SSL certificate | https://docs.upsun.com/api/#tag/Cert-Management/operation/get-projects-certificates |
| [**getProjectsProvisioners()**](CertManagementApi.md#getProjectsProvisioners) | **GET** /projects/{projectId}/provisioners/{certificateProvisionerDocumentId} | Get Projects Provisioners | https://docs.upsun.com/api/#tag/Cert-Management/operation/get-projects-provisioners |
| [**listProjectsCertificates()**](CertManagementApi.md#listProjectsCertificates) | **GET** /projects/{projectId}/certificates | Get list of SSL certificates | https://docs.upsun.com/api/#tag/Cert-Management/operation/list-projects-certificates |
| [**listProjectsProvisioners()**](CertManagementApi.md#listProjectsProvisioners) | **GET** /projects/{projectId}/provisioners | List Project Certificate Provisioners | https://docs.upsun.com/api/#tag/Cert-Management/operation/list-projects-provisioners |
| [**updateProjectsCertificates()**](CertManagementApi.md#updateProjectsCertificates) | **PATCH** /projects/{projectId}/certificates/{certificateId} | Update an SSL certificate | https://docs.upsun.com/api/#tag/Cert-Management/operation/update-projects-certificates |
| [**updateProjectsProvisioners()**](CertManagementApi.md#updateProjectsProvisioners) | **PATCH** /projects/{projectId}/provisioners/{certificateProvisionerDocumentId} | Update Projects Provisioners | https://docs.upsun.com/api/#tag/Cert-Management/operation/update-projects-provisioners |


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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateCreateInput** | [**\Upsun\Model\CertificateCreateInput**](../Model/CertificateCreateInput.md)|  | |

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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateId** | **string**|  | |

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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateId** | **string**|  | |

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

## `getProjectsProvisioners()`

```php
getProjectsProvisioners($projectId, $certificateProvisionerDocumentId): \Upsun\Model\CertificateProvisioner
```

Get Projects Provisioners

Retrieves the details of a specific certificate provisioner within a project. Use this endpoint to inspect the configuration, status, and settings of the provisioner identified by `certificateProvisionerDocumentId`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
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
    echo 'Exception when calling CertManagementApi->getProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
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

## `listProjectsCertificates()`

```php
listProjectsCertificates($projectId): \Upsun\Model\AcceptedResponse
```

Get list of SSL certificates

Retrieve a list of objects representing the SSL certificates associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

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

## `listProjectsProvisioners()`

```php
listProjectsProvisioners($projectId): \Upsun\Model\AcceptedResponse
```

List Project Certificate Provisioners

Retrieves all certificate provisioners associated with a specific project. Use this endpoint to view the configuration, status, and settings of each provisioner. The response includes a collection of provisioner objects.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsProvisioners($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CertManagementApi->listProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **certificateId** | **string**|  | |
| **certificatePatch** | [**\Upsun\Model\CertificatePatch**](../Model/CertificatePatch.md)|  | |

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

## `updateProjectsProvisioners()`

```php
updateProjectsProvisioners($projectId, $certificateProvisionerDocumentId, $certificateProvisionerPatch): \Upsun\Model\AcceptedResponse
```

Update Projects Provisioners

Updates the configuration of an existing certificate provisioner within a project. Use this endpoint to modify settings such as certificate sources, deployment options, or other provisioner-specific parameters without creating a new provisioner.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\CertManagementApi(
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
    echo 'Exception when calling CertManagementApi->updateProjectsProvisioners: ', $e->getMessage(), PHP_EOL;
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
