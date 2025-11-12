# SubscriptionsApi

Low level SubscriptionsApi (auto-generated)

***

* Full name: `\Upsun\Api\SubscriptionsApi`
* Parent class: [`\Upsun\Api\AbstractApi`](./AbstractApi.md)
* This class is marked as **final** and can't be subclassed

**See Also:**

* https://docs.upsun.com

## Properties

### headerSelector

```php
private \Upsun\Api\ApiHeaderSelector $headerSelector
```

***

### config

```php
private \Upsun\Api\APIConfiguration $config
```

***

## Methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, ?\Psr\Http\Client\ClientInterface $httpClient = null, ?\Psr\Http\Message\RequestFactoryInterface $requestFactory = null, ?\Upsun\Api\APIConfiguration $config = null, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null, ?\Upsun\Api\ApiHeaderSelector $selector = null): mixed
```

**Parameters:**

| Parameter         | Type                                           | Description |
|-------------------|------------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                  |             |
| `$httpClient`     | **?\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **?\Psr\Http\Message\RequestFactoryInterface** |             |
| `$config`         | **?\Upsun\Api\APIConfiguration**               |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface**  |             |
| `$selector`       | **?\Upsun\Api\ApiHeaderSelector**              |             |

***

### canCreateNewOrgSubscription

Checks if the user is able to create a new project.

```php
public canCreateNewOrgSubscription(string $organizationId): \Upsun\Model\CanCreateNewOrgSubscription200Response
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/can-create-new-org-subscription

***

### canCreateNewOrgSubscriptionWithHttpInfo

Checks if the user is able to create a new project. with HTTP Info

