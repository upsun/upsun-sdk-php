# # SumologicIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**url** | **string** |  |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs | [optional]
**category** | **string** | The Category used to easy filtering (sent as X-Sumo-Category header) | [optional]
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification | [optional]
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
