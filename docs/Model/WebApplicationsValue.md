# # WebApplicationsValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**resources** | [**\Upsun\Model\Resources**](Resources.md) |  |
**size** | **string** | The container size for this application in production. Leave blank to allow it to be set dynamically. |
**disk** | **int** | The size of the disk. |
**access** | **array<string,string>** | Access information, a mapping between access type and roles. |
**relationships** | [**array<string,\Upsun\Model\ServiceRelationshipsValue>**](ServiceRelationshipsValue.md) | The relationships of the application to defined services. |
**additionalHosts** | **array<string,string>** | A mapping of hostname to ip address to be added to the container&#39;s hosts file |
**mounts** | [**array<string,\Upsun\Model\MountsValue>**](MountsValue.md) | Filesystem mounts of this application.  If not specified the application will have no writeable disk space. |
**timezone** | **string** | The timezone of the application.  This primarily affects the timezone in which cron tasks will run.  It will not affect the application itself. Defaults to UTC if not specified. |
**variables** | **array<string,array<string,mixed>>** | Variables provide environment-sensitive information to control how your application behaves.  To set a Unix environment variable, specify a key of &#x60;env:&#x60;, and then each sub-item of that is a key/value pair that will be injected into the environment. |
**firewall** | [**\Upsun\Model\Firewall**](Firewall.md) |  |
**containerProfile** | **string** | Selected container profile for the application |
**operations** | [**array<string,\Upsun\Model\OperationsValue>**](OperationsValue.md) | Operations that can be triggered on this application |
**name** | **string** | The name of the application. Must be unique within a project. |
**type** | **string** | The base runtime and version to use for this worker. |
**preflight** | [**\Upsun\Model\PreflightChecks**](PreflightChecks.md) |  |
**treeId** | **string** | The identifier of the source tree of the application |
**appDir** | **string** | The path of the application in the container |
**endpoints** | **object** |  |
**runtime** | **object** | Runtime-specific configuration. |
**web** | [**\Upsun\Model\WebConfiguration**](WebConfiguration.md) |  |
**hooks** | [**\Upsun\Model\Hooks**](Hooks.md) |  |
**crons** | [**array<string,\Upsun\Model\CronsValue>**](CronsValue.md) | Scheduled cron tasks executed by this application. |
**source** | [**\Upsun\Model\SourceCodeConfiguration**](SourceCodeConfiguration.md) |  |
**build** | [**\Upsun\Model\BuildConfiguration**](BuildConfiguration.md) |  |
**dependencies** | **array<string,object>** | External global dependencies of this application. They will be downloaded by the language&#39;s package manager. |
**stack** | **object[]** |  |
**isAcrossSubmodule** | **bool** | Is this application coming from a submodule |
**instanceCount** | **int** | Instance replication count of this application |
**configId** | **string** |  |
**slugId** | **string** | The identifier of the built artifact of the application |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
