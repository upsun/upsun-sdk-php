# # WebLocationsValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**root** | **string** | The folder from which to serve static assets for this location relative to the application root. |
**expires** | **string** | Amount of time to cache static assets. |
**passthru** | **string** | Whether to forward disallowed and missing resources from this location to the application. On PHP, set to the PHP front controller script, as a URL fragment. Otherwise set to &#x60;true&#x60;/&#x60;false&#x60;. |
**scripts** | **bool** | Whether to execute scripts in this location (for script based runtimes). |
**allow** | **bool** | Whether to allow access to this location by default. |
**headers** | **array<string,string>** | A set of header fields set to the HTTP response. Applies only to static files, not responses from the application. |
**rules** | [**array<string,\Upsun\Model\SpecificOverridesValue>**](SpecificOverridesValue.md) | Specific overrides. |
**index** | **string[]** | Files to look for to serve directories. | [optional]
**requestBuffering** | [**\Upsun\Model\RequestBuffering**](RequestBuffering.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
