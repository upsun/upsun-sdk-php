# # GitLabIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**token** | **string** | The GitLab private token. |
**project** | **string** | The GitLab project (in the form &#x60;namespace/repo&#x60;). |
**fetchBranches** | **bool** | Whether or not to fetch branches. | [optional]
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). | [optional]
**environmentInitResources** | **string** | The resources used when initializing a new service | [optional]
**rotateToken** | **bool** |  | [optional]
**rotateTokenValidityInWeeks** | **int** |  | [optional]
**baseUrl** | **string** | The base URL of the GitLab installation. | [optional]
**buildMergeRequests** | **bool** | Whether or not to build merge requests. | [optional]
**buildWipMergeRequests** | **bool** | Whether or not to build work in progress merge requests (requires &#x60;build_merge_requests&#x60;). | [optional]
**mergeRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
