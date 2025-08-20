# # Order

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the order. | [optional]
**status** | **string** | The status of the subscription. | [optional]
**owner** | **string** | The UUID of the owner. | [optional]
**address** | [**\Upsun\Model\Address**](Address.md) |  | [optional]
**company** | **string** | The company name. | [optional]
**vat_number** | **string** | An identifier used in many countries for value added tax purposes. | [optional]
**billing_period_start** | **\DateTime** | The time when the billing period of the order started. | [optional]
**billing_period_end** | **\DateTime** | The time when the billing period of the order ended. | [optional]
**billing_period_label** | [**\Upsun\Model\OrderBillingPeriodLabel**](OrderBillingPeriodLabel.md) |  | [optional]
**billing_period_duration** | **int** | The duration of the billing period of the order in seconds. | [optional]
**paid_on** | **\DateTime** | The time when the order was successfully charged. | [optional]
**total** | **int** | The total of the order. | [optional]
**total_formatted** | **int** | The total of the order, formatted with currency. | [optional]
**components** | [**\Upsun\Model\Components**](Components.md) |  | [optional]
**currency** | **string** | The order currency code. | [optional]
**invoice_url** | **string** | A link to the PDF invoice. | [optional]
**last_refreshed** | **\DateTime** | The time when the order was last refreshed. | [optional]
**invoiced** | **bool** | The customer is invoiced. | [optional]
**line_items** | [**\Upsun\Model\LineItem[]**](LineItem.md) | The line items that comprise the order. | [optional]
**_links** | [**\Upsun\Model\OrderLinks**](OrderLinks.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
