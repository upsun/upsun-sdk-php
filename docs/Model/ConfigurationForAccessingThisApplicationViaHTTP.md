# # ConfigurationForAccessingThisApplicationViaHTTP

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**locations** | [**array<string,\Upsun\Model\TheSpecificationOfTheWebLocationsServedByThisApplicationValue>**](TheSpecificationOfTheWebLocationsServedByThisApplicationValue.md) |  |
**commands** | [**\Upsun\Model\CommandsToManageTheApplicationSLifecycle**](CommandsToManageTheApplicationSLifecycle.md) |  | [optional]
**upstream** | [**\Upsun\Model\ConfigurationOnHowTheWebServerCommunicatesWithTheApplication**](ConfigurationOnHowTheWebServerCommunicatesWithTheApplication.md) |  | [optional]
**document_root** | **string** |  | [optional]
**passthru** | **string** |  | [optional]
**index_files** | **string[]** |  | [optional]
**whitelist** | **string[]** |  | [optional]
**blacklist** | **string[]** |  | [optional]
**expires** | **string** |  | [optional]
**move_to_root** | **bool** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
