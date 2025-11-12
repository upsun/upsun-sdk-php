# # SpecificOverridesValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**expires** | **string** | Amount of time to cache static assets. | [optional]
**passthru** | **string** | Whether to forward disallowed and missing resources from this location to the application. On PHP, set to the PHP front controller script, as a URL fragment. Otherwise set to &#x60;true&#x60;/&#x60;false&#x60;. | [optional]
**scripts** | **bool** | Whether to execute scripts in this location (for script based runtimes). | [optional]
**allow** | **bool** | Whether to allow access to this location by default. | [optional]
**headers** | **array<string,string>** | A set of header fields set to the HTTP response. Replaces headers set on the location block. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
