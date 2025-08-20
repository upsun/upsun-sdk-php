# # CurrentUserProjectsInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The unique ID string of the project. | [optional]
**name** | **string** | The name given to the project. Appears as the title in the user interface. | [optional]
**title** | **string** | The name given to the project. Appears as the title in the user interface. | [optional]
**cluster** | **string** | The machine name of the region where the project is located. Cannot be changed after project creation. | [optional]
**cluster_label** | **string** | The human-readable name of the region where the project is located. | [optional]
**region** | **string** | The machine name of the region where the project is located. Cannot be changed after project creation. | [optional]
**region_label** | **string** | The human-readable name of the region where the project is located. | [optional]
**uri** | **string** | The URL for the project&#39;s user interface. | [optional]
**endpoint** | **string** | The project API endpoint for the project. | [optional]
**license_id** | **int** | The ID of the subscription. | [optional]
**owner** | **string** | The UUID of the owner. | [optional]
**owner_info** | [**\Upsun\Model\OwnerInfo**](OwnerInfo.md) |  | [optional]
**plan** | **string** | The plan type of the subscription. | [optional]
**subscription_id** | **int** | The ID of the subscription. | [optional]
**status** | **string** | The status of the project. | [optional]
**vendor** | **string** | The machine name of the vendor the subscription belongs to. | [optional]
**vendor_label** | **string** | The machine name of the vendor the subscription belongs to. | [optional]
**vendor_website** | **string** | The URL of the vendor the subscription belongs to. | [optional]
**vendor_resources** | **string** | The link to the resources of the vendor the subscription belongs to. | [optional]
**created_at** | **\DateTime** | The creation date of the subscription. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
