# # SplunkIntegration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs |
**url** | **string** | The Splunk HTTP Event Connector REST API endpoint |
**index** | **string** | The Splunk Index |
**sourcetype** | **string** | The event &#39;sourcetype&#39; |
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification |
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging |
**id** | **string** | The identifier of SplunkIntegration | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
