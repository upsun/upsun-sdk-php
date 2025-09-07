# # RegionReference

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The machine name of the region where the project is located. |
**label** | **string** | The human-readable name of the region. |
**zone** | **string** | The geographical zone of the region. |
**selectionLabel** | **string** | The label to display when choosing between regions for new projects. |
**projectLabel** | **string** | The label to display on existing projects. |
**timezone** | **string** | Default timezone of the region. |
**available** | **bool** | Indicator whether or not this region is selectable during the checkout. Not available regions will never show up during checkout. |
**endpoint** | **string** | Link to the region API endpoint. |
**provider** | **object** | Information about the region provider. |
**datacenter** | **object** | Information about the region provider data center. |
**compliance** | **object** | Information about the region&#39;s compliance. |
**createdAt** | **\DateTime** | The date and time when the resource was created. |
**updatedAt** | **\DateTime** | The date and time when the resource was last updated. |
**private** | **bool** | Indicator whether or not this platform is for private use only. | [optional]
**code** | **string** | The code of the region | [optional]
**envimpact** | **object** | Information about the region provider&#39;s environmental impact. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
