# # Invoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The invoice id. | [optional]
**invoice_number** | **string** | The invoice number. | [optional]
**type** | **string** | Invoice type. | [optional]
**order_id** | **string** | The id of the related order. | [optional]
**related_invoice_id** | **string** | If the invoice is a credit memo (type&#x3D;credit_memo), this field stores the id of the related/original invoice. | [optional]
**status** | **string** | The invoice status. | [optional]
**owner** | **string** | The ULID of the owner. | [optional]
**invoice_date** | **\DateTime** | The invoice date. | [optional]
**invoice_due** | **\DateTime** | The invoice due date. | [optional]
**created** | **\DateTime** | The time when the invoice was created. | [optional]
**changed** | **\DateTime** | The time when the invoice was changed. | [optional]
**company** | **string** | Company name (if any). | [optional]
**total** | **float** | The invoice total. | [optional]
**address** | [**\OpenAPI\Client\Model\Address**](Address.md) |  | [optional]
**notes** | **string** | The invoice note. | [optional]
**invoice_pdf** | [**\OpenAPI\Client\Model\InvoicePDF**](InvoicePDF.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
