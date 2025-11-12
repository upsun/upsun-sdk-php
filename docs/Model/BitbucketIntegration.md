# # BitbucketIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**fetchBranches** | **bool** | Whether or not to fetch branches. |
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). |
**environmentInitResources** | **string** | The resources used when initializing a new service |
**repository** | **string** | The Bitbucket repository (in the form &#x60;user/repo&#x60;). |
**buildPullRequests** | **bool** | Whether or not to build pull requests. |
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. |
**resyncPullRequests** | **bool** | Whether or not pull request environment data should be re-synced on every build. |
**id** | **string** | The identifier of BitbucketIntegration | [optional]
**appCredentials** | [**\Upsun\Model\OAuth2Consumer**](OAuth2Consumer.md) |  | [optional]
**addonCredentials** | [**\Upsun\Model\AddonCredential**](AddonCredential.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
