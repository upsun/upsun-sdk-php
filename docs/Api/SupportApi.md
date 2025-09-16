# Upsun\SupportApi

All URIs are relative to https://api.upsun.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTicket()**](SupportApi.md#createTicket) | **POST** /tickets | Create a new support ticket
[**listTicketCategories()**](SupportApi.md#listTicketCategories) | **GET** /tickets/category | List support ticket categories
[**listTicketPriorities()**](SupportApi.md#listTicketPriorities) | **GET** /tickets/priority | List support ticket priorities
[**updateTicket()**](SupportApi.md#updateTicket) | **PATCH** /tickets/{ticket_id} | Update a ticket


## `createTicket()`

```php
createTicket($createTicketRequest): \Upsun\Model\Ticket
```

Create a new support ticket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$createTicketRequest = new \Upsun\Model\CreateTicketRequest(); // \Upsun\Model\CreateTicketRequest

try {
    $result = $apiInstance->createTicket($createTicketRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->createTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **createTicketRequest** | [**\Upsun\Model\CreateTicketRequest**](../Model/CreateTicketRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Ticket**](../Model/Ticket.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTicketCategories()`

```php
listTicketCategories($subscriptionId, $organizationId): \Upsun\Model\ListTicketCategories200ResponseInner[]
```

List support ticket categories

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription the ticket should be related to
$organizationId = 'organizationId_example'; // string | The ID of the organization the ticket should be related to

try {
    $result = $apiInstance->listTicketCategories($subscriptionId, $organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->listTicketCategories: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscriptionId** | **string**| The ID of the subscription the ticket should be related to | [optional]
 **organizationId** | **string**| The ID of the organization the ticket should be related to | [optional]

### Return type

[**\Upsun\Model\ListTicketCategories200ResponseInner[]**](../Model/ListTicketCategories200ResponseInner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTicketPriorities()`

```php
listTicketPriorities($subscriptionId, $category): \Upsun\Model\ListTicketPriorities200ResponseInner[]
```

List support ticket priorities

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription the ticket should be related to
$category = 'category_example'; // string | The category of the support ticket.

try {
    $result = $apiInstance->listTicketPriorities($subscriptionId, $category);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->listTicketPriorities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscriptionId** | **string**| The ID of the subscription the ticket should be related to | [optional]
 **category** | **string**| The category of the support ticket. | [optional]

### Return type

[**\Upsun\Model\ListTicketPriorities200ResponseInner[]**](../Model/ListTicketPriorities200ResponseInner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateTicket()`

```php
updateTicket($ticketId, $updateTicketRequest): \Upsun\Model\Ticket
```

Update a ticket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$ticketId = 'ticketId_example'; // string | The ID of the ticket
$updateTicketRequest = new \Upsun\Model\UpdateTicketRequest(); // \Upsun\Model\UpdateTicketRequest

try {
    $result = $apiInstance->updateTicket($ticketId, $updateTicketRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->updateTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticketId** | **string**| The ID of the ticket |
 **updateTicketRequest** | [**\Upsun\Model\UpdateTicketRequest**](../Model/UpdateTicketRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Ticket**](../Model/Ticket.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
