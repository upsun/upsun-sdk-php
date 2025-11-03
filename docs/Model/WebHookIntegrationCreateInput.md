# # WebHookIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**url** | **string** | The URL of the webhook |
**events** | **string[]** | Events to execute the hook on | [optional]
**environments** | **string[]** | The environments to execute the hook on | [optional]
**excludedEnvironments** | **string[]** | The environments to not execute the hook on | [optional]
**states** | **string[]** | Events to execute the hook on | [optional]
**result** | **string** | Result to execute the hook on | [optional]
**sharedKey** | **string** | The JWS shared secret key | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
