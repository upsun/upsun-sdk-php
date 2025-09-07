# # Discount

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the organization discount. | [optional]
**organizationId** | **string** | The ULID of the organization the discount applies to. | [optional]
**type** | **string** | The machine name of the discount type. | [optional]
**typeLabel** | **string** | The label of the discount type. | [optional]
**status** | **string** | The status of the discount. | [optional]
**commitment** | [**\Upsun\Model\DiscountCommitment**](DiscountCommitment.md) |  | [optional]
**totalMonths** | **int** | The contract length in months (if applicable). | [optional]
**discount** | [**\Upsun\Model\DiscountDiscount**](DiscountDiscount.md) |  | [optional]
**config** | **object** | The discount type specific configuration. | [optional]
**startAt** | **\DateTime** | The start time of the discount period. | [optional]
**endAt** | **\DateTime** | The end time of the discount period (if applicable). | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
