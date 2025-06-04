# # Profile

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The user&#39;s unique ID. | [optional]
**display_name** | **string** | The user&#39;s display name. | [optional]
**email** | **string** | The user&#39;s email address. | [optional]
**username** | **string** | The user&#39;s username. | [optional]
**type** | **string** | The user&#39;s type (user/organization). | [optional]
**picture** | **string** | The URL of the user&#39;s picture. | [optional]
**company_type** | **string** | The company type. | [optional]
**company_name** | **string** | The name of the company. | [optional]
**currency** | **string** | A 3-letter ISO 4217 currency code (assigned according to the billing address). | [optional]
**vat_number** | **string** | The vat number of the user. | [optional]
**company_role** | **string** | The role of the user in the company. | [optional]
**website_url** | **string** | The user or company website. | [optional]
**new_ui** | **bool** | Whether the new UI features are enabled for this user. | [optional]
**ui_colorscheme** | **string** | The user&#39;s chosen color scheme for user interfaces. | [optional]
**default_catalog** | **string** | The URL of a catalog file which overrides the default. | [optional]
**project_options_url** | **string** | The URL of an account-wide project options file. | [optional]
**marketing** | **bool** | Flag if the user agreed to receive marketing communication. | [optional]
**created_at** | **\DateTime** | The timestamp representing when the user account was created. | [optional]
**updated_at** | **\DateTime** | The timestamp representing when the user account was last modified. | [optional]
**billing_contact** | **string** | The e-mail address of a contact to whom billing notices will be sent. | [optional]
**security_contact** | **string** | The e-mail address of a contact to whom security notices will be sent. | [optional]
**current_trial** | [**\OpenAPI\Client\Model\ProfileCurrentTrial**](ProfileCurrentTrial.md) |  | [optional]
**invoiced** | **bool** | The customer is invoiced. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
