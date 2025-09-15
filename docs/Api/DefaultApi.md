# Upsun\DefaultApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listTickets()**](DefaultApi.md#listTickets) | **GET** /tickets | List support tickets


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
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
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

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filterTicketId** | **int**| The ID of the ticket. | [optional]
 **filterCreated** | **\DateTime**| ISO dateformat expected. The time when the support ticket was created. | [optional]
 **filterUpdated** | **\DateTime**| ISO dateformat expected. The time when the support ticket was updated. | [optional]
 **filterType** | **string**| The type of the support ticket. | [optional]
 **filterPriority** | **string**| The priority of the support ticket. | [optional]
 **filterStatus** | **string**| The status of the support ticket. | [optional]
 **filterRequesterId** | **string**| UUID of the ticket requester. Converted from the ZID value. | [optional]
 **filterSubmitterId** | **string**| UUID of the ticket submitter. Converted from the ZID value. | [optional]
 **filterAssigneeId** | **string**| UUID of the ticket assignee. Converted from the ZID value. | [optional]
 **filterHasIncidents** | **bool**| Whether or not this ticket has incidents. | [optional]
 **filterDue** | **\DateTime**| ISO dateformat expected. A time that the ticket is due at. | [optional]
 **search** | **string**| Search string for the ticket subject and description. | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

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
