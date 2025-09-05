# Upsun\SubscriptionsApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**canCreateNewOrgSubscription()**](SubscriptionsApi.md#canCreateNewOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/can-create | Checks if the user is able to create a new project.
[**createOrgSubscription()**](SubscriptionsApi.md#createOrgSubscription) | **POST** /organizations/{organization_id}/subscriptions | Create subscription
[**deleteOrgSubscription()**](SubscriptionsApi.md#deleteOrgSubscription) | **DELETE** /organizations/{organization_id}/subscriptions/{subscription_id} | Delete subscription
[**estimateNewOrgSubscription()**](SubscriptionsApi.md#estimateNewOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/estimate | Estimate the price of a new subscription
[**estimateOrgSubscription()**](SubscriptionsApi.md#estimateOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/estimate | Estimate the price of a subscription
[**getOrgSubscription()**](SubscriptionsApi.md#getOrgSubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id} | Get subscription
[**getOrgSubscriptionCurrentUsage()**](SubscriptionsApi.md#getOrgSubscriptionCurrentUsage) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/current_usage | Get current usage for a subscription
[**listOrgSubscriptions()**](SubscriptionsApi.md#listOrgSubscriptions) | **GET** /organizations/{organization_id}/subscriptions | List subscriptions
[**listSubscriptionAddons()**](SubscriptionsApi.md#listSubscriptionAddons) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/addons | List addons for a subscription
[**updateOrgSubscription()**](SubscriptionsApi.md#updateOrgSubscription) | **PATCH** /organizations/{organization_id}/subscriptions/{subscription_id} | Update subscription


## `canCreateNewOrgSubscription()`

```php
canCreateNewOrgSubscription($organizationId): \Upsun\Model\CanCreateNewOrgSubscription200Response
```

Checks if the user is able to create a new project.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.

try {
    $result = $apiInstance->canCreateNewOrgSubscription($organizationId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->canCreateNewOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |

### Return type

[**\Upsun\Model\CanCreateNewOrgSubscription200Response**](../Model/CanCreateNewOrgSubscription200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createOrgSubscription()`

```php
createOrgSubscription($organizationId, $createOrgSubscriptionRequest): \Upsun\Model\Subscription
```

Create subscription

Creates a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$createOrgSubscriptionRequest = new \Upsun\Model\CreateOrgSubscriptionRequest(); // \Upsun\Model\CreateOrgSubscriptionRequest

try {
    $result = $apiInstance->createOrgSubscription($organizationId, $createOrgSubscriptionRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->createOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **createOrgSubscriptionRequest** | [**\Upsun\Model\CreateOrgSubscriptionRequest**](../Model/CreateOrgSubscriptionRequest.md)|  |

### Return type

[**\Upsun\Model\Subscription**](../Model/Subscription.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteOrgSubscription()`

```php
deleteOrgSubscription($organizationId, $subscriptionId)
```

Delete subscription

Deletes a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.

try {
    $apiInstance->deleteOrgSubscription($organizationId, $subscriptionId);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->deleteOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |

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

## `estimateNewOrgSubscription()`

```php
estimateNewOrgSubscription($organizationId, $plan, $environments, $storage, $userLicenses, $format): \Upsun\Model\EstimationObject
```

Estimate the price of a new subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$plan = 'plan_example'; // string | The plan type of the subscription.
$environments = 56; // int | The maximum number of environments which can be provisioned on the project.
$storage = 56; // int | The total storage available to each environment, in MiB.
$userLicenses = 56; // int | The number of user licenses.
$format = 'format_example'; // string | The format of the estimation output.

try {
    $result = $apiInstance->estimateNewOrgSubscription($organizationId, $plan, $environments, $storage, $userLicenses, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->estimateNewOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **plan** | **string**| The plan type of the subscription. |
 **environments** | **int**| The maximum number of environments which can be provisioned on the project. |
 **storage** | **int**| The total storage available to each environment, in MiB. |
 **userLicenses** | **int**| The number of user licenses. |
 **format** | **string**| The format of the estimation output. | [optional]

### Return type

[**\Upsun\Model\EstimationObject**](../Model/EstimationObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `estimateOrgSubscription()`

```php
estimateOrgSubscription($organizationId, $subscriptionId, $plan, $environments, $storage, $userLicenses, $format): \Upsun\Model\EstimationObject
```

Estimate the price of a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.
$plan = 'plan_example'; // string | The plan type of the subscription.
$environments = 56; // int | The maximum number of environments which can be provisioned on the project.
$storage = 56; // int | The total storage available to each environment, in MiB.
$userLicenses = 56; // int | The number of user licenses.
$format = 'format_example'; // string | The format of the estimation output.

try {
    $result = $apiInstance->estimateOrgSubscription($organizationId, $subscriptionId, $plan, $environments, $storage, $userLicenses, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->estimateOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |
 **plan** | **string**| The plan type of the subscription. |
 **environments** | **int**| The maximum number of environments which can be provisioned on the project. | [optional]
 **storage** | **int**| The total storage available to each environment, in MiB. | [optional]
 **userLicenses** | **int**| The number of user licenses. | [optional]
 **format** | **string**| The format of the estimation output. | [optional]

### Return type

[**\Upsun\Model\EstimationObject**](../Model/EstimationObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgSubscription()`

```php
getOrgSubscription($organizationId, $subscriptionId): \Upsun\Model\Subscription
```

Get subscription

Retrieves a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.

try {
    $result = $apiInstance->getOrgSubscription($organizationId, $subscriptionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |

### Return type

[**\Upsun\Model\Subscription**](../Model/Subscription.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrgSubscriptionCurrentUsage()`

```php
getOrgSubscriptionCurrentUsage($organizationId, $subscriptionId, $usageGroups, $includeNotCharged): \Upsun\Model\SubscriptionCurrentUsageObject
```

Get current usage for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.
$usageGroups = 'usageGroups_example'; // string | A list of usage groups to retrieve current usage for.
$includeNotCharged = True; // bool | Whether to include not charged usage groups.

try {
    $result = $apiInstance->getOrgSubscriptionCurrentUsage($organizationId, $subscriptionId, $usageGroups, $includeNotCharged);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->getOrgSubscriptionCurrentUsage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |
 **usageGroups** | **string**| A list of usage groups to retrieve current usage for. | [optional]
 **includeNotCharged** | **bool**| Whether to include not charged usage groups. | [optional]

### Return type

[**\Upsun\Model\SubscriptionCurrentUsageObject**](../Model/SubscriptionCurrentUsageObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listOrgSubscriptions()`

```php
listOrgSubscriptions($organizationId, $filterStatus, $filterId, $filterProjectId, $filterProjectTitle, $filterRegion, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort): \Upsun\Model\ListOrgSubscriptions200Response
```

List subscriptions

Retrieves subscriptions for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$filterStatus = 'filterStatus_example'; // string | The status of the subscription.
$filterId = 'filterId_example'; // string | Machine name of the region.
$filterProjectId = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `project_id` using one or more operators.
$filterProjectTitle = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `project_title` using one or more operators.
$filterRegion = new \Upsun\Model\\Upsun\Model\StringFilter(); // \Upsun\Model\StringFilter | Allows filtering by `region` using one or more operators.
$filterUpdatedAt = new \Upsun\Model\\Upsun\Model\DateTimeFilter(); // \Upsun\Model\DateTimeFilter | Allows filtering by `updated_at` using one or more operators.
$pageSize = 56; // int | Determines the number of items to show.
$pageBefore = 'pageBefore_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$pageAfter = 'pageAfter_example'; // string | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally.
$sort = -updated_at; // string | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `region`, `project_title`, `type`, `plan`, `status`, `created_at`, `updated_at`.

try {
    $result = $apiInstance->listOrgSubscriptions($organizationId, $filterStatus, $filterId, $filterProjectId, $filterProjectTitle, $filterRegion, $filterUpdatedAt, $pageSize, $pageBefore, $pageAfter, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->listOrgSubscriptions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **filterStatus** | **string**| The status of the subscription. | [optional]
 **filterId** | **string**| Machine name of the region. | [optional]
 **filterProjectId** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;project_id&#x60; using one or more operators. | [optional]
 **filterProjectTitle** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;project_title&#x60; using one or more operators. | [optional]
 **filterRegion** | [**\Upsun\Model\StringFilter**](../Model/.md)| Allows filtering by &#x60;region&#x60; using one or more operators. | [optional]
 **filterUpdatedAt** | [**\Upsun\Model\DateTimeFilter**](../Model/.md)| Allows filtering by &#x60;updated_at&#x60; using one or more operators. | [optional]
 **pageSize** | **int**| Determines the number of items to show. | [optional]
 **pageBefore** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **pageAfter** | **string**| Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. | [optional]
 **sort** | **string**| Allows sorting by a single field.&lt;br&gt; Use a dash (\&quot;-\&quot;) to sort descending.&lt;br&gt; Supported fields: &#x60;region&#x60;, &#x60;project_title&#x60;, &#x60;type&#x60;, &#x60;plan&#x60;, &#x60;status&#x60;, &#x60;created_at&#x60;, &#x60;updated_at&#x60;. | [optional]

### Return type

[**\Upsun\Model\ListOrgSubscriptions200Response**](../Model/ListOrgSubscriptions200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSubscriptionAddons()`

```php
listSubscriptionAddons($organizationId, $subscriptionId): \Upsun\Model\SubscriptionAddonsObject
```

List addons for a subscription

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.

try {
    $result = $apiInstance->listSubscriptionAddons($organizationId, $subscriptionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->listSubscriptionAddons: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |

### Return type

[**\Upsun\Model\SubscriptionAddonsObject**](../Model/SubscriptionAddonsObject.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateOrgSubscription()`

```php
updateOrgSubscription($organizationId, $subscriptionId, $updateOrgSubscriptionRequest): \Upsun\Model\Subscription
```

Update subscription

Updates a subscription for the specified organization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Upsun\Api\SubscriptionsApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client()
);
$organizationId = 'organizationId_example'; // string | The ID of the organization.
$subscriptionId = 'subscriptionId_example'; // string | The ID of the subscription.
$updateOrgSubscriptionRequest = new \Upsun\Model\UpdateOrgSubscriptionRequest(); // \Upsun\Model\UpdateOrgSubscriptionRequest

try {
    $result = $apiInstance->updateOrgSubscription($organizationId, $subscriptionId, $updateOrgSubscriptionRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SubscriptionsApi->updateOrgSubscription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organizationId** | **string**| The ID of the organization. |
 **subscriptionId** | **string**| The ID of the subscription. |
 **updateOrgSubscriptionRequest** | [**\Upsun\Model\UpdateOrgSubscriptionRequest**](../Model/UpdateOrgSubscriptionRequest.md)|  | [optional]

### Return type

[**\Upsun\Model\Subscription**](../Model/Subscription.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
