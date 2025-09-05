# Upsun\RecordsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listOrgPlanRecords()**](RecordsApi.md#listOrgPlanRecords) | **GET** /organizations/{organization_id}/records/plan | List plan records
[**listOrgUsageRecords()**](RecordsApi.md#listOrgUsageRecords) | **GET** /organizations/{organization_id}/records/usage | List usage records


## `listOrgPlanRecords()`

```php
listOrgPlanRecords($organizationId, $filterSubscriptionId, $filterPlan, $filterStatus, $filterStart, $filterEnd, $filterStartedAt, $filterEndedAt, $page): \Upsun\Model\ListOrgPlanRecords200Response
```

List plan records

Retrieves plan records for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RecordsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filterSubscriptionId = 'filterSubscriptionId_example'; // string | The ID of the subscription
$filterPlan = 'filterPlan_example'; // string | The plan type of the subscription.
$filterStatus = 'filterStatus_example'; // string | The status of the plan record.
$filterStart = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The start of the observation period for the record. E.g. filter[start]=2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01
$filterEnd = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The end of the observation period for the record. E.g. filter[end]=2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01
$filterStartedAt = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]=2020-01-01&filter[started_at][operator]=>
$filterEndedAt = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]=2020-01-01&filter[ended_at][operator]=>
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgPlanRecords($organizationId, $filterSubscriptionId, $filterPlan, $filterStatus, $filterStart, $filterEnd, $filterStartedAt, $filterEndedAt, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecordsApi->listOrgPlanRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filterSubscriptionId** | **string**| The ID of the subscription | [optional]
 **filterPlan** | **string**| The plan type of the subscription. | [optional]
 **filterStatus** | **string**| The status of the plan record. | [optional]
 **filterStart** | **\DateTime**| The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 | [optional]
 **filterEnd** | **\DateTime**| The end of the observation period for the record. E.g. filter[end]&#x3D;2018-01-01 will display all records that were active on (i.e. they started before) 2018-01-01 | [optional]
 **filterStartedAt** | **\DateTime**| The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; | [optional]
 **filterEndedAt** | **\DateTime**| The record&#39;s end timestamp. You can use this filter to list records ended after, or before a certain time. E.g. filter[ended_at][value]&#x3D;2020-01-01&amp;filter[ended_at][operator]&#x3D;&gt; | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

### Return type

[**\Upsun\Model\ListOrgPlanRecords200Response**](../Model/ListOrgPlanRecords200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgUsageRecords()`

```php
listOrgUsageRecords($organizationId, $filterSubscriptionId, $filterUsageGroup, $filterStart, $filterStartedAt, $page): \Upsun\Model\ListOrgUsageRecords200Response
```

List usage records

Retrieves usage records for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\RecordsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filterSubscriptionId = 'filterSubscriptionId_example'; // string | The ID of the subscription
$filterUsageGroup = 'filterUsageGroup_example'; // string | Filter records by the type of usage.
$filterStart = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The start of the observation period for the record. E.g. filter[start]=2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01
$filterStartedAt = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | The record's start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]=2020-01-01&filter[started_at][operator]=>
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgUsageRecords($organizationId, $filterSubscriptionId, $filterUsageGroup, $filterStart, $filterStartedAt, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecordsApi->listOrgUsageRecords: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. |
 **filterSubscriptionId** | **string**| The ID of the subscription | [optional]
 **filterUsageGroup** | **string**| Filter records by the type of usage. | [optional]
 **filterStart** | **\DateTime**| The start of the observation period for the record. E.g. filter[start]&#x3D;2018-01-01 will display all records that were active (i.e. did not end) on 2018-01-01 | [optional]
 **filterStartedAt** | **\DateTime**| The record&#39;s start timestamp. You can use this filter to list records started after, or before a certain time. E.g. filter[started_at][value]&#x3D;2020-01-01&amp;filter[started_at][operator]&#x3D;&gt; | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

### Return type

[**\Upsun\Model\ListOrgUsageRecords200Response**](../Model/ListOrgUsageRecords200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
