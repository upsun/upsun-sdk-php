# [Upsun\Api\OrganizationProjectsApi](../src/Api/OrganizationProjectsApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**createOrgProject()**](OrganizationProjectsApi.md#createOrgProject) | **POST** /organizations/{organization_id}/projects | Create project | https://docs.upsun.com/api/#tag/Organization-Projects/operation/create-org-project |
| [**deleteOrgProject()**](OrganizationProjectsApi.md#deleteOrgProject) | **DELETE** /organizations/{organization_id}/projects/{project_id} | Delete project | https://docs.upsun.com/api/#tag/Organization-Projects/operation/delete-org-project |
| [**getOrgProject()**](OrganizationProjectsApi.md#getOrgProject) | **GET** /organizations/{organization_id}/projects/{project_id} | Get project | https://docs.upsun.com/api/#tag/Organization-Projects/operation/get-org-project |
| [**listOrgProjects()**](OrganizationProjectsApi.md#listOrgProjects) | **GET** /organizations/{organization_id}/projects | List projects | https://docs.upsun.com/api/#tag/Organization-Projects/operation/list-org-projects |
| [**queryProjectCarbon()**](OrganizationProjectsApi.md#queryProjectCarbon) | **GET** /organizations/{organization_id}/projects/{project_id}/metrics/carbon | Query project carbon emissions metrics | https://docs.upsun.com/api/#tag/Organization-Projects/operation/query-project-carbon |
| [**updateOrgProject()**](OrganizationProjectsApi.md#updateOrgProject) | **PATCH** /organizations/{organization_id}/projects/{project_id} | Update project | https://docs.upsun.com/api/#tag/Organization-Projects/operation/update-org-project |


## `createOrgProject()`

```php
createOrgProject($organizationId, $createOrgProjectRequest): \Upsun\Model\OrganizationProject
```

Create project

Creates a new project in the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$createOrgProjectRequest = new \Upsun\Model\CreateOrgProjectRequest(); // \Upsun\Model\CreateOrgProjectRequest

try {
    $result = $apiInstance->createOrgProject($organizationId, $createOrgProjectRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->createOrgProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **createOrgProjectRequest** | [**\Upsun\Model\CreateOrgProjectRequest**](../Model/CreateOrgProjectRequest.md)|  | |

### Return type

[**\Upsun\Model\OrganizationProject**](../Model/OrganizationProject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteOrgProject()`

```php
deleteOrgProject($organizationId, $projectId)
```

Delete project

Deletes the specified project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$projectId = 'projectId_example'; // string | The ID of the project.

try {
    $apiInstance->deleteOrgProject($organizationId, $projectId);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->deleteOrgProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **projectId** | **string**| The ID of the project. | |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **projectId** | **string**| The ID of the project. | |

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
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
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

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **filterId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional] |
| **filterTitle** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;title&#x60; using one or more operators. | [optional] |
| **filterStatus** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;status&#x60; using one or more operators. | [optional] |
| **filterUpdatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional] |
| **filterCreatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;created_at&#x60; using one or more operators. | [optional] |
| **pageSize** | **int**| Determines the number of items to show. | [optional] |
| **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;id&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

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

## `queryProjectCarbon()`

```php
queryProjectCarbon($organizationId, $projectId, $from, $to, $interval): \Upsun\Model\ProjectCarbon
```

Query project carbon emissions metrics

Queries the carbon emission data for the specified project using the supplied parameters.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$projectId = 'projectId_example'; // string | The ID of the project.
$from = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | The start of the time frame for the query. Inclusive.
$to = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | The end of the time frame for the query. Exclusive.
$interval = 'interval_example'; // string | The interval by which the query groups the results. of the time frame for the query. Exclusive.

try {
    $result = $apiInstance->queryProjectCarbon($organizationId, $projectId, $from, $to, $interval);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->queryProjectCarbon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **projectId** | **string**| The ID of the project. | |
| **from** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| The start of the time frame for the query. Inclusive. | [optional] |
| **to** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| The end of the time frame for the query. Exclusive. | [optional] |
| **interval** | **string**| The interval by which the query groups the results. of the time frame for the query. Exclusive. | [optional] |

### Return type

[**\Upsun\Model\ProjectCarbon**](../Model/ProjectCarbon.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgProject()`

```php
updateOrgProject($organizationId, $projectId, $updateOrgProjectRequest): \Upsun\Model\OrganizationProject
```

Update project

Updates the specified project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\OrganizationProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$projectId = 'projectId_example'; // string | The ID of the project.
$updateOrgProjectRequest = new \Upsun\Model\UpdateOrgProjectRequest(); // \Upsun\Model\UpdateOrgProjectRequest

try {
    $result = $apiInstance->updateOrgProject($organizationId, $projectId, $updateOrgProjectRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationProjectsApi->updateOrgProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **projectId** | **string**| The ID of the project. | |
| **updateOrgProjectRequest** | [**\Upsun\Model\UpdateOrgProjectRequest**](../Model/UpdateOrgProjectRequest.md)|  | [optional] |

### Return type

[**\Upsun\Model\OrganizationProject**](../Model/OrganizationProject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
