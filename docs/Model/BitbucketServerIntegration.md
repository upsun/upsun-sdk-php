# # BitbucketServerIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**fetchBranches** | **bool** | Whether or not to fetch branches. |
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). |
**environmentInitResources** | **string** | The resources used when initializing a new service |
**url** | **string** | The base URL of the Bitbucket Server installation. |
**username** | **string** | The Bitbucket Server user. |
**project** | **string** | The Bitbucket Server project |
**repository** | **string** | The Bitbucket Server repository |
**buildPullRequests** | **bool** | Whether or not to build pull requests. |
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. |
**id** | **string** | The identifier of BitbucketServerIntegration | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
