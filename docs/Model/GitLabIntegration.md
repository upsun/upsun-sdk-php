# # GitLabIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**fetchBranches** | **bool** | Whether or not to fetch branches. |
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). |
**environmentInitResources** | **string** | The resources used when initializing a new service |
**tokenExpiresAt** | **\DateTime** |  |
**rotateToken** | **bool** |  |
**rotateTokenValidityInWeeks** | **int** |  |
**baseUrl** | **string** | The base URL of the GitLab installation. |
**project** | **string** | The GitLab project (in the form &#x60;namespace/repo&#x60;). |
**buildMergeRequests** | **bool** | Whether or not to build merge requests. |
**buildWipMergeRequests** | **bool** | Whether or not to build work in progress merge requests (requires &#x60;build_merge_requests&#x60;). |
**mergeRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. |
**id** | **string** | The identifier of GitLabIntegration | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
