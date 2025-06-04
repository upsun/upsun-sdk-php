# # UserReference

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the user. | [optional]
**username** | **string** | The user&#39;s username. | [optional]
**email** | **string** | The user&#39;s email address. | [optional]
**first_name** | **string** | The user&#39;s first name. | [optional]
**last_name** | **string** | The user&#39;s last name. | [optional]
**picture** | **string** | The user&#39;s picture. | [optional]
**mfa_enabled** | **bool** | Whether the user has enabled MFA. Note: the built-in MFA feature may not be necessary if the user is linked to a mandatory SSO provider that itself supports MFA (see \&quot;sso_enabled\\\&quot;). | [optional]
**sso_enabled** | **bool** | Whether the user is linked to a mandatory SSO provider. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
