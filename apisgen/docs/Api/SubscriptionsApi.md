# OpenAPI\Client\SubscriptionsApi

All URIs are relative to https://api.platform.sh, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**canCreateNewOrgSubscription()**](SubscriptionsApi.md#canCreateNewOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/can-create | Checks if the user is able to create a new project. |
| [**createOrgSubscription()**](SubscriptionsApi.md#createOrgSubscription) | **POST** /organizations/{organization_id}/subscriptions | Create subscription |
| [**deleteOrgSubscription()**](SubscriptionsApi.md#deleteOrgSubscription) | **DELETE** /organizations/{organization_id}/subscriptions/{subscription_id} | Delete subscription |
| [**estimateNewOrgSubscription()**](SubscriptionsApi.md#estimateNewOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/estimate | Estimate the price of a new subscription |
| [**estimateOrgSubscription()**](SubscriptionsApi.md#estimateOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/estimate | Estimate the price of a subscription |
| [**getOrgSubscription()**](SubscriptionsApi.md#getOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id} | Get subscription |
| [**getOrgSubscriptionCurrentUsage()**](SubscriptionsApi.md#getOrgSubscriptionCurrentUsage) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/current_usage | Get current usage for a subscription |
| [**listOrgSubscriptions()**](SubscriptionsApi.md#listOrgSubscriptions) | **GET** /organizations/{organization_id}/subscriptions | List subscriptions |
| [**listSubscriptionAddons()**](SubscriptionsApi.md#listSubscriptionAddons) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/addons | List addons for a subscription |
| [**updateOrgSubscription()**](SubscriptionsApi.md#updateOrgSubscription) | **PATCH** /organizations/{organization_id}/subscriptions/{subscription_id} | Update subscription |


## `canCreateNewOrgSubscription()`

```php
canCreateNewOrgSubscription($organization_id): \OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response
```

Checks if the user is able to create a new project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->canCreateNewOrgSubscription($organization_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->canCreateNewOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |

### Return type

[**\OpenAPI\Client\Model\CanCreateNewOrgSubscription200Response**](../Model/CanCreateNewOrgSubscription200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createOrgSubscription()`

```php
createOrgSubscription($organization_id, $create_org_subscription_request): \OpenAPI\Client\Model\SchemasSubscription
```

Create subscription

Creates a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$create_org_subscription_request = new \OpenAPI\Client\Model\CreateOrgSubscriptionRequest(); // \OpenAPI\Client\Model\CreateOrgSubscriptionRequest

try {
    $result = $apiInstance->createOrgSubscription($organization_id, $create_org_subscription_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->createOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **create_org_subscription_request** | [**\OpenAPI\Client\Model\CreateOrgSubscriptionRequest**](../Model/CreateOrgSubscriptionRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\SchemasSubscription**](../Model/SchemasSubscription.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteOrgSubscription()`

```php
deleteOrgSubscription($organization_id, $subscription_id)
```

Delete subscription

Deletes a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.

try {
    $apiInstance->deleteOrgSubscription($organization_id, $subscription_id);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->deleteOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **subscription_id** | **string**| The ID of the subscription. | |

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

## `estimateNewOrgSubscription()`

```php
estimateNewOrgSubscription($organization_id, $plan, $environments, $storage, $user_licenses, $format): \OpenAPI\Client\Model\EstimationObject
```

Estimate the price of a new subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$plan = 'plan_example'; // string | The plan type of the subscription.
$environments = 56; // int | The maximum number of environments which can be provisioned on the project.
$storage = 56; // int | The total storage available to each environment, in MiB.
$user_licenses = 56; // int | The number of user licenses.
$format = 'format_example'; // string | The format of the estimation output.

try {
    $result = $apiInstance->estimateNewOrgSubscription($organization_id, $plan, $environments, $storage, $user_licenses, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->estimateNewOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **plan** | **string**| The plan type of the subscription. | |
| **environments** | **int**| The maximum number of environments which can be provisioned on the project. | |
| **storage** | **int**| The total storage available to each environment, in MiB. | |
| **user_licenses** | **int**| The number of user licenses. | |
| **format** | **string**| The format of the estimation output. | [optional] |

### Return type

[**\OpenAPI\Client\Model\EstimationObject**](../Model/EstimationObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `estimateOrgSubscription()`

```php
estimateOrgSubscription($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format): \OpenAPI\Client\Model\EstimationObject
```

Estimate the price of a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.
$plan = 'plan_example'; // string | The plan type of the subscription.
$environments = 56; // int | The maximum number of environments which can be provisioned on the project.
$storage = 56; // int | The total storage available to each environment, in MiB.
$user_licenses = 56; // int | The number of user licenses.
$format = 'format_example'; // string | The format of the estimation output.

try {
    $result = $apiInstance->estimateOrgSubscription($organization_id, $subscription_id, $plan, $environments, $storage, $user_licenses, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->estimateOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **subscription_id** | **string**| The ID of the subscription. | |
| **plan** | **string**| The plan type of the subscription. | |
| **environments** | **int**| The maximum number of environments which can be provisioned on the project. | [optional] |
| **storage** | **int**| The total storage available to each environment, in MiB. | [optional] |
| **user_licenses** | **int**| The number of user licenses. | [optional] |
| **format** | **string**| The format of the estimation output. | [optional] |

### Return type

[**\OpenAPI\Client\Model\EstimationObject**](../Model/EstimationObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgSubscription()`

```php
getOrgSubscription($organization_id, $subscription_id): \OpenAPI\Client\Model\SchemasSubscription
```

Get subscription

Retrieves a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.

try {
    $result = $apiInstance->getOrgSubscription($organization_id, $subscription_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **subscription_id** | **string**| The ID of the subscription. | |

### Return type

[**\OpenAPI\Client\Model\SchemasSubscription**](../Model/SchemasSubscription.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgSubscriptionCurrentUsage()`

```php
getOrgSubscriptionCurrentUsage($organization_id, $subscription_id, $usage_groups, $include_not_charged): \OpenAPI\Client\Model\SubscriptionCurrentUsageObject
```

Get current usage for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.
$usage_groups = 'usage_groups_example'; // string | A list of usage groups to retrieve current usage for.
$include_not_charged = True; // bool | Whether to include not charged usage groups.

try {
    $result = $apiInstance->getOrgSubscriptionCurrentUsage($organization_id, $subscription_id, $usage_groups, $include_not_charged);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getOrgSubscriptionCurrentUsage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **subscription_id** | **string**| The ID of the subscription. | |
| **usage_groups** | **string**| A list of usage groups to retrieve current usage for. | [optional] |
| **include_not_charged** | **bool**| Whether to include not charged usage groups. | [optional] |

### Return type

[**\OpenAPI\Client\Model\SubscriptionCurrentUsageObject**](../Model/SubscriptionCurrentUsageObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgSubscriptions()`

```php
listOrgSubscriptions($organization_id, $filter_status, $page): \OpenAPI\Client\Model\ListOrgSubscriptions200Response
```

List subscriptions

Retrieves subscriptions for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead.
$filter_status = 'filter_status_example'; // string | The status of the subscription.
$page = 56; // int | Page to be displayed. Defaults to 1.

try {
    $result = $apiInstance->listOrgSubscriptions($organization_id, $filter_status, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->listOrgSubscriptions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization.&lt;br&gt; Prefix with name&#x3D; to retrieve the organization by name instead. | |
| **filter_status** | **string**| The status of the subscription. | [optional] |
| **page** | **int**| Page to be displayed. Defaults to 1. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListOrgSubscriptions200Response**](../Model/ListOrgSubscriptions200Response.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSubscriptionAddons()`

```php
listSubscriptionAddons($organization_id, $subscription_id): \OpenAPI\Client\Model\SubscriptionAddonsObject
```

List addons for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.

try {
    $result = $apiInstance->listSubscriptionAddons($organization_id, $subscription_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->listSubscriptionAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **subscription_id** | **string**| The ID of the subscription. | |

### Return type

[**\OpenAPI\Client\Model\SubscriptionAddonsObject**](../Model/SubscriptionAddonsObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgSubscription()`

```php
updateOrgSubscription($organization_id, $subscription_id, $update_org_subscription_request): \OpenAPI\Client\Model\SchemasSubscription
```

Update subscription

Updates a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$organization_id = 'organization_id_example'; // string | The ID of the organization.
$subscription_id = 'subscription_id_example'; // string | The ID of the subscription.
$update_org_subscription_request = new \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest(); // \OpenAPI\Client\Model\UpdateOrgSubscriptionRequest

try {
    $result = $apiInstance->updateOrgSubscription($organization_id, $subscription_id, $update_org_subscription_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->updateOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **organization_id** | **string**| The ID of the organization. | |
| **subscription_id** | **string**| The ID of the subscription. | |
| **update_org_subscription_request** | [**\OpenAPI\Client\Model\UpdateOrgSubscriptionRequest**](../Model/UpdateOrgSubscriptionRequest.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\SchemasSubscription**](../Model/SchemasSubscription.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
