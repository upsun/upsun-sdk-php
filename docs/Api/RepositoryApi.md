# [Upsun\Api\RepositoryApi](../src/Api/RepositoryApi.php)

All URIs are relative to https://api.upsun.com, except if the operation defines another base path.

| Method | HTTP request | Description | Upsun API Doc |
| ------------- | ------------- | ------------- | ------------- |
| [**getProjectsGitBlobs()**](RepositoryApi.md#getProjectsGitBlobs) | **GET** /projects/{projectId}/git/blobs/{repositoryBlobId} | Get a blob object | https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-blobs |
| [**getProjectsGitCommits()**](RepositoryApi.md#getProjectsGitCommits) | **GET** /projects/{projectId}/git/commits/{repositoryCommitId} | Get a commit object | https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-commits |
| [**getProjectsGitRefs()**](RepositoryApi.md#getProjectsGitRefs) | **GET** /projects/{projectId}/git/refs/{repositoryRefId} | Get a ref object | https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-refs |
| [**getProjectsGitTrees()**](RepositoryApi.md#getProjectsGitTrees) | **GET** /projects/{projectId}/git/trees/{repositoryTreeId} | Get a tree object | https://docs.upsun.com/api/#tag/Repository/operation/get-projects-git-trees |
| [**listProjectsGitRefs()**](RepositoryApi.md#listProjectsGitRefs) | **GET** /projects/{projectId}/git/refs | Get list of repository refs | https://docs.upsun.com/api/#tag/Repository/operation/list-projects-git-refs |


## `getProjectsGitBlobs()`

```php
getProjectsGitBlobs($projectId, $repositoryBlobId): \Upsun\Model\Blob
```

Get a blob object

Retrieve, by hash, an object representing a blob in the repository backing a project. This endpoint allows direct read-only access to the contents of files in a repo. It returns the file in the `content` field of the response object, encoded according to the format in the `encoding` field, e.g. `base64`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$repositoryBlobId = 'repositoryBlobId_example'; // string

try {
    $result = $apiInstance->getProjectsGitBlobs($projectId, $repositoryBlobId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitBlobs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **repositoryBlobId** | **string**|  | |

### Return type

[**\Upsun\Model\Blob**](../Model/Blob.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitCommits()`

```php
getProjectsGitCommits($projectId, $repositoryCommitId): \Upsun\Model\Commit
```

Get a commit object

Retrieve, by hash, an object representing a commit in the repository backing a project. This endpoint functions similarly to `git cat-file -p <commit-id>`. The returned object contains the hash of the Git tree that it belongs to, as well as the ID of parent commits.  The commit represented by a parent ID can be retrieved using this endpoint, while the tree state represented by this commit can be retrieved using the [Get a tree object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1trees~1%7BrepositoryTreeId%7D%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$repositoryCommitId = 'repositoryCommitId_example'; // string

try {
    $result = $apiInstance->getProjectsGitCommits($projectId, $repositoryCommitId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitCommits: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **repositoryCommitId** | **string**|  | |

### Return type

[**\Upsun\Model\Commit**](../Model/Commit.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitRefs()`

```php
getProjectsGitRefs($projectId, $repositoryRefId): \Upsun\Model\Ref
```

Get a ref object

Retrieve the details of a single `refs` object in the repository backing a project. This endpoint functions similarly to `git show-ref <pattern>`, although the pattern must be a full ref `id`, rather than a matching pattern.  *NOTE: The `{repositoryRefId}` must be properly escaped.* That is, the ref `refs/heads/master` is accessible via `/projects/{projectId}/git/refs/heads%2Fmaster`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$repositoryRefId = 'repositoryRefId_example'; // string

try {
    $result = $apiInstance->getProjectsGitRefs($projectId, $repositoryRefId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitRefs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **repositoryRefId** | **string**|  | |

### Return type

[**\Upsun\Model\Ref**](../Model/Ref.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitTrees()`

```php
getProjectsGitTrees($projectId, $repositoryTreeId): \Upsun\Model\Tree
```

Get a tree object

Retrieve, by hash, the tree state represented by a commit. The returned object's `tree` field contains a list of files and directories present in the tree.  Directories in the tree can be recursively retrieved by this endpoint through their hashes. Files in the tree can be retrieved by the [Get a blob object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1blobs~1%7BrepositoryBlobId%7D%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string
$repositoryTreeId = 'repositoryTreeId_example'; // string

try {
    $result = $apiInstance->getProjectsGitTrees($projectId, $repositoryTreeId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitTrees: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |
| **repositoryTreeId** | **string**|  | |

### Return type

[**\Upsun\Model\Tree**](../Model/Tree.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsGitRefs()`

```php
listProjectsGitRefs($projectId): \Upsun\Model\Ref[]
```

Get list of repository refs

Retrieve a list of `refs/_*` in the repository backing a project. This endpoint functions similarly to `git show-ref`, with each returned object containing a `ref` field with the ref's name, and an object containing the associated commit ID.  The returned commit ID can be used with the [Get a commit object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1commits~1%7BrepositoryCommitId%7D%2Fget) endpoint to retrieve information about that specific commit.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Upsun\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$projectId = 'projectId_example'; // string

try {
    $result = $apiInstance->listProjectsGitRefs($projectId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->listProjectsGitRefs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **projectId** | **string**|  | |

### Return type

[**\Upsun\Model\Ref[]**](../Model/Ref.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
