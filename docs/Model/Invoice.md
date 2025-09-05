# # Invoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The invoice id. | [optional]
**invoiceNumber** | **string** | The invoice number. | [optional]
**type** | **string** | Invoice type. | [optional]
**orderId** | **string** | The id of the related order. | [optional]
**relatedInvoiceId** | **string** | If the invoice is a credit memo (type&#x3D;credit_memo), this field stores the id of the related/original invoice. | [optional]
**status** | **string** | The invoice status. | [optional]
**owner** | **string** | The ULID of the owner. | [optional]
**invoiceDate** | **\DateTime** | The invoice date. | [optional]
**invoiceDue** | **\DateTime** | The invoice due date. | [optional]
**created** | **\DateTime** | The time when the invoice was created. | [optional]
**changed** | **\DateTime** | The time when the invoice was changed. | [optional]
**company** | **string** | Company name (if any). | [optional]
**total** | **float** | The invoice total. | [optional]
**address** | [**\Upsun\Model\Address**](Address.md) |  | [optional]
**notes** | **string** | The invoice note. | [optional]
**invoicePdf** | [**\Upsun\Model\InvoicePDF**](InvoicePDF.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
