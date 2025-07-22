# # Ticket

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**ticket_id** | **int** | The ID of the ticket. | [optional]
**created** | **\DateTime** | The time when the support ticket was created. | [optional]
**updated** | **\DateTime** | The time when the support ticket was updated. | [optional]
**type** | **string** | A type of the ticket. | [optional]
**subject** | **string** | A title of the ticket. | [optional]
**description** | **string** | The description body of the support ticket. | [optional]
**priority** | **string** | A priority of the ticket. | [optional]
**followup_tid** | **string** | Followup ticket ID. The unique ID of the ticket which this ticket is a follow-up to. | [optional]
**status** | **string** | The status of the support ticket. | [optional]
**recipient** | **string** | Email address of the ticket recipient, defaults to support@platform.sh. | [optional]
**requester_id** | **string** | UUID of the ticket requester. | [optional]
**submitter_id** | **string** | UUID of the ticket submitter. | [optional]
**assignee_id** | **string** | UUID of the ticket assignee. | [optional]
**organization_id** | **string** | A reference id that is usable to find the commerce license. | [optional]
**collaborator_ids** | **string[]** | A list of the collaborators uuids for this ticket. | [optional]
**has_incidents** | **bool** | Whether or not this ticket has incidents. | [optional]
**due** | **\DateTime** | A time that the ticket is due at. | [optional]
**tags** | **string[]** | A list of tags assigned to the ticket. | [optional]
**subscription_id** | **string** | The internal ID of the subscription. | [optional]
**ticket_group** | **string** | Maps to zendesk field &#39;Request group&#39;. | [optional]
**support_plan** | **string** | Maps to zendesk field &#39;The support plan associated with this ticket. | [optional]
**affected_url** | **string** | The affected URL associated with the support ticket. | [optional]
**queue** | **string** | The queue the support ticket is in. | [optional]
**issue_type** | **string** | The issue type of the support ticket. | [optional]
**resolution_time** | **\DateTime** | Maps to zendesk field &#39;Resolution Time&#39;. | [optional]
**response_time** | **\DateTime** | Maps to zendesk field &#39;Response Time (time from request to reply). | [optional]
**project_url** | **string** | Maps to zendesk field &#39;Project URL&#39;. | [optional]
**region** | **string** | Maps to zendesk field &#39;Region&#39;. | [optional]
**category** | **string** | Maps to zendesk field &#39;Category&#39;. | [optional]
**environment** | **string** | Maps to zendesk field &#39;Environment&#39;. | [optional]
**ticket_sharing_status** | **string** | Maps to zendesk field &#39;Ticket Sharing Status&#39;. | [optional]
**application_ticket_url** | **string** | Maps to zendesk field &#39;Application Ticket URL&#39;. | [optional]
**infrastructure_ticket_url** | **string** | Maps to zendesk field &#39;Infrastructure Ticket URL&#39;. | [optional]
**jira** | [**\OpenAPI\Client\Model\TicketJiraInner[]**](TicketJiraInner.md) | A list of JIRA issues related to the support ticket. | [optional]
**zd_ticket_url** | **string** | URL to the customer-facing ticket in Zendesk. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
