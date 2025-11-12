# # FoundationDeploymentTargetCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of the deployment target. |
**name** | **string** | The name of the deployment target. |
**hosts** | [**\Upsun\Model\DeploymentHostsInner[]**](DeploymentHostsInner.md) | The hosts of the deployment target. | [optional]
**useDedicatedGrid** | **bool** | When true, the deployment will be pinned to Grid hosts dedicated to the environment using this deployment target.  Dedicated Grid hosts must be created prior to deploying the environment.  The constraints that will be set are as follows:  * &#x60;cluster_type&#x60; is set to &#x60;environment-custom&#x60;. * &#x60;cluster&#x60; is set to the environment&#39;s cluster name. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
