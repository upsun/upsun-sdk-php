# [Upsun\Api\DefaultApi](../src/Api/DefaultApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**listTickets()**](DefaultApi.md#listTickets) | **GET** /tickets | List support tickets | https://docs.upsun.com/api/#tag//operation/list-tickets |
| [**queryOrganiationCarbon()**](DefaultApi.md#queryOrganiationCarbon) | **GET** /organizations/{organization_id}/metrics/carbon | Query project carbon emissions metrics for an entire organization | https://docs.upsun.com/api/#tag//operation/query-organiation-carbon |


## `listTickets()`

```php
listTickets($filterTicketId, $filterCreated, $filterUpdated, $filterType, $filterPriority, $filterStatus, $filterRequesterId, $filterSubmitterId, $filterAssigneeId, $filterHasIncidents, $filterDue, $search, $page): \Upsun\Model\ListTickets200Response
```

List support tickets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$filterTicketId = 56; // int | The ID of the ticket.
$filterCreated = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. The time when the support ticket was created.
$filterUpdated = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. The time when the support ticket was updated.
$filterType = 'filterType_example'; // string | The type of the support ticket.
$filterPriority = 'filterPriority_example'; // string | The priority of the support ticket.
$filterStatus = 'filterStatus_example'; // string | The status of the support ticket.
$filterRequesterId = 'filterRequesterId_example'; // string | UUID of the ticket requester. Converted from the ZID value.
$filterSubmitterId = 'filterSubmitterId_example'; // string | UUID of the ticket submitter. Converted from the ZID value.
$filterAssigneeId = 'filterAssigneeId_example'; // string | UUID of the ticket assignee. Converted from the ZID value.
$filterHasIncidents = True; // bool | Whether or not this ticket has incidents.
$filterDue = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. A time that the ticket is due at.
$search = 'search_example'; // string | Search string for the ticket subject and description.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listTickets($filterTicketId, $filterCreated, $filterUpdated, $filterType, $filterPriority, $filterStatus, $filterRequesterId, $filterSubmitterId, $filterAssigneeId, $filterHasIncidents, $filterDue, $search, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->listTickets: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filterTicketId** | **int**| The ID of the ticket. | [optional] |
| **filterCreated** | **\DateTime**| ISO dateformat expected. The time when the support ticket was created. | [optional] |
| **filterUpdated** | **\DateTime**| ISO dateformat expected. The time when the support ticket was updated. | [optional] |
| **filterType** | **string**| The type of the support ticket. | [optional] |
| **filterPriority** | **string**| The priority of the support ticket. | [optional] |
| **filterStatus** | **string**| The status of the support ticket. | [optional] |
| **filterRequesterId** | **string**| UUID of the ticket requester. Converted from the ZID value. | [optional] |
| **filterSubmitterId** | **string**| UUID of the ticket submitter. Converted from the ZID value. | [optional] |
| **filterAssigneeId** | **string**| UUID of the ticket assignee. Converted from the ZID value. | [optional] |
| **filterHasIncidents** | **bool**| Whether or not this ticket has incidents. | [optional] |
| **filterDue** | **\DateTime**| ISO dateformat expected. A time that the ticket is due at. | [optional] |
| **search** | **string**| Search string for the ticket subject and description. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |

### Return type

[**\Upsun\Model\ListTickets200Response**](../Model/ListTickets200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryOrganiationCarbon()`

```php
queryOrganiationCarbon($organizationId, $from, $to, $interval): \Upsun\Model\OrganizationCarbon
```

Query project carbon emissions metrics for an entire organization

Queries the carbon emission data for all projects owned by the specified organiation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Upsun\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$from = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | The start of the time frame for the query. Inclusive.
$to = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | The end of the time frame for the query. Exclusive.
$interval = 'interval_example'; // string | The interval by which the query groups the results. of the time frame for the query. Exclusive.

try {
    $result = $apiInstance->queryOrganiationCarbon($organizationId, $from, $to, $interval);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->queryOrganiationCarbon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organizationId** | **string**| The ID of the organization. | |
| **from** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| The start of the time frame for the query. Inclusive. | [optional] |
| **to** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| The end of the time frame for the query. Exclusive. | [optional] |
| **interval** | **string**| The interval by which the query groups the results. of the time frame for the query. Exclusive. | [optional] |

### Return type

[**\Upsun\Model\OrganizationCarbon**](../Model/OrganizationCarbon.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
