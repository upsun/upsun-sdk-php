# OpenAPI\Client\RepositoryApi

All URIs are relative to https://api.platform.sh.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProjectsGitBlobs()**](RepositoryApi.md#getProjectsGitBlobs) | **GET** /projects/{projectId}/git/blobs/{repositoryBlobId} | Get a blob object
[**getProjectsGitCommits()**](RepositoryApi.md#getProjectsGitCommits) | **GET** /projects/{projectId}/git/commits/{repositoryCommitId} | Get a commit object
[**getProjectsGitRefs()**](RepositoryApi.md#getProjectsGitRefs) | **GET** /projects/{projectId}/git/refs/{repositoryRefId} | Get a ref object
[**getProjectsGitTrees()**](RepositoryApi.md#getProjectsGitTrees) | **GET** /projects/{projectId}/git/trees/{repositoryTreeId} | Get a tree object
[**listProjectsGitRefs()**](RepositoryApi.md#listProjectsGitRefs) | **GET** /projects/{projectId}/git/refs | Get list of repository refs


## `getProjectsGitBlobs()`

```php
getProjectsGitBlobs($project_id, $repository_blob_id): \OpenAPI\Client\Model\Blob
```

Get a blob object

Retrieve, by hash, an object representing a blob in the repository backing a project. This endpoint allows direct read-only access to the contents of files in a repo. It returns the file in the `content` field of the response object, encoded according to the format in the `encoding` field, e.g. `base64`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$repository_blob_id = 'repository_blob_id_example'; // string

try {
    $result = $apiInstance->getProjectsGitBlobs($project_id, $repository_blob_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitBlobs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **repository_blob_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Blob**](../Model/Blob.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitCommits()`

```php
getProjectsGitCommits($project_id, $repository_commit_id): \OpenAPI\Client\Model\Commit
```

Get a commit object

Retrieve, by hash, an object representing a commit in the repository backing a project. This endpoint functions similarly to `git cat-file -p <commit-id>`. The returned object contains the hash of the Git tree that it belongs to, as well as the ID of parent commits.  The commit represented by a parent ID can be retrieved using this endpoint, while the tree state represented by this commit can be retrieved using the [Get a tree object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1trees~1%7BrepositoryTreeId%7D%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$repository_commit_id = 'repository_commit_id_example'; // string

try {
    $result = $apiInstance->getProjectsGitCommits($project_id, $repository_commit_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitCommits: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **repository_commit_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Commit**](../Model/Commit.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitRefs()`

```php
getProjectsGitRefs($project_id, $repository_ref_id): \OpenAPI\Client\Model\Ref
```

Get a ref object

Retrieve the details of a single `refs` object in the repository backing a project. This endpoint functions similarly to `git show-ref <pattern>`, although the pattern must be a full ref `id`, rather than a matching pattern.  *NOTE: The `{repositoryRefId}` must be properly escaped.* That is, the ref `refs/heads/master` is accessible via `/projects/{projectId}/git/refs/heads%2Fmaster`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$repository_ref_id = 'repository_ref_id_example'; // string

try {
    $result = $apiInstance->getProjectsGitRefs($project_id, $repository_ref_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitRefs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **repository_ref_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Ref**](../Model/Ref.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectsGitTrees()`

```php
getProjectsGitTrees($project_id, $repository_tree_id): \OpenAPI\Client\Model\Tree
```

Get a tree object

Retrieve, by hash, the tree state represented by a commit. The returned object's `tree` field contains a list of files and directories present in the tree.  Directories in the tree can be recursively retrieved by this endpoint through their hashes. Files in the tree can be retrieved by the [Get a blob object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1blobs~1%7BrepositoryBlobId%7D%2Fget) endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string
$repository_tree_id = 'repository_tree_id_example'; // string

try {
    $result = $apiInstance->getProjectsGitTrees($project_id, $repository_tree_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->getProjectsGitTrees: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |
 **repository_tree_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Tree**](../Model/Tree.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listProjectsGitRefs()`

```php
listProjectsGitRefs($project_id): \OpenAPI\Client\Model\Ref[]
```

Get list of repository refs

Retrieve a list of `refs/_*` in the repository backing a project. This endpoint functions similarly to `git show-ref`, with each returned object containing a `ref` field with the ref's name, and an object containing the associated commit ID.  The returned commit ID can be used with the [Get a commit object](#tag/Git-Repo%2Fpaths%2F~1projects~1%7BprojectId%7D~1git~1commits~1%7BrepositoryCommitId%7D%2Fget) endpoint to retrieve information about that specific commit.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RepositoryApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$project_id = 'project_id_example'; // string

try {
    $result = $apiInstance->listProjectsGitRefs($project_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RepositoryApi->listProjectsGitRefs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **project_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Ref[]**](../Model/Ref.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
