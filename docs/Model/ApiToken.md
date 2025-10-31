# # ApiToken

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the token. | [optional]
**name** | **string** | The token name. | [optional]
**mfaOnCreation** | **bool** | Whether the user had multi-factor authentication (MFA) enabled when they created the token. | [optional]
**token** | **string** | The token in plain text (available only when created). | [optional]
**createdAt** | **\DateTime** | The date and time when the token was created. | [optional]
**updatedAt** | **\DateTime** | The date and time when the token was last updated. | [optional]
**lastUsedAt** | **\DateTime** | The date and time when the token was last exchanged for an access token. This will be &lt;code&gt;null&lt;/code&gt; for a token which has never been used, or not used since this API property was added. &lt;strong&gt;Note:&lt;/strong&gt; After an API token is used, the derived access token may continue to be used until its expiry. This also applies to SSH certificate(s) derived from the access token. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
