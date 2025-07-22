# OpenAPI\Client\DomainManagementApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProjectsDomains()**](DomainManagementApi.md#createProjectsDomains) | **POST** /projects/{projectId}/domains | Add a project domain
[**createProjectsEnvironmentsDomains()**](DomainManagementApi.md#createProjectsEnvironmentsDomains) | **POST** /projects/{projectId}/environments/{environmentId}/domains | Add an environment domain
[**deleteProjectsDomains()**](DomainManagementApi.md#deleteProjectsDomains) | **DELETE** /projects/{projectId}/domains/{domainId} | Delete a project domain
[**deleteProjectsEnvironmentsDomains()**](DomainManagementApi.md#deleteProjectsEnvironmentsDomains) | **DELETE** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Delete an environment domain
[**getProjectsDomains()**](DomainManagementApi.md#getProjectsDomains) | **GET** /projects/{projectId}/domains/{domainId} | Get a project domain
[**getProjectsEnvironmentsDomains()**](DomainManagementApi.md#getProjectsEnvironmentsDomains) | **GET** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Get an environment domain
[**listProjectsDomains()**](DomainManagementApi.md#listProjectsDomains) | **GET** /projects/{projectId}/domains | Get list of project domains
[**listProjectsEnvironmentsDomains()**](DomainManagementApi.md#listProjectsEnvironmentsDomains) | **GET** /projects/{projectId}/environments/{environmentId}/domains | Get a list of environment domains
[**updateProjectsDomains()**](DomainManagementApi.md#updateProjectsDomains) | **PATCH** /projects/{projectId}/domains/{domainId} | Update a project domain
[**updateProjectsEnvironmentsDomains()**](DomainManagementApi.md#updateProjectsEnvironmentsDomains) | **PATCH** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Update an environment domain


## `createProjectsDomains()`

```php
createProjectsDomains($project_id, $domain_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Add a project domain

Add a single domain to a project. If the `ssl` field is left blank without an object containing a PEM-encoded SSL certificate, a certificate will [be provisioned for you via Let's Encrypt.](https://docs.platform.sh/configuration/routes/https.html#lets-encrypt)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$domain_create_input = new \OpenAPI\Client\Model\DomainCreateInput(); // \OpenAPI\Client\Model\DomainCreateInput | 

try {
    $result = $apiInstance->createProjectsDomains($project_id, $domain_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->createProjectsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **domain_create_input** | [**\OpenAPI\Client\Model\DomainCreateInput**](../Model/DomainCreateInput.md)|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createProjectsEnvironmentsDomains()`

```php
createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input): \OpenAPI\Client\Model\AcceptedResponse
```

Add an environment domain

Add a single domain to an environment. If the environment is not production, the `replacement_for` field is required, which binds a new domain to an existing one from a production environment. If the `ssl` field is left blank without an object containing a PEM-encoded SSL certificate, a certificate will [be provisioned for you via Let's Encrypt](https://docs.platform.sh/configuration/routes/https.html#lets-encrypt).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$domain_create_input = new \OpenAPI\Client\Model\DomainCreateInput(); // \OpenAPI\Client\Model\DomainCreateInput | 

try {
    $result = $apiInstance->createProjectsEnvironmentsDomains($project_id, $environment_id, $domain_create_input);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->createProjectsEnvironmentsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **domain_create_input** | [**\OpenAPI\Client\Model\DomainCreateInput**](../Model/DomainCreateInput.md)|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsDomains()`

```php
deleteProjectsDomains($project_id, $domain_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete a project domain

Delete a single user-specified domain associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$domain_id = 'domain_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsDomains($project_id, $domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->deleteProjectsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **domain_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteProjectsEnvironmentsDomains()`

```php
deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id): \OpenAPI\Client\Model\AcceptedResponse
```

Delete an environment domain

Delete a single user-specified domain associated with an environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$domain_id = 'domain_id_example'; // string

try {
    $result = $apiInstance->deleteProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->deleteProjectsEnvironmentsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **domain_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsDomains()`

```php
getProjectsDomains($project_id, $domain_id): \OpenAPI\Client\Model\Domain
```

Get a project domain

Retrieve information about a single user-specified domain associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$domain_id = 'domain_id_example'; // string

try {
    $result = $apiInstance->getProjectsDomains($project_id, $domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->getProjectsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **domain_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsEnvironmentsDomains()`

```php
getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id): \OpenAPI\Client\Model\Domain
```

Get an environment domain

Retrieve information about a single user-specified domain associated with an environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$domain_id = 'domain_id_example'; // string

try {
    $result = $apiInstance->getProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->getProjectsEnvironmentsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **domain_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Domain**](../Model/Domain.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsDomains()`

```php
listProjectsDomains($project_id): \OpenAPI\Client\Model\Domain[]
```

Get list of project domains

Retrieve a list of objects representing the user-specified domains associated with a project. Note that this does *not* return the domains automatically assigned to a project that appear under \"Access site\" on the user interface.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsDomains($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->listProjectsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Domain[]**](../Model/Domain.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsEnvironmentsDomains()`

```php
listProjectsEnvironmentsDomains($project_id, $environment_id): \OpenAPI\Client\Model\Domain[]
```

Get a list of environment domains

Retrieve a list of objects representing the user-specified domains associated with an environment. Note that this does *not* return the `.platformsh.site` subdomains, which are automatically assigned to the environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string

try {
    $result = $apiInstance->listProjectsEnvironmentsDomains($project_id, $environment_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->listProjectsEnvironmentsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Domain[]**](../Model/Domain.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsDomains()`

```php
updateProjectsDomains($project_id, $domain_id, $domain_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update a project domain

Update the information associated with a single user-specified domain associated with a project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$domain_id = 'domain_id_example'; // string
$domain_patch = new \OpenAPI\Client\Model\DomainPatch(); // \OpenAPI\Client\Model\DomainPatch | 

try {
    $result = $apiInstance->updateProjectsDomains($project_id, $domain_id, $domain_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->updateProjectsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **domain_id** | **string**|  |
 **domain_patch** | [**\OpenAPI\Client\Model\DomainPatch**](../Model/DomainPatch.md)|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateProjectsEnvironmentsDomains()`

```php
updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch): \OpenAPI\Client\Model\AcceptedResponse
```

Update an environment domain

Update the information associated with a single user-specified domain associated with an environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DomainManagementApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$environment_id = 'environment_id_example'; // string
$domain_id = 'domain_id_example'; // string
$domain_patch = new \OpenAPI\Client\Model\DomainPatch(); // \OpenAPI\Client\Model\DomainPatch | 

try {
    $result = $apiInstance->updateProjectsEnvironmentsDomains($project_id, $environment_id, $domain_id, $domain_patch);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DomainManagementApi->updateProjectsEnvironmentsDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **environment_id** | **string**|  |
 **domain_id** | **string**|  |
 **domain_patch** | [**\OpenAPI\Client\Model\DomainPatch**](../Model/DomainPatch.md)|  |

### Return type

[**\OpenAPI\Client\Model\AcceptedResponse**](../Model/AcceptedResponse.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
