# # WorkersValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**resources** | [**\Upsun\Model\Resources**](Resources.md) |  |
**size** | **string** |  |
**disk** | **int** |  |
**access** | **array<string,string>** |  |
**relationships** | [**array<string,\Upsun\Model\TheRelationshipsOfTheApplicationToDefinedServicesValue>**](TheRelationshipsOfTheApplicationToDefinedServicesValue.md) |  |
**additional_hosts** | **array<string,string>** |  |
**mounts** | [**array<string,\Upsun\Model\FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue>**](FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue.md) |  |
**timezone** | **string** |  |
**variables** | **array<string,array<string,mixed>>** |  |
**firewall** | [**\Upsun\Model\Firewall**](Firewall.md) |  |
**container_profile** | **string** |  |
**operations** | [**array<string,\Upsun\Model\OperationsThatCanBeTriggeredOnThisApplicationValue>**](OperationsThatCanBeTriggeredOnThisApplicationValue.md) |  |
**name** | **string** |  |
**type** | **string** |  |
**preflight** | [**\Upsun\Model\ConfigurationForPreFlightChecks**](ConfigurationForPreFlightChecks.md) |  |
**tree_id** | **string** |  |
**app_dir** | **string** |  |
**endpoints** | **object** |  |
**runtime** | **object** |  |
**worker** | [**\Upsun\Model\ConfigurationOfAWorkerContainerInstance**](ConfigurationOfAWorkerContainerInstance.md) |  |
**app** | **string** |  |
**stack** | **object[]** |  |
**instance_count** | **int** |  |
**slug_id** | **string** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
