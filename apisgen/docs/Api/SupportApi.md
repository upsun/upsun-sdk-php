# OpenAPI\Client\SupportApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTicket()**](SupportApi.md#createTicket) | **POST** /tickets | Create a new support ticket
[**listTicketCategories()**](SupportApi.md#listTicketCategories) | **GET** /tickets/category | List support ticket categories
[**listTicketPriorities()**](SupportApi.md#listTicketPriorities) | **GET** /tickets/priority | List support ticket priorities
[**updateTicket()**](SupportApi.md#updateTicket) | **PATCH** /tickets/{ticket_id} | Update a ticket


## `createTicket()`

```php
createTicket($create_ticket_request): \OpenAPI\Client\Model\Ticket
```

Create a new support ticket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$create_ticket_request = new \OpenAPI\Client\Model\CreateTicketRequest(); // \OpenAPI\Client\Model\CreateTicketRequest

try {
    $result = $apiInstance->createTicket($create_ticket_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->createTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **create_ticket_request** | [**\OpenAPI\Client\Model\CreateTicketRequest**](../Model/CreateTicketRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Ticket**](../Model/Ticket.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTicketCategories()`

```php
listTicketCategories($subscription_id, $organization_id): \OpenAPI\Client\Model\ListTicketCategories200ResponseInner[]
```

List support ticket categories

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription the ticket should be related to
$organization_id = 'organization_id_example'; // string | The ID of the organization the ticket should be related to

try {
    $result = $apiInstance->listTicketCategories($subscription_id, $organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->listTicketCategories: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription the ticket should be related to | [optional]
 **organization_id** | **string**| The ID of the organization the ticket should be related to | [optional]

### Return type

[**\OpenAPI\Client\Model\ListTicketCategories200ResponseInner[]**](../Model/ListTicketCategories200ResponseInner.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTicketPriorities()`

```php
listTicketPriorities($subscription_id, $category): \OpenAPI\Client\Model\ListTicketPriorities200ResponseInner[]
```

List support ticket priorities

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription the ticket should be related to
$category = 'category_example'; // string | The category of the support ticket.

try {
    $result = $apiInstance->listTicketPriorities($subscription_id, $category);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->listTicketPriorities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **subscription_id** | **string**| The ID of the subscription the ticket should be related to | [optional]
 **category** | **string**| The category of the support ticket. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListTicketPriorities200ResponseInner[]**](../Model/ListTicketPriorities200ResponseInner.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateTicket()`

```php
updateTicket($ticket_id, $update_ticket_request): \OpenAPI\Client\Model\Ticket
```

Update a ticket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SupportApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$ticket_id = 'ticket_id_example'; // string | The ID of the ticket
$update_ticket_request = new \OpenAPI\Client\Model\UpdateTicketRequest(); // \OpenAPI\Client\Model\UpdateTicketRequest

try {
    $result = $apiInstance->updateTicket($ticket_id, $update_ticket_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupportApi->updateTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ticket_id** | **string**| The ID of the ticket |
 **update_ticket_request** | [**\OpenAPI\Client\Model\UpdateTicketRequest**](../Model/UpdateTicketRequest.md)|  | [optional]

### Return type

[**\OpenAPI\Client\Model\Ticket**](../Model/Ticket.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
