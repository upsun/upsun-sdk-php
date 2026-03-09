# GitLabIntegrationCreateInput

Low level GitLabIntegrationCreateInput (auto-generated)

***

* Full name: `\Upsun\Model\GitLabIntegrationCreateInput`
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

### baseUrl

```php
private ?string $baseUrl
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

## Methods

### __construct

```php
public __construct(string $type, string $token, string $project, ?bool $fetchBranches = null, ?bool $pruneBranches = null, ?string $environmentInitResources = null, ?bool $rotateToken = null, ?int $rotateTokenValidityInWeeks = null, ?string $baseUrl = null, ?bool $buildMergeRequests = null, ?bool $buildWipMergeRequests = null, ?bool $mergeRequestsCloneParentData = null): mixed
```

**Parameters:**

| Parameter                       | Type        | Description |
|---------------------------------|-------------|-------------|
| `$type`                         | **string**  |             |
| `$token`                        | **string**  |             |
| `$project`                      | **string**  |             |
| `$fetchBranches`                | **?bool**   |             |
| `$pruneBranches`                | **?bool**   |             |
| `$environmentInitResources`     | **?string** |             |
| `$rotateToken`                  | **?bool**   |             |
| `$rotateTokenValidityInWeeks`   | **?int**    |             |
| `$baseUrl`                      | **?string** |             |
| `$buildMergeRequests`           | **?bool**   |             |
| `$buildWipMergeRequests`        | **?bool**   |             |
| `$mergeRequestsCloneParentData` | **?bool**   |             |

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

The GitLab private token.

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

### getBaseUrl

The base URL of the GitLab installation.

```php
public getBaseUrl(): ?string
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
