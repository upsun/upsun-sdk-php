# # PrepaymentObjectPrepayment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**organization_id** | **string** | Organization ID | [optional]
**balance** | [**\Upsun\Model\PrepaymentObjectPrepaymentBalance**](PrepaymentObjectPrepaymentBalance.md) |  | [optional]
**last_updated_at** | **string** | The date the prepayment balance was last updated. | [optional]
**sufficient** | **bool** | Whether the prepayment balance is enough to cover the upcoming order. | [optional]
**fallback** | **string** | The fallback payment method, if any, to be used in case prepayment balance is not enough to cover an order. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
