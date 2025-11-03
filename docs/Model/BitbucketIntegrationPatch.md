# # BitbucketIntegrationPatch

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**repository** | **string** | The Bitbucket repository (in the form &#x60;user/repo&#x60;). |
**fetchBranches** | **bool** | Whether or not to fetch branches. | [optional]
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). | [optional]
**environmentInitResources** | **string** | The resources used when initializing a new service | [optional]
**appCredentials** | [**\Upsun\Model\OAuth2Consumer1**](OAuth2Consumer1.md) |  | [optional]
**addonCredentials** | [**\Upsun\Model\AddonCredential1**](AddonCredential1.md) |  | [optional]
**buildPullRequests** | **bool** | Whether or not to build pull requests. | [optional]
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. | [optional]
**resyncPullRequests** | **bool** | Whether or not pull request environment data should be re-synced on every build. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
