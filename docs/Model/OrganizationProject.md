# # OrganizationProject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the project. | [optional]
**organizationId** | **string** | The ID of the organization. | [optional]
**subscriptionId** | **string** | The ID of the subscription. | [optional]
**vendor** | **string** | Vendor of the project. | [optional]
**region** | **string** | The machine name of the region where the project is located. | [optional]
**title** | **string** | The title of the project. | [optional]
**type** | [**\Upsun\Model\ProjectType**](ProjectType.md) |  | [optional]
**plan** | **string** | The project plan. | [optional]
**timezone** | **string** | Timezone of the project. | [optional]
**defaultBranch** | **string** | Default branch. | [optional]
**status** | [**\Upsun\Model\ProjectStatus**](ProjectStatus.md) |  | [optional]
**trialPlan** | **bool** | Whether the project is currently on a trial plan. | [optional]
**projectUi** | **string** | The URL for the project&#39;s user interface. | [optional]
**locked** | **bool** | Locked | [optional]
**cseNotes** | **string** | CSE notes. | [optional]
**dedicatedTag** | **string** | Dedicated tag. | [optional]
**createdAt** | **\DateTime** | The date and time when the resource was created. | [optional]
**updatedAt** | **\DateTime** | The date and time when the resource was last updated. | [optional]
**links** | [**\Upsun\Model\OrganizationProjectLinks**](OrganizationProjectLinks.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
