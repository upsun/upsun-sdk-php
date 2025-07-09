# # InvoicePDF

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**url** | **string** | A link to the PDF invoice. | [optional]
**status** | **string** | The status of the PDF document. We generate invoice PDF asyncronously in batches. An invoice PDF document may not be immediately available to download. If status is &#39;ready&#39;, the PDF is ready to download. &#39;pending&#39; means the PDF is not created but queued up. If you get this status, try again later. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
