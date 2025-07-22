# # WebApplicationsValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**resources** | [**\OpenAPI\Client\Model\Resources**](Resources.md) |  |
**size** | **string** |  |
**disk** | **int** |  |
**access** | **array<string,string>** |  |
**relationships** | [**array<string,\OpenAPI\Client\Model\TheRelationshipsOfTheApplicationToDefinedServicesValue>**](TheRelationshipsOfTheApplicationToDefinedServicesValue.md) |  |
**additional_hosts** | **array<string,string>** |  |
**mounts** | [**array<string,\OpenAPI\Client\Model\FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue>**](FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue.md) |  |
**timezone** | **string** |  |
**variables** | **array<string,array<string,mixed>>** |  |
**firewall** | [**\OpenAPI\Client\Model\Firewall**](Firewall.md) |  |
**container_profile** | **string** |  |
**operations** | [**array<string,\OpenAPI\Client\Model\OperationsThatCanBeTriggeredOnThisApplicationValue>**](OperationsThatCanBeTriggeredOnThisApplicationValue.md) |  |
**name** | **string** |  |
**type** | **string** |  |
**preflight** | [**\OpenAPI\Client\Model\ConfigurationForPreFlightChecks**](ConfigurationForPreFlightChecks.md) |  |
**tree_id** | **string** |  |
**app_dir** | **string** |  |
**endpoints** | **object** |  |
**runtime** | **object** |  |
**web** | [**\OpenAPI\Client\Model\ConfigurationForAccessingThisApplicationViaHTTP**](ConfigurationForAccessingThisApplicationViaHTTP.md) |  |
**hooks** | [**\OpenAPI\Client\Model\HooksExecutedAtVariousPointInTheLifecycleOfTheApplication**](HooksExecutedAtVariousPointInTheLifecycleOfTheApplication.md) |  |
**crons** | [**array<string,\OpenAPI\Client\Model\ScheduledCronTasksExecutedByThisApplicationValue>**](ScheduledCronTasksExecutedByThisApplicationValue.md) |  |
**source** | [**\OpenAPI\Client\Model\ConfigurationRelatedToTheSourceCodeOfTheApplication**](ConfigurationRelatedToTheSourceCodeOfTheApplication.md) |  |
**build** | [**\OpenAPI\Client\Model\TheBuildConfigurationOfTheApplication**](TheBuildConfigurationOfTheApplication.md) |  |
**dependencies** | **array<string,object>** |  |
**stack** | **object[]** |  |
**is_across_submodule** | **bool** |  |
**instance_count** | **int** |  |
**config_id** | **string** |  |
**slug_id** | **string** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
