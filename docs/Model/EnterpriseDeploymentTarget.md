# # EnterpriseDeploymentTarget

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of the deployment target. |
**name** | **string** | The name of the deployment target. |
**deployHost** | **string** | The host to deploy to. |
**docroots** | [**array<string,\Upsun\Model\DocrootsValue>**](DocrootsValue.md) | Mapping of clusters to Enterprise applications |
**siteUrls** | **object** |  |
**sshHosts** | **string[]** | List of SSH Hosts. |
**maintenanceMode** | **bool** | Whether to perform deployments or not |
**id** | **string** | The identifier of EnterpriseDeploymentTarget | [optional]
**enterpriseEnvironmentsMapping** | **object** | Mapping of clusters to Enterprise applications | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
