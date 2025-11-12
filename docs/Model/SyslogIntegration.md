# # SyslogIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs |
**host** | **string** | Syslog relay/collector host |
**port** | **int** | Syslog relay/collector port |
**protocol** | **string** | Transport protocol |
**facility** | **int** | Syslog facility |
**messageFormat** | **string** | Syslog message format |
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification |
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging |
**id** | **string** | The identifier of SyslogIntegration | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
