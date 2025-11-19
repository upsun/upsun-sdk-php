# Ticket

Low level Ticket (auto-generated)
The support ticket object.

***

* Full name: `\Upsun\Model\Ticket`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### ticketId

```php
private ?int $ticketId
```

***

### created

```php
private ?\DateTime $created
```

***

### updated

```php
private ?\DateTime $updated
```

***

### type

```php
private ?string $type
```

***

### subject

```php
private ?string $subject
```

***

### description

```php
private ?string $description
```

***

### priority

```php
private ?string $priority
```

***

### followupTid

```php
private ?string $followupTid
```

***

### status

```php
private ?string $status
```

***

### recipient

```php
private ?string $recipient
```

***

### requesterId

```php
private ?string $requesterId
```

***

### submitterId

```php
private ?string $submitterId
```

***

### assigneeId

```php
private ?string $assigneeId
```

***

### organizationId

```php
private ?string $organizationId
```

***

### collaboratorIds

```php
private ?array $collaboratorIds
```

***

### hasIncidents

```php
private ?bool $hasIncidents
```

***

### due

```php
private ?\DateTime $due
```

***

### tags

```php
private ?array $tags
```

***

### subscriptionId

```php
private ?string $subscriptionId
```

***

### ticketGroup

```php
private ?string $ticketGroup
```

***

### supportPlan

```php
private ?string $supportPlan
```

***

### affectedUrl

```php
private ?string $affectedUrl
```

***

### queue

```php
private ?string $queue
```

***

### issueType

```php
private ?string $issueType
```

***

### resolutionTime

```php
private ?\DateTime $resolutionTime
```

***

### responseTime

```php
private ?\DateTime $responseTime
```

***

### projectUrl

```php
private ?string $projectUrl
```

***

### region

```php
private ?string $region
```

***

### category

```php
private ?string $category
```

***

### environment

```php
private ?string $environment
```

***

### ticketSharingStatus

```php
private ?string $ticketSharingStatus
```

***

### applicationTicketUrl

```php
private ?string $applicationTicketUrl
```

***

### infrastructureTicketUrl

```php
private ?string $infrastructureTicketUrl
```

***

### jira

```php
private ?array $jira
```

***

### zdTicketUrl

```php
private ?string $zdTicketUrl
```

***

## Methods

### __construct

```php
public __construct(?int $ticketId = null, ?\DateTime $created = null, ?\DateTime $updated = null, ?string $type = null, ?string $subject = null, ?string $description = null, ?string $priority = null, ?string $followupTid = null, ?string $status = null, ?string $recipient = null, ?string $requesterId = null, ?string $submitterId = null, ?string $assigneeId = null, ?string $organizationId = null, ?array $collaboratorIds = [], ?bool $hasIncidents = null, ?\DateTime $due = null, ?array $tags = [], ?string $subscriptionId = null, ?string $ticketGroup = null, ?string $supportPlan = null, ?string $affectedUrl = null, ?string $queue = null, ?string $issueType = null, ?\DateTime $resolutionTime = null, ?\DateTime $responseTime = null, ?string $projectUrl = null, ?string $region = null, ?string $category = null, ?string $environment = null, ?string $ticketSharingStatus = null, ?string $applicationTicketUrl = null, ?string $infrastructureTicketUrl = null, ?array $jira = [], ?string $zdTicketUrl = null): mixed
```

**Parameters:**

| Parameter                  | Type           | Description |
|----------------------------|----------------|-------------|
| `$ticketId`                | **?int**       |             |
| `$created`                 | **?\DateTime** |             |
| `$updated`                 | **?\DateTime** |             |
| `$type`                    | **?string**    |             |
| `$subject`                 | **?string**    |             |
| `$description`             | **?string**    |             |
| `$priority`                | **?string**    |             |
| `$followupTid`             | **?string**    |             |
| `$status`                  | **?string**    |             |
| `$recipient`               | **?string**    |             |
| `$requesterId`             | **?string**    |             |
| `$submitterId`             | **?string**    |             |
| `$assigneeId`              | **?string**    |             |
| `$organizationId`          | **?string**    |             |
| `$collaboratorIds`         | **?array**     |             |
| `$hasIncidents`            | **?bool**      |             |
| `$due`                     | **?\DateTime** |             |
| `$tags`                    | **?array**     |             |
| `$subscriptionId`          | **?string**    |             |
| `$ticketGroup`             | **?string**    |             |
| `$supportPlan`             | **?string**    |             |
| `$affectedUrl`             | **?string**    |             |
| `$queue`                   | **?string**    |             |
| `$issueType`               | **?string**    |             |
| `$resolutionTime`          | **?\DateTime** |             |
| `$responseTime`            | **?\DateTime** |             |
| `$projectUrl`              | **?string**    |             |
| `$region`                  | **?string**    |             |
| `$category`                | **?string**    |             |
| `$environment`             | **?string**    |             |
| `$ticketSharingStatus`     | **?string**    |             |
| `$applicationTicketUrl`    | **?string**    |             |
| `$infrastructureTicketUrl` | **?string**    |             |
| `$jira`                    | **?array**     |             |
| `$zdTicketUrl`             | **?string**    |             |

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

