# # WorkersValue

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
**worker** | [**\OpenAPI\Client\Model\ConfigurationOfAWorkerContainerInstance**](ConfigurationOfAWorkerContainerInstance.md) |  |
**app** | **string** |  |
**stack** | **object[]** |  |
**instance_count** | **int** |  |
**slug_id** | **string** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
