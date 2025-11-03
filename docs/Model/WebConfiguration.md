# # WebConfiguration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**locations** | [**array<string,\Upsun\Model\WebLocationsValue>**](WebLocationsValue.md) | The specification of the web locations served by this application. |
**moveToRoot** | **bool** | Whether to move the whole root of the app to the document root. |
**commands** | [**\Upsun\Model\Commands1**](Commands1.md) |  | [optional]
**upstream** | [**\Upsun\Model\UpstreamConfiguration**](UpstreamConfiguration.md) |  | [optional]
**documentRoot** | **string** | The document root of this application, relative to its root. | [optional]
**passthru** | **string** | The URL to use as a passthru if a file doesn&#39;t match the whitelist. | [optional]
**indexFiles** | **string[]** | Files to look for to serve directories. | [optional]
**whitelist** | **string[]** | Whitelisted entries. | [optional]
**blacklist** | **string[]** | Blacklisted entries. | [optional]
**expires** | **string** | Amount of time to cache static assets. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
