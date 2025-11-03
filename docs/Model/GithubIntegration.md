# # GithubIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**fetchBranches** | **bool** | Whether or not to fetch branches. |
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). |
**environmentInitResources** | **string** | The resources used when initializing a new service |
**baseUrl** | **string** | The base URL of the Github API endpoint. |
**repository** | **string** | The GitHub repository (in the form &#x60;user/repo&#x60;). |
**buildPullRequests** | **bool** | Whether or not to build pull requests. |
**buildDraftPullRequests** | **bool** | Whether or not to build draft pull requests (requires &#x60;build_pull_requests&#x60;). |
**buildPullRequestsPostMerge** | **bool** | Whether to build pull requests post-merge (if true) or pre-merge (if false). |
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building pull requests. |
**tokenType** | **string** | The type of the token of this GitHub integration |
**id** | **string** | The identifier of GithubIntegration | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
