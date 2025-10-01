# # AutoscalerAlertPartial

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | User friendly name for the alert |
**service** | **string** | Service for which the alert was received |
**condition** | **string** | Comparison condition to use when evaluating the alert |
**threshold** | **float** | Value that has to be crossed for the alert to be considered triggered |
**value** | **float** | Current value for the received alert |
**environment** | **string** | Environment for which the alert was received | [optional]
**resource** | **string** | Name of resource that triggered the alert | [optional]
**duration** | [**array<string,\Upsun\Model\AutoscalerDuration>**](AutoscalerDuration.md) | Number of seconds during which the condition was satisfied | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
