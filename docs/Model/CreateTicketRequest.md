# # CreateTicketRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**subject** | **string** | A title of the ticket. |
**description** | **string** | The description body of the support ticket. |
**requester_id** | **string** | UUID of the ticket requester. Converted from the ZID value. | [optional]
**priority** | **string** | A priority of the ticket. | [optional]
**subscription_id** | **string** | see create() | [optional]
**organization_id** | **string** | see create() | [optional]
**affected_url** | **string** | see create(). | [optional]
**followup_tid** | **string** | The unique ID of the ticket which this ticket is a follow-up to. | [optional]
**category** | **string** | The category of the support ticket. | [optional]
**attachments** | [**\Upsun\Model\CreateTicketRequestAttachmentsInner[]**](CreateTicketRequestAttachmentsInner.md) | A list of attachments for the ticket. | [optional]
**collaborator_ids** | **string[]** | A list of collaborators uuids for the ticket. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
