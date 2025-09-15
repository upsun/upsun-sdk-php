# # ProjectInvitation

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the invitation. | [optional]
**state** | **string** | The invitation state. | [optional]
**projectId** | **string** | The ID of the project. | [optional]
**role** | **string** | The project role. | [optional]
**email** | **string** | The email address of the invitee. | [optional]
**owner** | [**\Upsun\Model\OrganizationInvitationOwner**](OrganizationInvitationOwner.md) |  | [optional]
**createdAt** | **\DateTime** | The date and time when the invitation was created. | [optional]
**updatedAt** | **\DateTime** | The date and time when the invitation was last updated. | [optional]
**finishedAt** | **\DateTime** | The date and time when the invitation was finished. | [optional]
**environments** | [**\Upsun\Model\ProjectInvitationEnvironmentsInner[]**](ProjectInvitationEnvironmentsInner.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
