# GitLabIntegration

Low level GitLabIntegration (auto-generated)

***

* Full name: `\Upsun\Model\GitLabIntegration`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`,
  [`\Upsun\Model\Integration`](./Integration.md)

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

### baseUrl

```php
private string $baseUrl
```

***

### project

```php
private string $project
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

### id

```php
private ?string $id
```

***

## Methods

### __construct

```php
public __construct(string $type, bool $fetchBranches, bool $pruneBranches, string $environmentInitResources, bool $rotateToken, int $rotateTokenValidityInWeeks, string $baseUrl, string $project, bool $buildMergeRequests, bool $buildWipMergeRequests, bool $mergeRequestsCloneParentData, ?\DateTime $createdAt, ?\DateTime $updatedAt, ?\DateTime $tokenExpiresAt, ?string $id = null): mixed
```

**Parameters:**

| Parameter                       | Type           | Description |
|---------------------------------|----------------|-------------|
| `$type`                         | **string**     |             |
| `$fetchBranches`                | **bool**       |             |
| `$pruneBranches`                | **bool**       |             |
| `$environmentInitResources`     | **string**     |             |
| `$rotateToken`                  | **bool**       |             |
| `$rotateTokenValidityInWeeks`   | **int**        |             |
| `$baseUrl`                      | **string**     |             |
| `$project`                      | **string**     |             |
| `$buildMergeRequests`           | **bool**       |             |
| `$buildWipMergeRequests`        | **bool**       |             |
| `$mergeRequestsCloneParentData` | **bool**       |             |
| `$createdAt`                    | **?\DateTime** |             |
| `$updatedAt`                    | **?\DateTime** |             |
| `$tokenExpiresAt`               | **?\DateTime** |             |
| `$id`                           | **?string**    |             |

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

### getBaseUrl

The base URL of the GitLab installation.

```php
public getBaseUrl(): string
```

***

### getProject

The GitLab project (in the form `namespace/repo`).

```php
public getProject(): string
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

### getId

The identifier of GitLabIntegration

```php
public getId(): ?string
```

***
