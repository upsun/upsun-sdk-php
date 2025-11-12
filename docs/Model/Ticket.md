# # Ticket

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**ticketId** | **int** | The ID of the ticket. | [optional]
**created** | **\DateTime** | The time when the support ticket was created. | [optional]
**updated** | **\DateTime** | The time when the support ticket was updated. | [optional]
**type** | **string** | A type of the ticket. | [optional]
**subject** | **string** | A title of the ticket. | [optional]
**description** | **string** | The description body of the support ticket. | [optional]
**priority** | **string** | A priority of the ticket. | [optional]
**followupTid** | **string** | Followup ticket ID. The unique ID of the ticket which this ticket is a follow-up to. | [optional]
**status** | **string** | The status of the support ticket. | [optional]
**recipient** | **string** | Email address of the ticket recipient, defaults to support@upsun.com. | [optional]
**requesterId** | **string** | UUID of the ticket requester. | [optional]
**submitterId** | **string** | UUID of the ticket submitter. | [optional]
**assigneeId** | **string** | UUID of the ticket assignee. | [optional]
**organizationId** | **string** | A reference id that is usable to find the commerce license. | [optional]
**collaboratorIds** | **string[]** | A list of the collaborators uuids for this ticket. | [optional]
**hasIncidents** | **bool** | Whether or not this ticket has incidents. | [optional]
**due** | **\DateTime** | A time that the ticket is due at. | [optional]
**tags** | **string[]** | A list of tags assigned to the ticket. | [optional]
**subscriptionId** | **string** | The internal ID of the subscription. | [optional]
**ticketGroup** | **string** | Maps to zendesk field &#39;Request group&#39;. | [optional]
**supportPlan** | **string** | Maps to zendesk field &#39;The support plan associated with this ticket. | [optional]
**affectedUrl** | **string** | The affected URL associated with the support ticket. | [optional]
**queue** | **string** | The queue the support ticket is in. | [optional]
**issueType** | **string** | The issue type of the support ticket. | [optional]
**resolutionTime** | **\DateTime** | Maps to zendesk field &#39;Resolution Time&#39;. | [optional]
**responseTime** | **\DateTime** | Maps to zendesk field &#39;Response Time (time from request to reply). | [optional]
**projectUrl** | **string** | Maps to zendesk field &#39;Project URL&#39;. | [optional]
**region** | **string** | Maps to zendesk field &#39;Region&#39;. | [optional]
**category** | **string** | Maps to zendesk field &#39;Category&#39;. | [optional]
**environment** | **string** | Maps to zendesk field &#39;Environment&#39;. | [optional]
**ticketSharingStatus** | **string** | Maps to zendesk field &#39;Ticket Sharing Status&#39;. | [optional]
**applicationTicketUrl** | **string** | Maps to zendesk field &#39;Application Ticket URL&#39;. | [optional]
**infrastructureTicketUrl** | **string** | Maps to zendesk field &#39;Infrastructure Ticket URL&#39;. | [optional]
**jira** | [**\Upsun\Model\TicketJiraInner[]**](TicketJiraInner.md) | A list of JIRA issues related to the support ticket. | [optional]
**zdTicketUrl** | **string** | URL to the customer-facing ticket in Zendesk. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
