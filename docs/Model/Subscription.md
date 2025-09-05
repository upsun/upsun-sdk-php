# # Subscription

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The internal ID of the subscription. | [optional]
**status** | **string** | The status of the subscription. | [optional]
**createdAt** | **\DateTime** | The date and time when the subscription was created. | [optional]
**updatedAt** | **\DateTime** | The date and time when the subscription was last updated. | [optional]
**owner** | **string** | The UUID of the owner. | [optional]
**ownerInfo** | [**\Upsun\Model\OwnerInfo**](OwnerInfo.md) |  | [optional]
**vendor** | **string** | The machine name of the vendor the subscription belongs to. | [optional]
**plan** | **string** | The plan type of the subscription. | [optional]
**environments** | **int** | The number of environments which can be provisioned on the project. | [optional]
**storage** | **int** | The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values. | [optional]
**userLicenses** | **int** | The number of chargeable users who currently have access to the project. Manage this value by adding and removing users through the Platform project API. Staff and billing/administrative contacts can be added to a project for no charge. Contact support for questions about user licenses. | [optional]
**projectId** | **string** | The unique ID string of the project. | [optional]
**projectEndpoint** | **string** | The project API endpoint for the project. | [optional]
**projectTitle** | **string** | The name given to the project. Appears as the title in the UI. | [optional]
**projectRegion** | **string** | The machine name of the region where the project is located. Cannot be changed after project creation. | [optional]
**projectRegionLabel** | **string** | The human-readable name of the region where the project is located. | [optional]
**projectUi** | **string** | The URL for the project&#39;s user interface. | [optional]
**projectOptions** | [**\Upsun\Model\ProjectOptions**](ProjectOptions.md) |  | [optional]
**agencySite** | **bool** | True if the project is an agency site. | [optional]
**invoiced** | **bool** | Whether the subscription is invoiced. | [optional]
**hipaa** | **bool** | Whether the project is marked as HIPAA. | [optional]
**isTrialPlan** | **bool** | Whether the project is currently on a trial plan. | [optional]
**services** | **object[]** | Details of the attached services. | [optional]
**green** | **bool** | Whether the subscription is considered green (on a green region, belonging to a green vendor) for billing purposes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
