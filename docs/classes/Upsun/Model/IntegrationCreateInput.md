# IntegrationCreateInput

Low level IntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\IntegrationCreateInput`
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

### repository

```php
private string $repository
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

### token

```php
private string $token
```

***

### project

```php
private string $project
```

***

### serviceId

```php
private string $serviceId
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

### licenseKey

```php
private string $licenseKey
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

### appCredentials

```php
private ?\Upsun\Model\OAuth2Consumer1 $appCredentials
```

***

### addonCredentials

```php
private ?\Upsun\Model\AddonCredential1 $addonCredentials
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

### fetchBranches

```php
private ?bool $fetchBranches
```

***

### pruneBranches

```php
private ?bool $pruneBranches
```

***

### environmentInitResources

```php
private ?string $environmentInitResources
```

***

### buildPullRequests

```php
private ?bool $buildPullRequests
```

***

### pullRequestsCloneParentData

```php
private ?bool $pullRequestsCloneParentData
```

***

### resyncPullRequests

```php
private ?bool $resyncPullRequests
```

***

### events

```php
private ?array $events
```

***

### environments

```php
private ?array $environments
```

***

### excludedEnvironments

```php
private ?array $excludedEnvironments
```

***

### states

```php
private ?array $states
```

***

### result

```php
private ?string $result
```

***

### baseUrl

```php
private ?string $baseUrl
```

***

### buildDraftPullRequests

```php
private ?bool $buildDraftPullRequests
```

***

### buildPullRequestsPostMerge

```php
private ?bool $buildPullRequestsPostMerge
```

***

### rotateToken

```php
private ?bool $rotateToken
```

***

### rotateTokenValidityInWeeks

```php
private ?int $rotateTokenValidityInWeeks
```

***

### buildMergeRequests

```php
private ?bool $buildMergeRequests
```

***

### buildWipMergeRequests

```php
private ?bool $buildWipMergeRequests
```

***

### mergeRequestsCloneParentData

```php
private ?bool $mergeRequestsCloneParentData
```

***

### extra

```php
private ?array $extra
```

***

### headers

```php
private ?array $headers
```

***

### tlsVerify

```php
private ?bool $tlsVerify
```

***

### excludedServices

```php
private ?array $excludedServices
```

***

### sourcetype

```php
private ?string $sourcetype
```

***

### category

```php
private ?string $category
```

***

### host

```php
private ?string $host
```

***

### port

```php
private ?int $port
```

***

### protocol

```php
private ?string $protocol
```

***

### facility

```php
private ?int $facility
```

***

### messageFormat

```php
private ?string $messageFormat
```

***

### authToken

```php
private ?string $authToken
```

***

### authMode

```php
private ?string $authMode
```

***

## Methods

### __construct

```php
public __construct(string $type, string $repository, string $url, string $username, string $token, string $project, string $serviceId, array $recipients, string $routingKey, string $channel, string $licenseKey, string $script, string $index, ?\Upsun\Model\OAuth2Consumer1 $appCredentials = null, ?\Upsun\Model\AddonCredential1 $addonCredentials = null, ?string $fromAddress = null, ?string $sharedKey = null, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $pullRequestsCloneParentData = null, ?bool $resyncPullRequests = null, ?array $events = [], ?array $environments = [], ?array $excludedEnvironments = [], ?array $states = [], ?string $result = null, ?string $baseUrl = null, ?bool $buildDraftPullRequests = null, ?bool $buildPullRequestsPostMerge = null, ?bool $rotateToken = null, ?int $rotateTokenValidityInWeeks = null, ?bool $buildMergeRequests = null, ?bool $buildWipMergeRequests = null, ?bool $mergeRequestsCloneParentData = null, ?array $extra = [], ?array $headers = [], ?bool $tlsVerify = null, ?array $excludedServices = [], ?string $sourcetype = null, ?string $category = null, ?string $host = null, ?int $port = null, ?string $protocol = null, ?int $facility = null, ?string $messageFormat = null, ?string $authToken = null, ?string $authMode = null): mixed
```

**Parameters:**

| Parameter                       | Type                               | Description |
|---------------------------------|------------------------------------|-------------|
| `$type`                         | **string**                         |             |
| `$repository`                   | **string**                         |             |
| `$url`                          | **string**                         |             |
| `$username`                     | **string**                         |             |
| `$token`                        | **string**                         |             |
| `$project`                      | **string**                         |             |
| `$serviceId`                    | **string**                         |             |
| `$recipients`                   | **array**                          |             |
| `$routingKey`                   | **string**                         |             |
| `$channel`                      | **string**                         |             |
| `$licenseKey`                   | **string**                         |             |
| `$script`                       | **string**                         |             |
| `$index`                        | **string**                         |             |
| `$appCredentials`               | **?\Upsun\Model\OAuth2Consumer1**  |             |
| `$addonCredentials`             | **?\Upsun\Model\AddonCredential1** |             |
| `$fromAddress`                  | **?string**                        |             |
| `$sharedKey`                    | **?string**                        |             |
| `$fetchBranches`                | **?bool**                          |             |
| `$pruneBranches`                | **?bool**                          |             |
| `$environmentInitResources`     | **?string**                        |             |
| `$buildPullRequests`            | **?bool**                          |             |
| `$pullRequestsCloneParentData`  | **?bool**                          |             |
| `$resyncPullRequests`           | **?bool**                          |             |
| `$events`                       | **?array**                         |             |
| `$environments`                 | **?array**                         |             |
| `$excludedEnvironments`         | **?array**                         |             |
| `$states`                       | **?array**                         |             |
| `$result`                       | **?string**                        |             |
| `$baseUrl`                      | **?string**                        |             |
| `$buildDraftPullRequests`       | **?bool**                          |             |
| `$buildPullRequestsPostMerge`   | **?bool**                          |             |
| `$rotateToken`                  | **?bool**                          |             |
| `$rotateTokenValidityInWeeks`   | **?int**                           |             |
| `$buildMergeRequests`           | **?bool**                          |             |
| `$buildWipMergeRequests`        | **?bool**                          |             |
| `$mergeRequestsCloneParentData` | **?bool**                          |             |
| `$extra`                        | **?array**                         |             |
| `$headers`                      | **?array**                         |             |
| `$tlsVerify`                    | **?bool**                          |             |
| `$excludedServices`             | **?array**                         |             |
| `$sourcetype`                   | **?string**                        |             |
| `$category`                     | **?string**                        |             |
| `$host`                         | **?string**                        |             |
| `$port`                         | **?int**                           |             |
| `$protocol`                     | **?string**                        |             |
| `$facility`                     | **?int**                           |             |
| `$messageFormat`                | **?string**                        |             |
| `$authToken`                    | **?string**                        |             |
| `$authMode`                     | **?string**                        |             |

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

### getType

```php
public getType(): string
```

***

### getRepository

The GitHub repository (in the form `user/repo`).

```php
public getRepository(): string
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

