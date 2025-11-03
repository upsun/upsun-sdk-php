# # GithubIntegrationPatch

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**token** | **string** | The GitHub token. |
**repository** | **string** | The GitHub repository (in the form &#x60;user/repo&#x60;). |
**fetchBranches** | **bool** | Whether or not to fetch branches. | [optional]
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). | [optional]
**environmentInitResources** | **string** | The resources used when initializing a new service | [optional]
**baseUrl** | **string** | The base URL of the Github API endpoint. | [optional]
**buildPullRequests** | **bool** | Whether or not to build pull requests. | [optional]
**buildDraftPullRequests** | **bool** | Whether or not to build draft pull requests (requires &#x60;build_pull_requests&#x60;). | [optional]
**buildPullRequestsPostMerge** | **bool** | Whether to build pull requests post-merge (if true) or pre-merge (if false). | [optional]
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building pull requests. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
