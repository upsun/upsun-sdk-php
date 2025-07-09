# # Deployment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**created_at** | **\DateTime** |  | [optional]
**updated_at** | **\DateTime** |  | [optional]
**fingerprint** | **string** |  | [optional]
**cluster_name** | **string** |  |
**project_info** | [**\OpenAPI\Client\Model\ProjectInfo**](ProjectInfo.md) |  |
**environment_info** | [**\OpenAPI\Client\Model\EnvironmentInfo**](EnvironmentInfo.md) |  |
**deployment_target** | **string** |  |
**vpn** | [**\OpenAPI\Client\Model\VPNConfiguration**](VPNConfiguration.md) |  |
**http_access** | [**\OpenAPI\Client\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enable_smtp** | **bool** |  |
**restrict_robots** | **bool** |  |
**variables** | [**\OpenAPI\Client\Model\TheVariablesApplyingToThisEnvironmentInner[]**](TheVariablesApplyingToThisEnvironmentInner.md) |  |
**access** | [**\OpenAPI\Client\Model\AccessControlDefinitionForThisEnviromentInner[]**](AccessControlDefinitionForThisEnviromentInner.md) |  |
**subscription** | [**\OpenAPI\Client\Model\Subscription1**](Subscription1.md) |  |
**services** | [**array<string,\OpenAPI\Client\Model\ServicesValue>**](ServicesValue.md) |  |
**routes** | [**array<string,\OpenAPI\Client\Model\RoutesValue>**](RoutesValue.md) |  |
**webapps** | [**array<string,\OpenAPI\Client\Model\WebApplicationsValue>**](WebApplicationsValue.md) |  |
**workers** | [**array<string,\OpenAPI\Client\Model\WorkersValue>**](WorkersValue.md) |  |
**container_profiles** | **array<string,array<string,\OpenAPI\Client\Model\ContainerProfilesValueValue>>** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