```php
private canCreateNewOrgSubscriptionWithHttpInfo(string $organizationId): \Upsun\Model\CanCreateNewOrgSubscription200Response
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### canCreateNewOrgSubscriptionRequest

Create request for operation 'canCreateNewOrgSubscription'

```php
private canCreateNewOrgSubscriptionRequest(string $organizationId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### canUpdateSubscription

Checks if the user is able to update a project.

```php
public canUpdateSubscription(string $subscriptionId, string|null $plan = null, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null): \Upsun\Model\CanUpdateSubscription200Response
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                              |
|-------------------|------------------|--------------------------------------------------------------------------------------------------------------------------|
| `$subscriptionId` | **string**       | The ID of the subscription (required)                                                                                    |
| `$plan`           | **string\|null** | The plan type of the subscription. (optional)                                                                            |
| `$environments`   | **int\|null**    | The number of environments which can be provisioned on the project. (optional)                                           |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values. (optional) |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                                                  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/can-update-subscription

***

### canUpdateSubscriptionWithHttpInfo

Checks if the user is able to update a project. with HTTP Info

```php
private canUpdateSubscriptionWithHttpInfo(string $subscriptionId, string|null $plan = null, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null): \Upsun\Model\CanUpdateSubscription200Response
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                              |
|-------------------|------------------|--------------------------------------------------------------------------------------------------------------------------|
| `$subscriptionId` | **string**       | The ID of the subscription (required)                                                                                    |
| `$plan`           | **string\|null** | The plan type of the subscription. (optional)                                                                            |
| `$environments`   | **int\|null**    | The number of environments which can be provisioned on the project. (optional)                                           |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values. (optional) |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                                                  |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### canUpdateSubscriptionRequest

Create request for operation 'canUpdateSubscription'

```php
private canUpdateSubscriptionRequest(string $subscriptionId, string|null $plan = null, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                                                              |
|-------------------|------------------|--------------------------------------------------------------------------------------------------------------------------|
| `$subscriptionId` | **string**       | The ID of the subscription (required)                                                                                    |
| `$plan`           | **string\|null** | The plan type of the subscription. (optional)                                                                            |
| `$environments`   | **int\|null**    | The number of environments which can be provisioned on the project. (optional)                                           |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values. (optional) |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                                                  |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### createOrgSubscription

Create subscription

```php
public createOrgSubscription(string $organizationId, \Upsun\Model\CreateOrgSubscriptionRequest $createOrgSubscriptionRequest): \Upsun\Model\Subscription
```

Creates a subscription for the specified organization.

**Parameters:**

| Parameter                       | Type                                          | Description                            |
|---------------------------------|-----------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                    | The ID of the organization. (required) |
| `$createOrgSubscriptionRequest` | **\Upsun\Model\CreateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/create-org-subscription

***

### createOrgSubscriptionWithHttpInfo

Create subscription with HTTP Info

```php
private createOrgSubscriptionWithHttpInfo(string $organizationId, \Upsun\Model\CreateOrgSubscriptionRequest $createOrgSubscriptionRequest): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter                       | Type                                          | Description                            |
|---------------------------------|-----------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                    | The ID of the organization. (required) |
| `$createOrgSubscriptionRequest` | **\Upsun\Model\CreateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### createOrgSubscriptionRequest

Create request for operation 'createOrgSubscription'

```php
private createOrgSubscriptionRequest(string $organizationId, \Upsun\Model\CreateOrgSubscriptionRequest $createOrgSubscriptionRequest): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                       | Type                                          | Description                            |
|---------------------------------|-----------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                    | The ID of the organization. (required) |
| `$createOrgSubscriptionRequest` | **\Upsun\Model\CreateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### deleteOrgSubscription

Delete subscription

```php
public deleteOrgSubscription(string $organizationId, string $subscriptionId): void
```

Deletes a subscription for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/delete-org-subscription

***

### deleteOrgSubscriptionWithHttpInfo

Delete subscription with HTTP Info

```php
private deleteOrgSubscriptionWithHttpInfo(string $organizationId, string $subscriptionId): void
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### deleteOrgSubscriptionRequest

Create request for operation 'deleteOrgSubscription'

```php
private deleteOrgSubscriptionRequest(string $organizationId, string $subscriptionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### estimateNewOrgSubscription

Estimate the price of a new subscription

```php
public estimateNewOrgSubscription(string $organizationId, string $plan, int $environments, int $storage, int $userLicenses, string|null $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int**          | The maximum number of environments which can be provisioned on the project. (required) |
| `$storage`        | **int**          | The total storage available to each environment, in MiB. (required)                    |
| `$userLicenses`   | **int**          | The number of user licenses. (required)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/estimate-new-org-subscription

***

### estimateNewOrgSubscriptionWithHttpInfo

Estimate the price of a new subscription with HTTP Info

```php
private estimateNewOrgSubscriptionWithHttpInfo(string $organizationId, string $plan, int $environments, int $storage, int $userLicenses, string|null $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int**          | The maximum number of environments which can be provisioned on the project. (required) |
| `$storage`        | **int**          | The total storage available to each environment, in MiB. (required)                    |
| `$userLicenses`   | **int**          | The number of user licenses. (required)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### estimateNewOrgSubscriptionRequest

Create request for operation 'estimateNewOrgSubscription'

```php
private estimateNewOrgSubscriptionRequest(string $organizationId, string $plan, int $environments, int $storage, int $userLicenses, string|null $format = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int**          | The maximum number of environments which can be provisioned on the project. (required) |
| `$storage`        | **int**          | The total storage available to each environment, in MiB. (required)                    |
| `$userLicenses`   | **int**          | The number of user licenses. (required)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### estimateOrgSubscription

Estimate the price of a subscription

```php
public estimateOrgSubscription(string $organizationId, string $subscriptionId, string $plan, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null, string|null $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$subscriptionId` | **string**       | The ID of the subscription. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int\|null**    | The maximum number of environments which can be provisioned on the project. (optional) |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. (optional)                    |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/estimate-org-subscription

***

### estimateOrgSubscriptionWithHttpInfo

Estimate the price of a subscription with HTTP Info

```php
private estimateOrgSubscriptionWithHttpInfo(string $organizationId, string $subscriptionId, string $plan, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null, string|null $format = null): \Upsun\Model\EstimationObject
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$subscriptionId` | **string**       | The ID of the subscription. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int\|null**    | The maximum number of environments which can be provisioned on the project. (optional) |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. (optional)                    |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### estimateOrgSubscriptionRequest

Create request for operation 'estimateOrgSubscription'

```php
private estimateOrgSubscriptionRequest(string $organizationId, string $subscriptionId, string $plan, int|null $environments = null, int|null $storage = null, int|null $userLicenses = null, string|null $format = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type             | Description                                                                            |
|-------------------|------------------|----------------------------------------------------------------------------------------|
| `$organizationId` | **string**       | The ID of the organization. (required)                                                 |
| `$subscriptionId` | **string**       | The ID of the subscription. (required)                                                 |
| `$plan`           | **string**       | The plan type of the subscription. (required)                                          |
| `$environments`   | **int\|null**    | The maximum number of environments which can be provisioned on the project. (optional) |
| `$storage`        | **int\|null**    | The total storage available to each environment, in MiB. (optional)                    |
| `$userLicenses`   | **int\|null**    | The number of user licenses. (optional)                                                |
| `$format`         | **string\|null** | The format of the estimation output. (optional)                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgSubscription

Get subscription

```php
public getOrgSubscription(string $organizationId, string $subscriptionId): \Upsun\Model\Subscription
```

Retrieves a subscription for the specified organization.

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/get-org-subscription

***

### getOrgSubscriptionWithHttpInfo

Get subscription with HTTP Info

```php
private getOrgSubscriptionWithHttpInfo(string $organizationId, string $subscriptionId): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgSubscriptionRequest

Create request for operation 'getOrgSubscription'

```php
private getOrgSubscriptionRequest(string $organizationId, string $subscriptionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getOrgSubscriptionCurrentUsage

Get current usage for a subscription

```php
public getOrgSubscriptionCurrentUsage(string $organizationId, string $subscriptionId, string|null $usageGroups = null, bool|null $includeNotCharged = null): \Upsun\Model\SubscriptionCurrentUsageObject
```

**Parameters:**

| Parameter            | Type             | Description                                                      |
|----------------------|------------------|------------------------------------------------------------------|
| `$organizationId`    | **string**       | The ID of the organization. (required)                           |
| `$subscriptionId`    | **string**       | The ID of the subscription. (required)                           |
| `$usageGroups`       | **string\|null** | A list of usage groups to retrieve current usage for. (optional) |
| `$includeNotCharged` | **bool\|null**   | Whether to include not charged usage groups. (optional)          |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/get-org-subscription-current-usage

***

### getOrgSubscriptionCurrentUsageWithHttpInfo

Get current usage for a subscription with HTTP Info

```php
private getOrgSubscriptionCurrentUsageWithHttpInfo(string $organizationId, string $subscriptionId, string|null $usageGroups = null, bool|null $includeNotCharged = null): \Upsun\Model\SubscriptionCurrentUsageObject
```

**Parameters:**

| Parameter            | Type             | Description                                                      |
|----------------------|------------------|------------------------------------------------------------------|
| `$organizationId`    | **string**       | The ID of the organization. (required)                           |
| `$subscriptionId`    | **string**       | The ID of the subscription. (required)                           |
| `$usageGroups`       | **string\|null** | A list of usage groups to retrieve current usage for. (optional) |
| `$includeNotCharged` | **bool\|null**   | Whether to include not charged usage groups. (optional)          |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getOrgSubscriptionCurrentUsageRequest

Create request for operation 'getOrgSubscriptionCurrentUsage'

```php
private getOrgSubscriptionCurrentUsageRequest(string $organizationId, string $subscriptionId, string|null $usageGroups = null, bool|null $includeNotCharged = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter            | Type             | Description                                                      |
|----------------------|------------------|------------------------------------------------------------------|
| `$organizationId`    | **string**       | The ID of the organization. (required)                           |
| `$subscriptionId`    | **string**       | The ID of the subscription. (required)                           |
| `$usageGroups`       | **string\|null** | A list of usage groups to retrieve current usage for. (optional) |
| `$includeNotCharged` | **bool\|null**   | Whether to include not charged usage groups. (optional)          |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### getSubscriptionUsageAlerts

Get usage alerts

```php
public getSubscriptionUsageAlerts(string $organizationId, string $subscriptionId): \Upsun\Model\GetSubscriptionUsageAlerts200Response
```

Retrieves current and available usage alerts.

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required)                                                                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/get-subscription-usage-alerts

***

### getSubscriptionUsageAlertsWithHttpInfo

Get usage alerts with HTTP Info

```php
private getSubscriptionUsageAlertsWithHttpInfo(string $organizationId, string $subscriptionId): \Upsun\Model\GetSubscriptionUsageAlerts200Response
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required)                                                                     |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### getSubscriptionUsageAlertsRequest

Create request for operation 'getSubscriptionUsageAlerts'

```php
private getSubscriptionUsageAlertsRequest(string $organizationId, string $subscriptionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                                                                                                |
|-------------------|------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId` | **string** | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required)                                                                     |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listOrgSubscriptions

List subscriptions

```php
public listOrgSubscriptions(string $organizationId, string|null $filterStatus = null, string|null $filterId = null, \Upsun\Model\StringFilter|null $filterProjectId = null, \Upsun\Model\StringFilter|null $filterProjectTitle = null, \Upsun\Model\StringFilter|null $filterRegion = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgSubscriptions200Response
```

Retrieves subscriptions for the specified organization.

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                                                    |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`     | **string**                            | The ID of the organization. (required)                                                                                                                                                         |
| `$filterStatus`       | **string\|null**                      | The status of the subscription. (optional)                                                                                                                                                     |
| `$filterId`           | **string\|null**                      | Machine name of the region. (optional)                                                                                                                                                         |
| `$filterProjectId`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_id` using one or more operators. (optional)                                                                                                                       |
| `$filterProjectTitle` | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_title` using one or more operators. (optional)                                                                                                                    |
| `$filterRegion`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `region` using one or more operators. (optional)                                                                                                                           |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                                                       |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                                                             |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `region`, `project_title`, `type`, `plan`, `status`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/list-org-subscriptions

***

### listOrgSubscriptionsWithHttpInfo

List subscriptions with HTTP Info

```php
private listOrgSubscriptionsWithHttpInfo(string $organizationId, string|null $filterStatus = null, string|null $filterId = null, \Upsun\Model\StringFilter|null $filterProjectId = null, \Upsun\Model\StringFilter|null $filterProjectTitle = null, \Upsun\Model\StringFilter|null $filterRegion = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Upsun\Model\ListOrgSubscriptions200Response
```

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                                                    |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`     | **string**                            | The ID of the organization. (required)                                                                                                                                                         |
| `$filterStatus`       | **string\|null**                      | The status of the subscription. (optional)                                                                                                                                                     |
| `$filterId`           | **string\|null**                      | Machine name of the region. (optional)                                                                                                                                                         |
| `$filterProjectId`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_id` using one or more operators. (optional)                                                                                                                       |
| `$filterProjectTitle` | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_title` using one or more operators. (optional)                                                                                                                    |
| `$filterRegion`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `region` using one or more operators. (optional)                                                                                                                           |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                                                       |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                                                             |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `region`, `project_title`, `type`, `plan`, `status`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listOrgSubscriptionsRequest

Create request for operation 'listOrgSubscriptions'

```php
private listOrgSubscriptionsRequest(string $organizationId, string|null $filterStatus = null, string|null $filterId = null, \Upsun\Model\StringFilter|null $filterProjectId = null, \Upsun\Model\StringFilter|null $filterProjectTitle = null, \Upsun\Model\StringFilter|null $filterRegion = null, \Upsun\Model\DateTimeFilter|null $filterUpdatedAt = null, int|null $pageSize = null, string|null $pageBefore = null, string|null $pageAfter = null, string|null $sort = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter             | Type                                  | Description                                                                                                                                                                                    |
|-----------------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$organizationId`     | **string**                            | The ID of the organization. (required)                                                                                                                                                         |
| `$filterStatus`       | **string\|null**                      | The status of the subscription. (optional)                                                                                                                                                     |
| `$filterId`           | **string\|null**                      | Machine name of the region. (optional)                                                                                                                                                         |
| `$filterProjectId`    | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_id` using one or more operators. (optional)                                                                                                                       |
| `$filterProjectTitle` | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `project_title` using one or more operators. (optional)                                                                                                                    |
| `$filterRegion`       | **\Upsun\Model\StringFilter\|null**   | Allows filtering by `region` using one or more operators. (optional)                                                                                                                           |
| `$filterUpdatedAt`    | **\Upsun\Model\DateTimeFilter\|null** | Allows filtering by `updated_at` using one or more operators. (optional)                                                                                                                       |
| `$pageSize`           | **int\|null**                         | Determines the number of items to show. (optional)                                                                                                                                             |
| `$pageBefore`         | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$pageAfter`          | **string\|null**                      | Pagination cursor. This is automatically generated as necessary and provided in HAL links (_links); it should not be constructed externally. (optional)                                        |
| `$sort`               | **string\|null**                      | Allows sorting by a single field.<br> Use a dash (\"-\") to sort descending.<br> Supported fields: `region`, `project_title`, `type`, `plan`, `status`, `created_at`, `updated_at`. (optional) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### listSubscriptionAddons

List addons for a subscription

```php
public listSubscriptionAddons(string $organizationId, string $subscriptionId): \Upsun\Model\SubscriptionAddonsObject
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/list-subscription-addons

***

### listSubscriptionAddonsWithHttpInfo

List addons for a subscription with HTTP Info

```php
private listSubscriptionAddonsWithHttpInfo(string $organizationId, string $subscriptionId): \Upsun\Model\SubscriptionAddonsObject
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listSubscriptionAddonsRequest

Create request for operation 'listSubscriptionAddons'

```php
private listSubscriptionAddonsRequest(string $organizationId, string $subscriptionId): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter         | Type       | Description                            |
|-------------------|------------|----------------------------------------|
| `$organizationId` | **string** | The ID of the organization. (required) |
| `$subscriptionId` | **string** | The ID of the subscription. (required) |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateOrgSubscription

Update subscription

```php
public updateOrgSubscription(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateOrgSubscriptionRequest $updateOrgSubscriptionRequest = null): \Upsun\Model\Subscription
```

Updates a subscription for the specified organization.

**Parameters:**

| Parameter                       | Type                                           | Description                            |
|---------------------------------|------------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                     | The ID of the organization. (required) |
| `$subscriptionId`               | **string**                                     | The ID of the subscription. (required) |
| `$updateOrgSubscriptionRequest` | **?\Upsun\Model\UpdateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/update-org-subscription

***

### updateOrgSubscriptionWithHttpInfo

Update subscription with HTTP Info

```php
private updateOrgSubscriptionWithHttpInfo(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateOrgSubscriptionRequest $updateOrgSubscriptionRequest = null): \Upsun\Model\Subscription
```

**Parameters:**

| Parameter                       | Type                                           | Description                            |
|---------------------------------|------------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                     | The ID of the organization. (required) |
| `$subscriptionId`               | **string**                                     | The ID of the subscription. (required) |
| `$updateOrgSubscriptionRequest` | **?\Upsun\Model\UpdateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateOrgSubscriptionRequest

Create request for operation 'updateOrgSubscription'

```php
private updateOrgSubscriptionRequest(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateOrgSubscriptionRequest $updateOrgSubscriptionRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                       | Type                                           | Description                            |
|---------------------------------|------------------------------------------------|----------------------------------------|
| `$organizationId`               | **string**                                     | The ID of the organization. (required) |
| `$subscriptionId`               | **string**                                     | The ID of the subscription. (required) |
| `$updateOrgSubscriptionRequest` | **?\Upsun\Model\UpdateOrgSubscriptionRequest** |                                        |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

### updateSubscriptionUsageAlerts

Update usage alerts.

```php
public updateSubscriptionUsageAlerts(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest $updateSubscriptionUsageAlertsRequest = null): \Upsun\Model\GetSubscriptionUsageAlerts200Response
```

Updates usage alerts for a subscription.

**Parameters:**

| Parameter                               | Type                                                   | Description                                                                                                |
|-----------------------------------------|--------------------------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId`                       | **string**                                             | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId`                       | **string**                                             | The ID of the subscription. (required)                                                                     |
| `$updateSubscriptionUsageAlertsRequest` | **?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest** |                                                                                                            |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


**See Also:**

* https://docs.upsun.com/api/#tag/Subscriptions/operation/update-subscription-usage-alerts

***

### updateSubscriptionUsageAlertsWithHttpInfo

Update usage alerts. with HTTP Info

```php
private updateSubscriptionUsageAlertsWithHttpInfo(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest $updateSubscriptionUsageAlertsRequest = null): \Upsun\Model\GetSubscriptionUsageAlerts200Response
```

**Parameters:**

| Parameter                               | Type                                                   | Description                                                                                                |
|-----------------------------------------|--------------------------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId`                       | **string**                                             | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId`                       | **string**                                             | The ID of the subscription. (required)                                                                     |
| `$updateSubscriptionUsageAlertsRequest` | **?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest** |                                                                                                            |

**Throws:**

- [`ApiException`](./ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### updateSubscriptionUsageAlertsRequest

Create request for operation 'updateSubscriptionUsageAlerts'

```php
private updateSubscriptionUsageAlertsRequest(string $organizationId, string $subscriptionId, ?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest $updateSubscriptionUsageAlertsRequest = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter                               | Type                                                   | Description                                                                                                |
|-----------------------------------------|--------------------------------------------------------|------------------------------------------------------------------------------------------------------------|
| `$organizationId`                       | **string**                                             | The ID of the organization.<br> Prefix with name= to retrieve the organization by name instead. (required) |
| `$subscriptionId`                       | **string**                                             | The ID of the subscription. (required)                                                                     |
| `$updateSubscriptionUsageAlertsRequest` | **?\Upsun\Model\UpdateSubscriptionUsageAlertsRequest** |                                                                                                            |

**Throws:**

- [`InvalidArgumentException`](https://www.php.net/manual/en/class.invalidargumentexception.php) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\Core\OAuthProvider $oauthProvider, \Psr\Http\Client\ClientInterface $httpClient, \Psr\Http\Message\RequestFactoryInterface $requestFactory, string $baseUri, ?\Psr\Http\Message\StreamFactoryInterface $streamFactory = null): mixed
```

**Parameters:**

| Parameter         | Type                                          | Description |
|-------------------|-----------------------------------------------|-------------|
| `$oauthProvider`  | **\Upsun\Core\OAuthProvider**                 |             |
| `$httpClient`     | **\Psr\Http\Client\ClientInterface**          |             |
| `$requestFactory` | **\Psr\Http\Message\RequestFactoryInterface** |             |
| `$baseUri`        | **string**                                    |             |
| `$streamFactory`  | **?\Psr\Http\Message\StreamFactoryInterface** |             |

***

### getAuthorizationHeader

```php
protected getAuthorizationHeader(): string
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createAuthenticatedRequest

```php
protected createAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### sendAuthenticatedRequest

```php
protected sendAuthenticatedRequest(string $method, string $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\ResponseInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string**                                          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### refreshToken

```php
public refreshToken(): void
```

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### createRequest

Create request

```php
protected createRequest(string $method, string|\Psr\Http\Message\UriInterface $uri, array $headers = [], string|\Psr\Http\Message\StreamInterface|null $body = null): \Psr\Http\Message\RequestInterface
```

**Parameters:**

| Parameter  | Type                                                | Description |
|------------|-----------------------------------------------------|-------------|
| `$method`  | **string**                                          |             |
| `$uri`     | **string\|\Psr\Http\Message\UriInterface**          |             |
| `$headers` | **array**                                           |             |
| `$body`    | **string\|\Psr\Http\Message\StreamInterface\|null** |             |

***

### createUri

```php
protected createUri(string $operationHost, string $resourcePath, array $queryParams): \Psr\Http\Message\UriInterface
```

**Parameters:**

| Parameter        | Type       | Description |
|------------------|------------|-------------|
| `$operationHost` | **string** |             |
| `$resourcePath`  | **string** |             |
| `$queryParams`   | **array**  |             |

***

### handleResponseWithDataType

```php
protected handleResponseWithDataType(class-string<\Upsun\Api\T>|string $dataType, \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Upsun\Api\T
```

**Parameters:**

| Parameter   | Type                                    | Description                                                       |
|-------------|-----------------------------------------|-------------------------------------------------------------------|
| `$dataType` | **class-string<\Upsun\Api\T>\|string**  | Fully-qualified class name, or scalar type like "string", "array" |
| `$request`  | **\Psr\Http\Message\RequestInterface**  |                                                                   |
| `$response` | **\Psr\Http\Message\ResponseInterface** |                                                                   |

**Throws:**

- [`ApiException`](./ApiException.md) 
- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***

### deserializeGenericArray

Deserialize generic types array<key,value>

```php
protected deserializeGenericArray(mixed $content, string $dataType, \Psr\Http\Message\RequestInterface $request): array
```

**Parameters:**

| Parameter   | Type                                   | Description |
|-------------|----------------------------------------|-------------|
| `$content`  | **mixed**                              |             |
| `$dataType` | **string**                             |             |
| `$request`  | **\Psr\Http\Message\RequestInterface** |             |

**Throws:**

- [`Exception`](https://www.php.net/manual/en/class.exception.php) 


***
