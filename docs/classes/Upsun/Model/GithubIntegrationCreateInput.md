# GithubIntegrationCreateInput

Low level GithubIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\GithubIntegrationCreateInput`
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

### token

```php
private string $token
```

***

### repository

```php
private string $repository
```

***

### baseUrl

```php
private ?string $baseUrl
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

### pullRequestsCloneParentData

```php
private ?bool $pullRequestsCloneParentData
```

***

## Methods

### __construct

```php
public __construct(string $type, string $token, string $repository, ?string $baseUrl = null, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $buildDraftPullRequests = null, ?bool $buildPullRequestsPostMerge = null, ?bool $pullRequestsCloneParentData = null): mixed
```

**Parameters:**

| Parameter                      | Type        | Description |
|--------------------------------|-------------|-------------|
| `$type`                        | **string**  |             |
| `$token`                       | **string**  |             |
| `$repository`                  | **string**  |             |
| `$baseUrl`                     | **?string** |             |
| `$fetchBranches`               | **?bool**   |             |
| `$pruneBranches`               | **?bool**   |             |
| `$environmentInitResources`    | **?string** |             |
| `$buildPullRequests`           | **?bool**   |             |
| `$buildDraftPullRequests`      | **?bool**   |             |
| `$buildPullRequestsPostMerge`  | **?bool**   |             |
| `$pullRequestsCloneParentData` | **?bool**   |             |

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

### getToken

The GitHub token.

```php
public getToken(): string
```

***

### getRepository

The GitHub repository (in the form `user/repo`).

```php
public getRepository(): string
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

### getBaseUrl

The base URL of the Github API endpoint.

```php
public getBaseUrl(): ?string
```

***

### getBuildPullRequests

Whether or not to build pull requests.

```php
public getBuildPullRequests(): ?bool
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

### getPullRequestsCloneParentData

Whether or not to clone parent data when building pull requests.

```php
public getPullRequestsCloneParentData(): ?bool
```

***
