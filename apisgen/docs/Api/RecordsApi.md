# OpenAPI\Client\RecordsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listOrgPlanRecords()**](RecordsApi.md#listOrgPlanRecords) | **GET** /organizations/{organization_id}/records/plan | List plan records
[**listOrgUsageRecords()**](RecordsApi.md#listOrgUsageRecords) | **GET** /organizations/{organization_id}/records/usage | List usage records


## `listOrgPlanRecords()`

```php
listOrgPlanRecords($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page): \OpenAPI\Client\Model\ListOrgPlanRecords200Response
```

List plan records

Retrieves plan records for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RecordsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_subscription_id = 'filter_subscription_id_example'; // string | The ID of the subscription
$filter_plan = 'filter_plan_example'; // string | The plan type of the subscription.
$filter_status = 'filter_status_example'; // string | The status of the plan record.
$filter_start = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The start of the observation period for the record. E.g. filter[start]=2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01
$filter_end = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The end of the observation period for the record. E.g. filter[end]=2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01
$filter_started_at = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]=2020-01-01&filter[started_at][operator]=>
$filter_ended_at = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]=2020-01-01&filter[ended_at][operator]=>
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgPlanRecords($organization_id, $filter_subscription_id, $filter_plan, $filter_status, $filter_start, $filter_end, $filter_started_at, $filter_ended_at, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecordsApi->listOrgPlanRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filter_subscription_id** | **string**| The ID of the subscription | [optional]
 **filter_plan** | **string**| The plan type of the subscription. | [optional]
 **filter_status** | **string**| The status of the plan record. | [optional]
 **filter_start** | **\DateTime**| The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 | [optional]
 **filter_end** | **\DateTime**| The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 | [optional]
 **filter_started_at** | **\DateTime**| The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; | [optional]
 **filter_ended_at** | **\DateTime**| The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListOrgPlanRecords200Response**](../Model/ListOrgPlanRecords200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgUsageRecords()`

```php
listOrgUsageRecords($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page): \OpenAPI\Client\Model\ListOrgUsageRecords200Response
```

List usage records

Retrieves usage records for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RecordsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_subscription_id = 'filter_subscription_id_example'; // string | The ID of the subscription
$filter_usage_group = 'filter_usage_group_example'; // string | Filter records by the type of usage.
$filter_start = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The start of the observation period for the record. E.g. filter[start]=2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01
$filter_started_at = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]=2020-01-01&filter[started_at][operator]=>
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgUsageRecords($organization_id, $filter_subscription_id, $filter_usage_group, $filter_start, $filter_started_at, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecordsApi->listOrgUsageRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filter_subscription_id** | **string**| The ID of the subscription | [optional]
 **filter_usage_group** | **string**| Filter records by the type of usage. | [optional]
 **filter_start** | **\DateTime**| The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 | [optional]
 **filter_started_at** | **\DateTime**| The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListOrgUsageRecords200Response**](../Model/ListOrgUsageRecords200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
