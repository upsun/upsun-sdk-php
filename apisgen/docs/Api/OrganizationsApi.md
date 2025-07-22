# OpenAPI\Client\OrganizationsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createOrg()**](OrganizationsApi.md#createOrg) | **POST** /organizations | Create organization |
| [**deleteOrg()**](OrganizationsApi.md#deleteOrg) | **DELETE** /organizations/{organization_id} | Delete organization |
| [**getOrg()**](OrganizationsApi.md#getOrg) | **GET** /organizations/{organization_id} | Get organization |
| [**listOrgs()**](OrganizationsApi.md#listOrgs) | **GET** /organizations | List organizations |
| [**listUserOrgs()**](OrganizationsApi.md#listUserOrgs) | **GET** /users/{user_id}/organizations | User organizations |
| [**updateOrg()**](OrganizationsApi.md#updateOrg) | **PATCH** /organizations/{organization_id} | Update organization |


## `createOrg()`

```php
createOrg($create_org_request): \OpenAPI\Client\Model\Organization
```

Create organization

Creates a new organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_org_request = new \OpenAPI\Client\Model\CreateOrgRequest(); // \OpenAPI\Client\Model\CreateOrgRequest

try {
    $result = $apiInstance->createOrg($create_org_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->createOrg: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_org_request** | [**\OpenAPI\Client\Model\CreateOrgRequest**](../Model/CreateOrgRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\Organization**](../Model/Organization.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteOrg()`

```php
deleteOrg($organization_id)
```

Delete organization

Deletes the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $apiInstance->deleteOrg($organization_id);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->deleteOrg: ', $e->getMessage(), PHP_EOL;
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
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrg()`

```php
getOrg($organization_id): \OpenAPI\Client\Model\Organization
```

Get organization

Retrieves the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.

try {
    $result = $apiInstance->getOrg($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->getOrg: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |

### Return type

[**\OpenAPI\Client\Model\Organization**](../Model/Organization.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgs()`

```php
listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListOrgs200Response
```

List organizations

Non-admin users will only see organizations they are members of.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$filter_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `id` using one or more operators.
$filter_owner_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `owner_id` using one or more operators.
$filter_name = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `name` using one or more operators.
$filter_label = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `label` using one or more operators.
$filter_vendor = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `vendor` using one or more operators.
$filter_capabilities = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\ArrayFilter(); // \OpenAPI\Client\Model\ArrayFilter | Allows filtering by `capabilites` using one or more operators.
$filter_status = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`.
$filter_updated_at = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\DateTimeFilter(); // \OpenAPI\Client\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listOrgs($filter_id, $filter_owner_id, $filter_name, $filter_label, $filter_vendor, $filter_capabilities, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->listOrgs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filter_id** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional] |
| **filter_owner_id** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;owner_id&#x60; using one or more operators. | [optional] |
| **filter_name** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;name&#x60; using one or more operators. | [optional] |
| **filter_label** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;label&#x60; using one or more operators. | [optional] |
| **filter_vendor** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;vendor&#x60; using one or more operators. | [optional] |
| **filter_capabilities** | [**\OpenAPI\Client\Model\ArrayFilter**](../Model/.md)| Allows filtering by &#x60;capabilites&#x60; using one or more operators. | [optional] |
| **filter_status** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. | [optional] |
| **filter_updated_at** | [**\OpenAPI\Client\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional] |
| **page_size** | **int**| Determines the number of items to show. | [optional] |
| **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListOrgs200Response**](../Model/ListOrgs200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listUserOrgs()`

```php
listUserOrgs($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort): \OpenAPI\Client\Model\ListUserOrgs200Response
```

User organizations

Retrieves organizations that the specified user is a member of.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$filter_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `id` using one or more operators.
$filter_vendor = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `vendor` using one or more operators.
$filter_status = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\StringFilter(); // \OpenAPI\Client\Model\StringFilter | Allows filtering by `status` using one or more operators.<br> Defaults to `filter[status][in]=active,restricted,suspended`.
$filter_updated_at = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\DateTimeFilter(); // \OpenAPI\Client\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$page_size = 56; // int | Determines the number of items to show.
$page_before = 'page_before_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$page_after = 'page_after_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `name`, `label`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listUserOrgs($user_id, $filter_id, $filter_vendor, $filter_status, $filter_updated_at, $page_size, $page_before, $page_after, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->listUserOrgs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**| The ID of the user. | |
| **filter_id** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;id&#x60; using one or more operators. | [optional] |
| **filter_vendor** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;vendor&#x60; using one or more operators. | [optional] |
| **filter_status** | [**\OpenAPI\Client\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;status&#x60; using one or more operators.&lt;br&gt; Defaults to &#x60;filter[status][in]&#x3D;active,restricted,suspended&#x60;. | [optional] |
| **filter_updated_at** | [**\OpenAPI\Client\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional] |
| **page_size** | **int**| Determines the number of items to show. | [optional] |
| **page_before** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **page_after** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional] |
| **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;name&#x60;, &#x60;label&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListUserOrgs200Response**](../Model/ListUserOrgs200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrg()`

```php
updateOrg($organization_id, $update_org_request): \OpenAPI\Client\Model\Organization
```

Update organization

Updates the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$update_org_request = new \OpenAPI\Client\Model\UpdateOrgRequest(); // \OpenAPI\Client\Model\UpdateOrgRequest

try {
    $result = $apiInstance->updateOrg($organization_id, $update_org_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->updateOrg: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **update_org_request** | [**\OpenAPI\Client\Model\UpdateOrgRequest**](../Model/UpdateOrgRequest.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\Organization**](../Model/Organization.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
