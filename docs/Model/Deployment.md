# # Deployment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**clusterName** | **string** |  |
**projectInfo** | [**\Upsun\Model\ProjectInfo**](ProjectInfo.md) |  |
**environmentInfo** | [**\Upsun\Model\EnvironmentInfo**](EnvironmentInfo.md) |  |
**deploymentTarget** | **string** |  |
**vpn** | [**\Upsun\Model\VPNConfiguration**](VPNConfiguration.md) |  |
**httpAccess** | [**\Upsun\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enableSmtp** | **bool** |  |
**restrictRobots** | **bool** |  |
**variables** | [**\Upsun\Model\TheVariablesApplyingToThisEnvironmentInner[]**](TheVariablesApplyingToThisEnvironmentInner.md) |  |
**access** | [**\Upsun\Model\AccessControlDefinitionForThisEnviromentInner[]**](AccessControlDefinitionForThisEnviromentInner.md) |  |
**subscription** | [**\Upsun\Model\Subscription1**](Subscription1.md) |  |
**services** | [**array<string,\Upsun\Model\ServicesValue>**](ServicesValue.md) |  |
**routes** | [**array<string,\Upsun\Model\RoutesValue>**](RoutesValue.md) |  |
**webapps** | [**array<string,\Upsun\Model\WebApplicationsValue>**](WebApplicationsValue.md) |  |
**workers** | [**array<string,\Upsun\Model\WorkersValue>**](WorkersValue.md) |  |
**containerProfiles** | **array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>>** |  |
**id** | **string** |  |
**createdAt** | **\DateTime** |  | [optional]
**updatedAt** | **\DateTime** |  | [optional]
**fingerprint** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
