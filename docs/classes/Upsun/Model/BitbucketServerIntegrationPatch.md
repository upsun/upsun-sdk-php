# BitbucketServerIntegrationPatch

Low level BitbucketServerIntegrationPatch (auto-generated)

***

* Full name: `\Upsun\Model\BitbucketServerIntegrationPatch`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\IntegrationPatch`](./IntegrationPatch.md)

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

### repository

```php
private string $repository
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

## Methods

### __construct

```php
public __construct(string $type, string $url, string $username, string $token, string $project, string $repository, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $buildPullRequests = null, ?bool $pullRequestsCloneParentData = null): mixed
```

**Parameters:**

| Parameter                      | Type        | Description |
|--------------------------------|-------------|-------------|
| `$type`                        | **string**  |             |
| `$url`                         | **string**  |             |
| `$username`                    | **string**  |             |
| `$token`                       | **string**  |             |
| `$project`                     | **string**  |             |
| `$repository`                  | **string**  |             |
| `$fetchBranches`               | **?bool**   |             |
| `$pruneBranches`               | **?bool**   |             |
| `$environmentInitResources`    | **?string** |             |
| `$buildPullRequests`           | **?bool**   |             |
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

### getToken

The Bitbucket Server personal access token.

```php
public getToken(): string
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
