# BitbucketServerIntegration

Low level BitbucketServerIntegration (auto-generated)

***

* Full name: `\Upsun\Model\BitbucketServerIntegration`
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

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, bool $fetchBranches, bool $pruneBranches, string $environmentInitResources, string $url, string $username, string $project, string $repository, bool $buildPullRequests, bool $pullRequestsCloneParentData, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter                      | Type           | Description |
|--------------------------------|----------------|-------------|
| `$type`                        | **string**     |             |
| `$fetchBranches`               | **bool**       |             |
| `$pruneBranches`               | **bool**       |             |
| `$environmentInitResources`    | **string**     |             |
| `$url`                         | **string**     |             |
| `$username`                    | **string**     |             |
| `$project`                     | **string**     |             |
| `$repository`                  | **string**     |             |
| `$buildPullRequests`           | **bool**       |             |
| `$pullRequestsCloneParentData` | **bool**       |             |
| `$createdAt`                   | **?\DateTime** |             |
| `$updatedAt`                   | **?\DateTime** |             |
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

### getUrl

The base URL of the Bitbucket Server installation.

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

The Bitbucket Server project

```php
public getProject(): string
```

***

### getRepository

The Bitbucket Server repository

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

Whether or not to clone parent data when building merge requests.

```php
public getPullRequestsCloneParentData(): bool
```

***

### getId

The identifier of BitbucketServerIntegration

```php
public getId(): ?string
```

***
