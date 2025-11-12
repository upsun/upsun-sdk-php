# # LineItem

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of line item. | [optional]
**licenseId** | **float** | The associated subscription identifier. | [optional]
**projectId** | **string** | The associated project identifier. | [optional]
**product** | **string** | Display name of the line item product. | [optional]
**sku** | **string** | The line item product SKU. | [optional]
**total** | **float** | Total price as a decimal. | [optional]
**totalFormatted** | **string** | Total price, formatted with currency. | [optional]
**components** | [**array<string,\Upsun\Model\LineItemComponent>**](LineItemComponent.md) | The price components for the line item, keyed by type. | [optional]
**excludeFromInvoice** | **bool** | Line item should not be considered billable. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
