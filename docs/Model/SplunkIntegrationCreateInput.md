# # SplunkIntegrationCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**url** | **string** | The Splunk HTTP Event Connector REST API endpoint |
**index** | **string** | The Splunk Index |
**token** | **string** | The Splunk Authorization Token |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs | [optional]
**sourcetype** | **string** | The event &#39;sourcetype&#39; | [optional]
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification | [optional]
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
