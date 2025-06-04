# # OrganizationInvitation

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the invitation. | [optional]
**state** | **string** | The invitation state. | [optional]
**organization_id** | **string** | The ID of the organization. | [optional]
**email** | **string** | The email address of the invitee. | [optional]
**owner** | [**\OpenAPI\Client\Model\OrganizationInvitationOwner**](OrganizationInvitationOwner.md) |  | [optional]
**created_at** | **\DateTime** | The date and time when the invitation was created. | [optional]
**updated_at** | **\DateTime** | The date and time when the invitation was last updated. | [optional]
**finished_at** | **\DateTime** | The date and time when the invitation was finished. | [optional]
**permissions** | **string[]** | The permissions the invitee should be given on the organization. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
