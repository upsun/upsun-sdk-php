# # Deployment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of Deployment |
**clusterName** | **string** | The name of the cluster |
**projectInfo** | [**\Upsun\Model\ProjectInfo**](ProjectInfo.md) |  |
**environmentInfo** | [**\Upsun\Model\EnvironmentInfo**](EnvironmentInfo.md) |  |
**deploymentTarget** | **string** | The deployment target |
**vpn** | [**\Upsun\Model\VPNConfiguration**](VPNConfiguration.md) |  |
**httpAccess** | [**\Upsun\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enableSmtp** | **bool** | Whether to configure SMTP for this environment |
**restrictRobots** | **bool** | Whether to restrict robots for this environment |
**variables** | [**\Upsun\Model\EnvironmentVariablesInner[]**](EnvironmentVariablesInner.md) | The variables applying to this environment |
**access** | [**\Upsun\Model\AccessControlInner[]**](AccessControlInner.md) | Access control definition for this enviroment |
**subscription** | [**\Upsun\Model\Subscription1**](Subscription1.md) |  |
**services** | [**array<string,\Upsun\Model\ServicesValue>**](ServicesValue.md) | The services |
**routes** | [**array<string,\Upsun\Model\RoutesValue>**](RoutesValue.md) | The routes |
**webapps** | [**array<string,\Upsun\Model\WebApplicationsValue>**](WebApplicationsValue.md) | The Web applications |
**workers** | [**array<string,\Upsun\Model\WorkersValue>**](WorkersValue.md) | The workers |
**containerProfiles** | **array<string,array<string,\Upsun\Model\ContainerProfilesValueValue>>** | The profiles of the containers |
**createdAt** | **\DateTime** | The creation date of the deployment | [optional]
**updatedAt** | **\DateTime** | The update date of the deployment | [optional]
**fingerprint** | **string** | The fingerprint of the deployment | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
