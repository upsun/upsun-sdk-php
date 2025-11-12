# Integration

Low level Integration (auto-generated)

***

* Full name: `\Upsun\Model\Integration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### type

```php
private string $type
```

***

### fetchBranches

```php
private bool $fetchBranches
```

***

### pruneBranches

```php
private bool $pruneBranches
```

***

### environmentInitResources

```php
private string $environmentInitResources
```

***

### repository

```php
private string $repository
```

***

### buildPullRequests

```php
private bool $buildPullRequests
```

***

### pullRequestsCloneParentData

```php
private bool $pullRequestsCloneParentData
```

***

### resyncPullRequests

```php
private bool $resyncPullRequests
```

***

### url

```php
private string $url
```

***

### username

```php
private string $username
```

***

### project

```php
private string $project
```

***

### environmentsCredentials

```php
private array $environmentsCredentials
```

***

### continuousProfiling

```php
private bool $continuousProfiling
```

***

### events

```php
private array $events
```

***

### environments

```php
private array $environments
```

***

### excludedEnvironments

```php
private array $excludedEnvironments
```

***

### states

```php
private array $states
```

***

### result

```php
private string $result
```

***

### serviceId

```php
private string $serviceId
```

***

### baseUrl

```php
private string $baseUrl
```

***

### buildDraftPullRequests

```php
private bool $buildDraftPullRequests
```

***

### buildPullRequestsPostMerge

```php
private bool $buildPullRequestsPostMerge
```

***

### tokenType

```php
private string $tokenType
```

***

### rotateToken

```php
private bool $rotateToken
```

***

### rotateTokenValidityInWeeks

```php
private int $rotateTokenValidityInWeeks
```

***

### buildMergeRequests

```php
private bool $buildMergeRequests
```

***

### buildWipMergeRequests

```php
private bool $buildWipMergeRequests
```

***

### mergeRequestsCloneParentData

```php
private bool $mergeRequestsCloneParentData
```

***

### recipients

```php
private array $recipients
```

***

### routingKey

```php
private string $routingKey
```

***

### channel

```php
private string $channel
```

***

### extra

```php
private array $extra
```

***

### headers

```php
private array $headers
```

***

### tlsVerify

```php
private bool $tlsVerify
```

***

### excludedServices

```php
private array $excludedServices
```

***

### script

```php
private string $script
```

***

### index

```php
private string $index
```

***

### sourcetype

```php
private string $sourcetype
```

***

### category

```php
private string $category
```

***

### host

```php
private string $host
```

***

### port

```php
private int $port
```

***

### protocol

```php
private string $protocol
```

***

### facility

```php
private int $facility
```

***

### messageFormat

```php
private string $messageFormat
```

***

### createdAt

```php
private ?\DateTime $createdAt
```

***

### updatedAt

```php
private ?\DateTime $updatedAt
```

***

### tokenExpiresAt

```php
private ?\DateTime $tokenExpiresAt
```

***

### fromAddress

```php
private ?string $fromAddress
```

***

### sharedKey

```php
private ?string $sharedKey
```

***

### appCredentials

```php
private ?\Upsun\Model\OAuth2Consumer $appCredentials
```

***

### addonCredentials

```php
private ?\Upsun\Model\AddonCredential $addonCredentials
```

***

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, bool $fetchBranches, bool $pruneBranches, string $environmentInitResources, string $repository, bool $buildPullRequests, bool $pullRequestsCloneParentData, bool $resyncPullRequests, string $url, string $username, string $project, array $environmentsCredentials, bool $continuousProfiling, array $events, array $environments, array $excludedEnvironments, array $states, string $result, string $serviceId, string $baseUrl, bool $buildDraftPullRequests, bool $buildPullRequestsPostMerge, string $tokenType, bool $rotateToken, int $rotateTokenValidityInWeeks, bool $buildMergeRequests, bool $buildWipMergeRequests, bool $mergeRequestsCloneParentData, array $recipients, string $routingKey, string $channel, array $extra, array $headers, bool $tlsVerify, array $excludedServices, string $script, string $index, string $sourcetype, string $category, string $host, int $port, string $protocol, int $facility, string $messageFormat, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?\DateTime $tokenExpiresAt, ?string $fromAddress, ?string $sharedKey, ?\Upsun\Model\OAuth2Consumer $appCredentials = null, ?\Upsun\Model\AddonCredential $addonCredentials = null, ?string $id = null): mixed
```

