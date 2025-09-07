# # Order

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the order. | [optional]
**status** | **string** | The status of the subscription. | [optional]
**owner** | **string** | The UUID of the owner. | [optional]
**address** | [**\Upsun\Model\Address**](Address.md) |  | [optional]
**company** | **string** | The company name. | [optional]
**vatNumber** | **string** | An identifier used in many countries for value added tax purposes. | [optional]
**billingPeriodStart** | **\DateTime** | The time when the billing period of the order started. | [optional]
**billingPeriodEnd** | **\DateTime** | The time when the billing period of the order ended. | [optional]
**billingPeriodLabel** | [**\Upsun\Model\OrderBillingPeriodLabel**](OrderBillingPeriodLabel.md) |  | [optional]
**billingPeriodDuration** | **int** | The duration of the billing period of the order in seconds. | [optional]
**paidOn** | **\DateTime** | The time when the order was successfully charged. | [optional]
**total** | **int** | The total of the order. | [optional]
**totalFormatted** | **int** | The total of the order, formatted with currency. | [optional]
**components** | [**\Upsun\Model\Components**](Components.md) |  | [optional]
**currency** | **string** | The order currency code. | [optional]
**invoiceUrl** | **string** | A link to the PDF invoice. | [optional]
**lastRefreshed** | **\DateTime** | The time when the order was last refreshed. | [optional]
**invoiced** | **bool** | The customer is invoiced. | [optional]
**lineItems** | [**\Upsun\Model\LineItem[]**](LineItem.md) | The line items that comprise the order. | [optional]
**links** | [**\Upsun\Model\OrderLinks**](OrderLinks.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
