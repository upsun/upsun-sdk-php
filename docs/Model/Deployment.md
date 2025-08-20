# # Deployment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**created_at** | **\DateTime** |  | [optional]
**updated_at** | **\DateTime** |  | [optional]
**fingerprint** | **string** |  | [optional]
**cluster_name** | **string** |  |
**project_info** | [**\Upsun\Model\ProjectInfo**](ProjectInfo.md) |  |
**environment_info** | [**\Upsun\Model\EnvironmentInfo**](EnvironmentInfo.md) |  |
**deployment_target** | **string** |  |
**vpn** | [**\Upsun\Model\VPNConfiguration**](VPNConfiguration.md) |  |
**http_access** | [**\Upsun\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enable_smtp** | **bool** |  |
**restrict_robots** | **bool** |  |
**variables** | [**\Upsun\Model\TheVariablesApplyingToThisEnvironmentInner[]**](TheVariablesApplyingToThisEnvironmentInner.md) |  |
**access** | [**\Upsun\Model\AccessControlDefinitionForThisEnviromentInner[]**](AccessControlDefinitionForThisEnviromentInner.md) |  |
**subscription** | [**\Upsun\Model\Subscription1**](Subscription1.md) |  |
**services** | [**array<string,\Upsun\Model\ServicesValue>**](ServicesValue.md) |  |
**routes** | [**array<string,\Upsun\Model\RoutesValue>**](RoutesValue.md) |  |
**webapps** | [**array<string,\Upsun\Model\WebApplicationsValue>**](WebApplicationsValue.md) |  |
**workers** | [**array<string,\Upsun\Model\WorkersValue>**](WorkersValue.md) |  |
**container_profiles** | **array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>>** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
