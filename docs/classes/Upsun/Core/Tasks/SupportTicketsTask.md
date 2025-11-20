# SupportTicketsTask

SupportTicketTask class.

***

* Full name: `\Upsun\Core\Tasks\SupportTicketsTask`
* Parent class: [`\Upsun\Core\Tasks\TaskBase`](./TaskBase.md)

**See Also:**

* https://docs.upsun.com

## Properties

### defaultApi

```php
private \Upsun\Api\DefaultApi $defaultApi
```

***

### supportApi

```php
private \Upsun\Api\SupportApi $supportApi
```

***

## Methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client, \Upsun\Api\DefaultApi $defaultApi, \Upsun\Api\SupportApi $supportApi): mixed
```

**Parameters:**

| Parameter     | Type                      | Description |
|---------------|---------------------------|-------------|
| `$client`     | **\Upsun\UpsunClient**    |             |
| `$defaultApi` | **\Upsun\Api\DefaultApi** |             |
| `$supportApi` | **\Upsun\Api\SupportApi** |             |

***

### list

Lists support tickets

```php
public list(?int $filterTicketId = null, ?\DateTime $filterCreated = null, ?\DateTime $filterUpdated = null, ?string $filterType = null, ?string $filterPriority = null, ?string $filterStatus = null, ?string $filterRequesterId = null, ?string $filterSubmitterId = null, ?string $filterAssigneeId = null, ?bool $filterHasIncidents = null, ?\DateTime $filterDue = null, ?string $search = null, ?int $page = null): \Upsun\Model\ListTickets200Response
```

**Parameters:**

| Parameter             | Type           | Description |
|-----------------------|----------------|-------------|
| `$filterTicketId`     | **?int**       |             |
| `$filterCreated`      | **?\DateTime** |             |
| `$filterUpdated`      | **?\DateTime** |             |
| `$filterType`         | **?string**    |             |
| `$filterPriority`     | **?string**    |             |
| `$filterStatus`       | **?string**    |             |
| `$filterRequesterId`  | **?string**    |             |
| `$filterSubmitterId`  | **?string**    |             |
| `$filterAssigneeId`   | **?string**    |             |
| `$filterHasIncidents` | **?bool**      |             |
| `$filterDue`          | **?\DateTime** |             |
| `$search`             | **?string**    |             |
| `$page`               | **?int**       |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### create

Creates a new support ticket

```php
public create(string $subject, string $description, ?string $requesterId = null, ?string $priority = null, ?string $subscriptionId = null, ?string $organizationId = null, ?string $affectedUrl = null, ?string $followupTid = null, ?string $category = null, ?array $attachments = [], ?array $collaboratorIds = []): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter          | Type        | Description |
|--------------------|-------------|-------------|
| `$subject`         | **string**  |             |
| `$description`     | **string**  |             |
| `$requesterId`     | **?string** |             |
| `$priority`        | **?string** |             |
| `$subscriptionId`  | **?string** |             |
| `$organizationId`  | **?string** |             |
| `$affectedUrl`     | **?string** |             |
| `$followupTid`     | **?string** |             |
| `$category`        | **?string** |             |
| `$attachments`     | **?array**  |             |
| `$collaboratorIds` | **?array**  |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listCategories

Lists support ticket categories

```php
public listCategories(?string $organizationId = null, ?string $projectId = null): \Upsun\Model\ListTicketCategories200ResponseInner[]
```

**Parameters:**

| Parameter         | Type        | Description |
|-------------------|-------------|-------------|
| `$organizationId` | **?string** |             |
| `$projectId`      | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### listPriorities

Lists support ticket priorities

```php
public listPriorities(?string $projectId = null, ?string $category = null): \Upsun\Model\ListTicketPriorities200ResponseInner[]
```

**Parameters:**

| Parameter    | Type        | Description |
|--------------|-------------|-------------|
| `$projectId` | **?string** |             |
| `$category`  | **?string** |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

### update

Updates a ticket

```php
public update(string $ticketId, ?string $status = null, ?array $collaboratorIds = [], ?bool $collaboratorsReplace = null): \Upsun\Model\Ticket
```

**Parameters:**

| Parameter               | Type        | Description |
|-------------------------|-------------|-------------|
| `$ticketId`             | **string**  |             |
| `$status`               | **?string** |             |
| `$collaboratorIds`      | **?array**  |             |
| `$collaboratorsReplace` | **?bool**   |             |

**Throws:**

- [`ApiException`](../../Api/ApiException.md) on non-2xx response or if the response body is not in the expected format
- [`ClientExceptionInterface`](https://www.php-fig.org/psr/psr-18/#clientexceptioninterface) 


***

## Inherited methods

### __construct

```php
public __construct(\Upsun\UpsunClient $client): mixed
```

**Parameters:**

| Parameter | Type                   | Description |
|-----------|------------------------|-------------|
| `$client` | **\Upsun\UpsunClient** |             |

***

### normalizeFilter

```php
protected normalizeFilter(array|string|int|\DateTime|null $value): array
```

**Parameters:**

| Parameter | Type                                    | Description |
|-----------|-----------------------------------------|-------------|
| `$value`  | **array\|string\|int\|\DateTime\|null** |             |

***

### extractSubscriptionId

Get SubscriptionId of a Project Licence Uri

```php
protected extractSubscriptionId(string $projectLicenceUri): string
```

**Parameters:**

| Parameter            | Type       | Description |
|----------------------|------------|-------------|
| `$projectLicenceUri` | **string** |             |

***
