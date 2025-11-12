# GithubIntegration

Low level GithubIntegration (auto-generated)

***

* Full name: `\Upsun\Model\GithubIntegration`
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

### pullRequestsCloneParentData

```php
private bool $pullRequestsCloneParentData
```

***

### tokenType

```php
private string $tokenType
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

### baseUrl

```php
private ?string $baseUrl
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
public __construct(string $type, bool $fetchBranches, bool $pruneBranches, string $environmentInitResources, string $repository, bool $buildPullRequests, bool $buildDraftPullRequests, bool $buildPullRequestsPostMerge, bool $pullRequestsCloneParentData, string $tokenType, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $baseUrl, ?string $id = null): mixed
```

**Parameters:**

| Parameter                      | Type           | Description |
|--------------------------------|----------------|-------------|
| `$type`                        | **string**     |             |
| `$fetchBranches`               | **bool**       |             |
| `$pruneBranches`               | **bool**       |             |
| `$environmentInitResources`    | **string**     |             |
| `$repository`                  | **string**     |             |
| `$buildPullRequests`           | **bool**       |             |
| `$buildDraftPullRequests`      | **bool**       |             |
| `$buildPullRequestsPostMerge`  | **bool**       |             |
| `$pullRequestsCloneParentData` | **bool**       |             |
| `$tokenType`                   | **string**     |             |
| `$createdAt`                   | **?\DateTime** |             |
| `$updatedAt`                   | **?\DateTime** |             |
| `$baseUrl`                     | **?string**    |             |
| `$id`                          | **?string**    |             |

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

### getBaseUrl

The base URL of the Github API endpoint.

```php
public getBaseUrl(): ?string
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

### getPullRequestsCloneParentData

Whether or not to clone parent data when building pull requests.

```php
public getPullRequestsCloneParentData(): bool
```

***

### getTokenType

The type of the token of this GitHub integration

```php
public getTokenType(): string
```

***

### getId

The identifier of GithubIntegration

```php
public getId(): ?string
```

***
