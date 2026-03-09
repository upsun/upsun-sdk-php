# CreateTicketRequest

Low level CreateTicketRequest (auto-generated)

***

* Full name: `\Upsun\Model\CreateTicketRequest`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                        | Visibility | Type | Value                  |
|---------------------------------|------------|------|------------------------|
| `PRIORITY_LOW`                  | public     |      | 'low'                  |
| `PRIORITY_NORMAL`               | public     |      | 'normal'               |
| `PRIORITY_HIGH`                 | public     |      | 'high'                 |
| `PRIORITY_URGENT`               | public     |      | 'urgent'               |
| `CATEGORY_ACCESS`               | public     |      | 'access'               |
| `CATEGORY_BILLING_QUESTION`     | public     |      | 'billing_question'     |
| `CATEGORY_COMPLAINT`            | public     |      | 'complaint'            |
| `CATEGORY_COMPLIANCE_QUESTION`  | public     |      | 'compliance_question'  |
| `CATEGORY_CONFIGURATION_CHANGE` | public     |      | 'configuration_change' |
| `CATEGORY_GENERAL_QUESTION`     | public     |      | 'general_question'     |
| `CATEGORY_INCIDENT_OUTAGE`      | public     |      | 'incident_outage'      |
| `CATEGORY_BUG_REPORT`           | public     |      | 'bug_report'           |
| `CATEGORY_REPORT_A_GUI_BUG`     | public     |      | 'report_a_gui_bug'     |
| `CATEGORY_ONBOARDING`           | public     |      | 'onboarding'           |
| `CATEGORY_CLOSE_MY_ACCOUNT`     | public     |      | 'close_my_account'     |

## Properties

### subject

```php
private string $subject
```

***

### description

```php
private string $description
```

***

### requesterId

```php
private ?string $requesterId
```

***

### priority

```php
private ?string $priority
```

***

### subscriptionId

```php
private ?string $subscriptionId
```

***

### organizationId

```php
private ?string $organizationId
```

***

### affectedUrl

```php
private ?string $affectedUrl
```

***

### followupTid

```php
private ?string $followupTid
```

***

### category

```php
private ?string $category
```

***

### attachments

```php
private ?array $attachments
```

***

### collaboratorIds

```php
private ?array $collaboratorIds
```

***

## Methods

### __construct

```php
public __construct(string $subject, string $description, ?string $requesterId = null, ?string $priority = null, ?string $subscriptionId = null, ?string $organizationId = null, ?string $affectedUrl = null, ?string $followupTid = null, ?string $category = null, ?array $attachments = [], ?array $collaboratorIds = []): mixed
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

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getSubject

```php
public getSubject(): string
```

***

### getDescription

```php
public getDescription(): string
```

***

### getRequesterId

```php
public getRequesterId(): ?string
```

***

### getPriority

```php
public getPriority(): ?string
```

***

### getSubscriptionId

```php
public getSubscriptionId(): ?string
```

***

### getOrganizationId

```php
public getOrganizationId(): ?string
```

***

### getAffectedUrl

```php
public getAffectedUrl(): ?string
```

***

### getFollowupTid

```php
public getFollowupTid(): ?string
```

***

### getCategory

```php
public getCategory(): ?string
```

***

### getAttachments

```php
public getAttachments(): \Upsun\Model\CreateTicketRequestAttachmentsInner[]|null
```

***

### getCollaboratorIds

```php
public getCollaboratorIds(): ?array
```

***
