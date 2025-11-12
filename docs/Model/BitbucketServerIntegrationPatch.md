# # BitbucketServerIntegrationPatch

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**url** | **string** | The base URL of the Bitbucket Server installation. |
**username** | **string** | The Bitbucket Server user. |
**token** | **string** | The Bitbucket Server personal access token. |
**project** | **string** | The Bitbucket Server project |
**repository** | **string** | The Bitbucket Server repository |
**fetchBranches** | **bool** | Whether or not to fetch branches. | [optional]
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). | [optional]
**environmentInitResources** | **string** | The resources used when initializing a new service | [optional]
**buildPullRequests** | **bool** | Whether or not to build pull requests. | [optional]
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
