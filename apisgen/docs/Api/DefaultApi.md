# OpenAPI\Client\DefaultApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listTickets()**](DefaultApi.md#listTickets) | **GET** /tickets | List support tickets


## `listTickets()`

```php
listTickets($filter_ticket_id, $filter_created, $filter_updated, $filter_type, $filter_priority, $filter_status, $filter_requester_id, $filter_submitter_id, $filter_assignee_id, $filter_has_incidents, $filter_due, $search, $page): \OpenAPI\Client\Model\ListTickets200Response
```

List support tickets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$filter_ticket_id = 56; // int | The ID of the ticket.
$filter_created = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. The time when the support ticket was created.
$filter_updated = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. The time when the support ticket was updated.
$filter_type = 'filter_type_example'; // string | The type of the support ticket.
$filter_priority = 'filter_priority_example'; // string | The priority of the support ticket.
$filter_status = 'filter_status_example'; // string | The status of the support ticket.
$filter_requester_id = 'filter_requester_id_example'; // string | UUID of the ticket requester. Converted from the ZID value.
$filter_submitter_id = 'filter_submitter_id_example'; // string | UUID of the ticket submitter. Converted from the ZID value.
$filter_assignee_id = 'filter_assignee_id_example'; // string | UUID of the ticket assignee. Converted from the ZID value.
$filter_has_incidents = True; // bool | Whether or not this ticket has incidents.
$filter_due = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | ISO dateformat expected. A time that the ticket is due at.
$search = 'search_example'; // string | Search string for the ticket subject and description.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listTickets($filter_ticket_id, $filter_created, $filter_updated, $filter_type, $filter_priority, $filter_status, $filter_requester_id, $filter_submitter_id, $filter_assignee_id, $filter_has_incidents, $filter_due, $search, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->listTickets: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **filter_ticket_id** | **int**| The ID of the ticket. | [optional]
 **filter_created** | **\DateTime**| ISO dateformat expected. The time when the support ticket was created. | [optional]
 **filter_updated** | **\DateTime**| ISO dateformat expected. The time when the support ticket was updated. | [optional]
 **filter_type** | **string**| The type of the support ticket. | [optional]
 **filter_priority** | **string**| The priority of the support ticket. | [optional]
 **filter_status** | **string**| The status of the support ticket. | [optional]
 **filter_requester_id** | **string**| UUID of the ticket requester. Converted from the ZID value. | [optional]
 **filter_submitter_id** | **string**| UUID of the ticket submitter. Converted from the ZID value. | [optional]
 **filter_assignee_id** | **string**| UUID of the ticket assignee. Converted from the ZID value. | [optional]
 **filter_has_incidents** | **bool**| Whether or not this ticket has incidents. | [optional]
 **filter_due** | **\DateTime**| ISO dateformat expected. A time that the ticket is due at. | [optional]
 **search** | **string**| Search string for the ticket subject and description. | [optional]
 **page** | **int**| Page to be displayed. Defaults to 1. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListTickets200Response**](../Model/ListTickets200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
