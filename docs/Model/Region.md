# # Region

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the region. | [optional]
**label** | **string** | The human-readable name of the region. | [optional]
**zone** | **string** | Geographical zone of the region | [optional]
**selection_label** | **string** | The label to display when choosing between regions for new projects. | [optional]
**project_label** | **string** | The label to display on existing projects. | [optional]
**timezone** | **string** | Default timezone of the region | [optional]
**available** | **bool** | Indicator whether or not this region is selectable during the checkout. Not available regions will never show up during checkout. | [optional]
**private** | **bool** | Indicator whether or not this platform is for private use only. | [optional]
**endpoint** | **string** | Link to the region API endpoint. | [optional]
**provider** | [**\Upsun\Model\RegionProvider**](RegionProvider.md) |  | [optional]
**datacenter** | [**\Upsun\Model\RegionDatacenter**](RegionDatacenter.md) |  | [optional]
**environmental_impact** | [**\Upsun\Model\RegionEnvironmentalImpact**](RegionEnvironmentalImpact.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
