# # SyslogIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs | [optional]
**host** | **string** | Syslog relay/collector host | [optional]
**port** | **int** | Syslog relay/collector port | [optional]
**protocol** | **string** | Transport protocol | [optional]
**facility** | **int** | Syslog facility | [optional]
**messageFormat** | **string** | Syslog message format | [optional]
**authToken** | **string** |  | [optional]
**authMode** | **string** |  | [optional]
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification | [optional]
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
