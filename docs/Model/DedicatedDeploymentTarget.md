# # DedicatedDeploymentTarget

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of the deployment target. |
**name** | **string** | The name of the deployment target. |
**deployHost** | **string** | The host to deploy to. |
**deployPort** | **int** | The port to deploy to. |
**sshHost** | **string** | The host to use to SSH to app containers. |
**hosts** | [**\Upsun\Model\HostsInner[]**](HostsInner.md) | The hosts of the deployment target. |
**autoMounts** | **bool** | Whether to take application mounts from the pushed data or the deployment target. |
**excludedMounts** | **string[]** | Directories that should not be mounted |
**enforcedMounts** | **object** | Mounts which are always injected into pushed (e.g. enforce /var/log to be a local mount). |
**autoCrons** | **bool** | Whether to take application crons from the pushed data or the deployment target. |
**autoNginx** | **bool** | Whether to take application crons from the pushed data or the deployment target. |
**maintenanceMode** | **bool** | Whether to perform deployments or not |
**guardrailsPhase** | **int** | which phase of guardrails are we in |
**id** | **string** | The identifier of DedicatedDeploymentTarget | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
