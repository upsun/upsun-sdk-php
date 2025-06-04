# # PlanRecords

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The unique ID of the plan record. | [optional]
**owner** | **string** | The UUID of the owner. | [optional]
**subscription_id** | **string** | The ID of the subscription this record pertains to. | [optional]
**sku** | **string** | The product SKU of the plan that this record represents. | [optional]
**plan** | **string** | The machine name of the plan that this record represents. | [optional]
**options** | **string[]** |  | [optional]
**start** | **\DateTime** | The start timestamp of this plan record (ISO 8601). | [optional]
**end** | **\DateTime** | The end timestamp of this plan record (ISO 8601). | [optional]
**status** | **string** | The status of the subscription during this record: active or suspended. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
