# # LineItem

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of line item. | [optional]
**product** | **string** | Display name of the line item product. | [optional]
**total** | **float** | Total price as a decimal. | [optional]
**total_formatted** | **string** | Total price, formatted with currency. | [optional]
**components** | [**array<string,\OpenAPI\Client\Model\LineItemComponent>**](LineItemComponent.md) | The price components for the line item, keyed by type. | [optional]
**exclude_from_invoice** | **bool** | Line item should not be considered billable. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
