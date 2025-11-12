# BitbucketIntegration

Low level BitbucketIntegration (auto-generated)

***

* Full name: `\Upsun\Model\BitbucketIntegration`
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
public __construct(string $type, bool $fetchBranches, bool $pruneBranches, string $environmentInitResources, string $repository, bool $buildPullRequests, bool $pullRequestsCloneParentData, bool $resyncPullRequests, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?\Upsun\Model\OAuth2Consumer $appCredentials = null, ?\Upsun\Model\AddonCredential $addonCredentials = null, ?string $id = null): mixed
```

**Parameters:**

| Parameter                      | Type                              | Description |
|--------------------------------|-----------------------------------|-------------|
| `$type`                        | **string**                        |             |
| `$fetchBranches`               | **bool**                          |             |
| `$pruneBranches`               | **bool**                          |             |
| `$environmentInitResources`    | **string**                        |             |
| `$repository`                  | **string**                        |             |
| `$buildPullRequests`           | **bool**                          |             |
| `$pullRequestsCloneParentData` | **bool**                          |             |
| `$resyncPullRequests`          | **bool**                          |             |
| `$createdAt`                   | **?\DateTime**                    |             |
| `$updatedAt`                   | **?\DateTime**                    |             |
| `$appCredentials`              | **?\Upsun\Model\OAuth2Consumer**  |             |
| `$addonCredentials`            | **?\Upsun\Model\AddonCredential** |             |
| `$id`                          | **?string**                       |             |

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

The Bitbucket repository (in the form `user/repo`).

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

### getResyncPullRequests

Whether or not pull request environment data should be re-synced on every build.

```php
public getResyncPullRequests(): bool
```

***

### getId

The identifier of BitbucketIntegration

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