### getTicketId

The ID of the ticket.

```php
public getTicketId(): ?int
```

***

### getCreated

The time when the support ticket was created.

```php
public getCreated(): ?\DateTime
```

***

### getUpdated

The time when the support ticket was updated.

```php
public getUpdated(): ?\DateTime
```

***

### getType

A type of the ticket.

```php
public getType(): ?string
```

***

### getSubject

A title of the ticket.

```php
public getSubject(): ?string
```

***

### getDescription

The description body of the support ticket.

```php
public getDescription(): ?string
```

***

### getPriority

A priority of the ticket.

```php
public getPriority(): ?string
```

***

### getFollowupTid

Followup ticket ID. The unique ID of the ticket which this ticket is a follow-up to.

```php
public getFollowupTid(): ?string
```

***

### getStatus

The status of the support ticket.

```php
public getStatus(): ?string
```

***

### getRecipient

Email address of the ticket recipient, defaults to support@upsun.com.

```php
public getRecipient(): ?string
```

***

### getRequesterId

UUID of the ticket requester.

```php
public getRequesterId(): ?string
```

***

### getSubmitterId

UUID of the ticket submitter.

```php
public getSubmitterId(): ?string
```

***

### getAssigneeId

UUID of the ticket assignee.

```php
public getAssigneeId(): ?string
```

***

### getOrganizationId

A reference id that is usable to find the commerce license.

```php
public getOrganizationId(): ?string
```

***

### getCollaboratorIds

```php
public getCollaboratorIds(): ?array
```

***

### getHasIncidents

Whether or not this ticket has incidents.

```php
public getHasIncidents(): ?bool
```

***

### getDue

A time that the ticket is due at.

```php
public getDue(): ?\DateTime
```

***

### getTags

```php
public getTags(): ?array
```

***

### getSubscriptionId

The internal ID of the subscription.

```php
public getSubscriptionId(): ?string
```

***

### getTicketGroup

Maps to zendesk field 'Request group'.

```php
public getTicketGroup(): ?string
```

***

### getSupportPlan

Maps to zendesk field 'The support plan associated with this ticket.

```php
public getSupportPlan(): ?string
```

***

### getAffectedUrl

The affected URL associated with the support ticket.

```php
public getAffectedUrl(): ?string
```

***

### getQueue

The queue the support ticket is in.

```php
public getQueue(): ?string
```

***

### getIssueType

The issue type of the support ticket.

```php
public getIssueType(): ?string
```

***

### getResolutionTime

Maps to zendesk field 'Resolution Time'.

```php
public getResolutionTime(): ?\DateTime
```

***

### getResponseTime

Maps to zendesk field 'Response Time (time from request to reply).

```php
public getResponseTime(): ?\DateTime
```

***

### getProjectUrl

Maps to zendesk field 'Project URL'.

```php
public getProjectUrl(): ?string
```

***

### getRegion

Maps to zendesk field 'Region'.

```php
public getRegion(): ?string
```

***

### getCategory

Maps to zendesk field 'Category'.

```php
public getCategory(): ?string
```

***

### getEnvironment

Maps to zendesk field 'Environment'.

```php
public getEnvironment(): ?string
```

***

### getTicketSharingStatus

Maps to zendesk field 'Ticket Sharing Status'.

```php
public getTicketSharingStatus(): ?string
```

***

### getApplicationTicketUrl

Maps to zendesk field 'Application Ticket URL'.

```php
public getApplicationTicketUrl(): ?string
```

***

### getInfrastructureTicketUrl

Maps to zendesk field 'Infrastructure Ticket URL'.

```php
public getInfrastructureTicketUrl(): ?string
```

***

### getJira

A list of JIRA issues related to the support ticket.

```php
public getJira(): \Upsun\Model\TicketJiraInner[]|null
```

***

### getZdTicketUrl

URL to the customer-facing ticket in Zendesk.

```php
public getZdTicketUrl(): ?string
```

***