**Parameters:**

| Parameter                       | Type                              | Description |
|---------------------------------|-----------------------------------|-------------|
| `$type`                         | **string**                        |             |
| `$fetchBranches`                | **bool**                          |             |
| `$pruneBranches`                | **bool**                          |             |
| `$environmentInitResources`     | **string**                        |             |
| `$repository`                   | **string**                        |             |
| `$buildPullRequests`            | **bool**                          |             |
| `$pullRequestsCloneParentData`  | **bool**                          |             |
| `$resyncPullRequests`           | **bool**                          |             |
| `$url`                          | **string**                        |             |
| `$username`                     | **string**                        |             |
| `$project`                      | **string**                        |             |
| `$environmentsCredentials`      | **array**                         |             |
| `$continuousProfiling`          | **bool**                          |             |
| `$events`                       | **array**                         |             |
| `$environments`                 | **array**                         |             |
| `$excludedEnvironments`         | **array**                         |             |
| `$states`                       | **array**                         |             |
| `$result`                       | **string**                        |             |
| `$serviceId`                    | **string**                        |             |
| `$baseUrl`                      | **string**                        |             |
| `$buildDraftPullRequests`       | **bool**                          |             |
| `$buildPullRequestsPostMerge`   | **bool**                          |             |
| `$tokenType`                    | **string**                        |             |
| `$rotateToken`                  | **bool**                          |             |
| `$rotateTokenValidityInWeeks`   | **int**                           |             |
| `$buildMergeRequests`           | **bool**                          |             |
| `$buildWipMergeRequests`        | **bool**                          |             |
| `$mergeRequestsCloneParentData` | **bool**                          |             |
| `$recipients`                   | **array**                         |             |
| `$routingKey`                   | **string**                        |             |
| `$channel`                      | **string**                        |             |
| `$extra`                        | **array**                         |             |
| `$headers`                      | **array**                         |             |
| `$tlsVerify`                    | **bool**                          |             |
| `$excludedServices`             | **array**                         |             |
| `$script`                       | **string**                        |             |
| `$index`                        | **string**                        |             |
| `$sourcetype`                   | **string**                        |             |
| `$category`                     | **string**                        |             |
| `$host`                         | **string**                        |             |
| `$port`                         | **int**                           |             |
| `$protocol`                     | **string**                        |             |
| `$facility`                     | **int**                           |             |
| `$messageFormat`                | **string**                        |             |
| `$createdAt`                    | **?\DateTime**                    |             |
| `$updatedAt`                    | **?\DateTime**                    |             |
| `$tokenExpiresAt`               | **?\DateTime**                    |             |
| `$fromAddress`                  | **?string**                       |             |
| `$sharedKey`                    | **?string**                       |             |
| `$appCredentials`               | **?\Upsun\Model\OAuth2Consumer**  |             |
| `$addonCredentials`             | **?\Upsun\Model\AddonCredential** |             |
| `$id`                           | **?string**                       |             |

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

### getCreatedAt

The creation date

```php
public getCreatedAt(): ?\DateTime
```

***

### getUpdatedAt

The update date

```php
public getUpdatedAt(): ?\DateTime
```

***

### getType

```php
public getType(): string
```

***

### getFetchBranches

Whether or not to fetch branches.

```php
public getFetchBranches(): bool
```

***

### getPruneBranches

Whether or not to remove branches that disappeared remotely (requires `fetch_branches`).

```php
public getPruneBranches(): bool
```

***

### getEnvironmentInitResources

The resources used when initializing a new service

```php
public getEnvironmentInitResources(): string
```

***

### getRepository

The GitHub repository (in the form `user/repo`).

```php
public getRepository(): string
```

***

### getBuildPullRequests

Whether or not to build pull requests.

```php
public getBuildPullRequests(): bool
```

***

### getPullRequestsCloneParentData

Whether or not to clone parent data when building pull requests.

```php
public getPullRequestsCloneParentData(): bool
```

***

### getResyncPullRequests

