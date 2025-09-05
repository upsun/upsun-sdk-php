# # WebApplicationsValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**resources** | [**\Upsun\Model\Resources**](Resources.md) |  |
**size** | **string** |  |
**disk** | **int** |  |
**access** | **array<string,string>** |  |
**relationships** | [**array<string,\Upsun\Model\TheRelationshipsOfTheApplicationToDefinedServicesValue>**](TheRelationshipsOfTheApplicationToDefinedServicesValue.md) |  |
**additionalHosts** | **array<string,string>** |  |
**mounts** | [**array<string,\Upsun\Model\FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue>**](FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue.md) |  |
**timezone** | **string** |  |
**variables** | **array<string,array<string,mixed>>** |  |
**firewall** | [**\Upsun\Model\Firewall**](Firewall.md) |  |
**containerProfile** | **string** |  |
**operations** | [**array<string,\Upsun\Model\OperationsThatCanBeTriggeredOnThisApplicationValue>**](OperationsThatCanBeTriggeredOnThisApplicationValue.md) |  |
**name** | **string** |  |
**type** | **string** |  |
**preflight** | [**\Upsun\Model\ConfigurationForPreFlightChecks**](ConfigurationForPreFlightChecks.md) |  |
**treeId** | **string** |  |
**appDir** | **string** |  |
**endpoints** | **object** |  |
**runtime** | **object** |  |
**web** | [**\Upsun\Model\ConfigurationForAccessingThisApplicationViaHTTP**](ConfigurationForAccessingThisApplicationViaHTTP.md) |  |
**hooks** | [**\Upsun\Model\HooksExecutedAtVariousPointInTheLifecycleOfTheApplication**](HooksExecutedAtVariousPointInTheLifecycleOfTheApplication.md) |  |
**crons** | [**array<string,\Upsun\Model\ScheduledCronTasksExecutedByThisApplicationValue>**](ScheduledCronTasksExecutedByThisApplicationValue.md) |  |
**source** | [**\Upsun\Model\ConfigurationRelatedToTheSourceCodeOfTheApplication**](ConfigurationRelatedToTheSourceCodeOfTheApplication.md) |  |
**build** | [**\Upsun\Model\TheBuildConfigurationOfTheApplication**](TheBuildConfigurationOfTheApplication.md) |  |
**dependencies** | **array<string,object>** |  |
**stack** | **object[]** |  |
**isAcrossSubmodule** | **bool** |  |
**instanceCount** | **int** |  |
**configId** | **string** |  |
**slugId** | **string** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
