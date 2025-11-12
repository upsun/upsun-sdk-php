# # HttpLogIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**url** | **string** |  |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs | [optional]
**headers** | **array<string,string>** | HTTP headers to use in POST requests | [optional]
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification | [optional]
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