Whether or not pull request environment data should be re-synced on every build.

```php
public getResyncPullRequests(): bool
```

***

### getUrl

The URL of the webhook

```php
public getUrl(): string
```

***

### getUsername

The Bitbucket Server user.

```php
public getUsername(): string
```

***

### getProject

The GitLab project (in the form `namespace/repo`).

```php
public getProject(): string
```

***

### getEnvironmentsCredentials

Blackfire environments credentials

```php
public getEnvironmentsCredentials(): \Upsun\Model\EnvironmentsCredentialsValue[]
```

***

### getContinuousProfiling

Whether continuous profiling is enabled for the project

```php
public getContinuousProfiling(): bool
```

***

### getEvents

```php
public getEvents(): array
```

***

### getEnvironments

```php
public getEnvironments(): array
```

***

### getExcludedEnvironments

```php
public getExcludedEnvironments(): array
```

***

### getStates

```php
public getStates(): array
```

***

### getResult

Result to execute the hook on

```php
public getResult(): string
```

***

### getServiceId

```php
public getServiceId(): string
```

***

### getBaseUrl

The base URL of the GitLab installation.

```php
public getBaseUrl(): string
```

***

### getBuildDraftPullRequests

Whether or not to build draft pull requests (requires `build_pull_requests`).

```php
public getBuildDraftPullRequests(): bool
```

***

### getBuildPullRequestsPostMerge

Whether to build pull requests post-merge (if true) or pre-merge (if false).

```php
public getBuildPullRequestsPostMerge(): bool
```

***

### getTokenType

The type of the token of this GitHub integration

```php
public getTokenType(): string
```

***

### getTokenExpiresAt

```php
public getTokenExpiresAt(): ?\DateTime
```

***

### getRotateToken

```php
public getRotateToken(): bool
```

***

### getRotateTokenValidityInWeeks

```php
public getRotateTokenValidityInWeeks(): int
```

***

### getBuildMergeRequests

Whether or not to build merge requests.

```php
public getBuildMergeRequests(): bool
```

***

### getBuildWipMergeRequests

Whether or not to build work in progress merge requests (requires `build_merge_requests`).

```php
public getBuildWipMergeRequests(): bool
```

***

### getMergeRequestsCloneParentData

Whether or not to clone parent data when building merge requests.

```php
public getMergeRequestsCloneParentData(): bool
```

***

### getFromAddress

The email address to use

```php
public getFromAddress(): ?string
```

***

### getRecipients

```php
public getRecipients(): array
```

***

### getRoutingKey

The PagerDuty routing key

```php
public getRoutingKey(): string
```

***

### getChannel

The Slack channel to post messages to

```php
public getChannel(): string
```

***

### getExtra

```php
public getExtra(): array
```

***

### getHeaders

```php
public getHeaders(): array
```

***

### getTlsVerify

Enable/Disable HTTPS certificate verification

```php
public getTlsVerify(): bool
```

***

### getExcludedServices

```php
public getExcludedServices(): array
```

***

### getScript

The script to run

```php
public getScript(): string
```

***

### getIndex

The Splunk Index

```php
public getIndex(): string
```

***

### getSourcetype

The event 'sourcetype'

```php
public getSourcetype(): string
```

***

### getCategory

The Category used to easy filtering (sent as X-Sumo-Category header)

```php
public getCategory(): string
```

***

### getHost

Syslog relay/collector host

```php
public getHost(): string
```

***

### getPort

Syslog relay/collector port

```php
public getPort(): int
```

***

### getProtocol

Transport protocol

```php
public getProtocol(): string
```

***

### getFacility

Syslog facility

```php
public getFacility(): int
```

***

### getMessageFormat

Syslog message format

```php
public getMessageFormat(): string
```

***

### getSharedKey

The JWS shared secret key

```php
public getSharedKey(): ?string
```

***

### getId

The identifier of WebHookIntegration

```php
public getId(): ?string
```

***

### getAppCredentials

The OAuth2 consumer information (optional).

```php
public getAppCredentials(): ?\Upsun\Model\OAuth2Consumer
```

***

### getAddonCredentials

The addon credential information (optional).

```php
public getAddonCredentials(): ?\Upsun\Model\AddonCredential
```

***