### getToken

The Splunk Authorization Token

```php
public getToken(): string
```

***

### getProject

The GitLab project (in the form `namespace/repo`).

```php
public getProject(): string
```

***

### getServiceId

```php
public getServiceId(): string
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

### getLicenseKey

The NewRelic Logs License Key

```php
public getLicenseKey(): string
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

### getFetchBranches

Whether or not to fetch branches.

```php
public getFetchBranches(): ?bool
```

***

### getPruneBranches

Whether or not to remove branches that disappeared remotely (requires `fetch_branches`).

```php
public getPruneBranches(): ?bool
```

***

### getEnvironmentInitResources

The resources used when initializing a new service

```php
public getEnvironmentInitResources(): ?string
```

***

### getAppCredentials

The OAuth2 consumer information (optional).

```php
public getAppCredentials(): ?\Upsun\Model\OAuth2Consumer1
```

***

### getAddonCredentials

The addon credential information (optional).

```php
public getAddonCredentials(): ?\Upsun\Model\AddonCredential1
```

***

### getBuildPullRequests

Whether or not to build pull requests.

```php
public getBuildPullRequests(): ?bool
```

***

### getPullRequestsCloneParentData

Whether or not to clone parent data when building pull requests.

```php
public getPullRequestsCloneParentData(): ?bool
```

***

### getResyncPullRequests

Whether or not pull request environment data should be re-synced on every build.

```php
public getResyncPullRequests(): ?bool
```

***

### getEvents

```php
public getEvents(): ?array
```

***

### getEnvironments

```php
public getEnvironments(): ?array
```

***

### getExcludedEnvironments

```php
public getExcludedEnvironments(): ?array
```

***

### getStates

```php
public getStates(): ?array
```

***

### getResult

Result to execute the hook on

```php
public getResult(): ?string
```

***

### getBaseUrl

The base URL of the GitLab installation.

```php
public getBaseUrl(): ?string
```

***

### getBuildDraftPullRequests

Whether or not to build draft pull requests (requires `build_pull_requests`).

```php
public getBuildDraftPullRequests(): ?bool
```

***

### getBuildPullRequestsPostMerge

Whether to build pull requests post-merge (if true) or pre-merge (if false).

```php
public getBuildPullRequestsPostMerge(): ?bool
```

***

### getRotateToken

```php
public getRotateToken(): ?bool
```

***

### getRotateTokenValidityInWeeks

```php
public getRotateTokenValidityInWeeks(): ?int
```

***

### getBuildMergeRequests

Whether or not to build merge requests.

```php
public getBuildMergeRequests(): ?bool
```

***

### getBuildWipMergeRequests

Whether or not to build work in progress merge requests (requires `build_merge_requests`).

```php
public getBuildWipMergeRequests(): ?bool
```

***

### getMergeRequestsCloneParentData

Whether or not to clone parent data when building merge requests.

```php
public getMergeRequestsCloneParentData(): ?bool
```

***

### getFromAddress

The email address to use

```php
public getFromAddress(): ?string
```

***

### getSharedKey

The JWS shared secret key

```php
public getSharedKey(): ?string
```

***

### getExtra

```php
public getExtra(): ?array
```

***

### getHeaders

```php
public getHeaders(): ?array
```

***

### getTlsVerify

Enable/Disable HTTPS certificate verification

```php
public getTlsVerify(): ?bool
```

***

### getExcludedServices

```php
public getExcludedServices(): ?array
```

***

### getSourcetype

The event 'sourcetype'

```php
public getSourcetype(): ?string
```

***

### getCategory

The Category used to easy filtering (sent as X-Sumo-Category header)

```php
public getCategory(): ?string
```

***

### getHost

Syslog relay/collector host

```php
public getHost(): ?string
```

***

### getPort

Syslog relay/collector port

```php
public getPort(): ?int
```

***

### getProtocol

Transport protocol

```php
public getProtocol(): ?string
```

***

### getFacility

Syslog facility

```php
public getFacility(): ?int
```

***

### getMessageFormat

Syslog message format

```php
public getMessageFormat(): ?string
```

***

### getAuthToken

```php
public getAuthToken(): ?string
```

***

### getAuthMode

```php
public getAuthMode(): ?string
```

***
