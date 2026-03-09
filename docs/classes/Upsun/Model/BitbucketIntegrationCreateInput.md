# BitbucketIntegrationCreateInput

Low level BitbucketIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\BitbucketIntegrationCreateInput`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationCreateInput`](./IntegrationCreateInput.md)

**See Also:**

* https://docs.upsun.com

## Constants

| Constant                              | Visibility | Type | Value     |
|---------------------------------------|------------|------|-----------|
| `ENVIRONMENT_INIT_RESOURCES__DEFAULT` | public     |      | 'default' |
| `ENVIRONMENT_INIT_RESOURCES_MANUAL`   | public     |      | 'manual'  |
| `ENVIRONMENT_INIT_RESOURCES_MINIMUM`  | public     |      | 'minimum' |
| `ENVIRONMENT_INIT_RESOURCES_PARENT`   | public     |      | 'parent'  |

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

## Methods

### __construct

```php
public __construct(string $type, string $repository, ?\Upsun\Model\OAuth2Consumer1 $appCredentials = null, ?\Upsun\Model\AddonCredential1 $addonCredentials = null, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $pullRequestsCloneParentData = null, ?bool $resyncPullRequests = null): mixed
```

**Parameters:**

| Parameter                      | Type                               | Description |
|--------------------------------|------------------------------------|-------------|
| `$type`                        | **string**                         |             |
| `$repository`                  | **string**                         |             |
| `$appCredentials`              | **?\Upsun\Model\OAuth2Consumer1**  |             |
| `$addonCredentials`            | **?\Upsun\Model\AddonCredential1** |             |
| `$fetchBranches`               | **?bool**                          |             |
| `$pruneBranches`               | **?bool**                          |             |
| `$environmentInitResources`    | **?string**                        |             |
| `$buildPullRequests`           | **?bool**                          |             |
| `$pullRequestsCloneParentData` | **?bool**                          |             |
| `$resyncPullRequests`          | **?bool**                          |             |

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

The Bitbucket repository (in the form `user/repo`).

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

Whether or not to clone parent data when building merge requests.

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
