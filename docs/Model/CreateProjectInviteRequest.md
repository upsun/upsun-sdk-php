# # CreateProjectInviteRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**email** | **string** | The email address of the invitee. |
**role** | **string** | The role the invitee should be given on the project. | [optional]
**permissions** | [**\Upsun\Model\CreateProjectInviteRequestPermissionsInner[]**](CreateProjectInviteRequestPermissionsInner.md) | Specifying the role on each environment type. | [optional]
**environments** | [**\Upsun\Model\CreateProjectInviteRequestEnvironmentsInner[]**](CreateProjectInviteRequestEnvironmentsInner.md) | (Deprecated, use permissions instead) Specifying the role on each environment. | [optional]
**force** | **bool** | Whether to cancel any pending invitation for the specified invitee, and create a new invitation. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
