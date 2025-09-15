# Upsun\OrganizationProjectsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getOrgProject()**](OrganizationProjectsApi.md#getOrgProject) | **GET** /organizations/{organization_id}/projects/{project_id} | Get project
[**listOrgProjects()**](OrganizationProjectsApi.md#listOrgProjects) | **GET** /organizations/{organization_id}/projects | List projects


## `getOrgProject()`

```php
getOrgProject($organizationId, $projectId): \Upsun\Model\OrganizationProject
```

Get project

Retrieves the specified project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $result = $apiInstance->getOrgProject($organizationId, $projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->getOrgProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **projectId** | **string**| The ID of the project. |

### Return type

[**\Upsun\Model\OrganizationProject**](../Model/OrganizationProject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgProjects()`

```php
listOrgProjects($organizationId, $filterId, $filterTitle, $filterStatus, $filterUpdatedAt, $filterCreatedAt, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListOrgProjects200Response
```

List projects

Retrieves a list of projects for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$filterId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `id` using one or more operators.
$filterTitle = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `title` using one or more operators.
$filterStatus = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `status` using one or more operators.
$filterUpdatedAt = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$filterCreatedAt = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `created_at` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `id`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listOrgProjects($organizationId, $filterId, $filterTitle, $filterStatus, $filterUpdatedAt, $filterCreatedAt, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->listOrgProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **filterId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional]
 **filterTitle** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;title&#x60; using one or more operators. | [optional]
 **filterStatus** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;status&#x60; using one or more operators. | [optional]
 **filterUpdatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional]
 **filterCreatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;created_at&#x60; using one or more operators. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;id&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\Upsun\Model\ListOrgProjects200Response**](../Model/ListOrgProjects200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
