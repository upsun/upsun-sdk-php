# # AutoscalerServiceSettings

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**triggers** | [**\Upsun\Model\AutoscalerTriggers**](AutoscalerTriggers.md) | Metrics should be evaluated as triggers for autoscaling | [optional]
**instances** | [**\Upsun\Model\AutoscalerInstances**](AutoscalerInstances.md) | Lower/Upper bounds on number of instances for horizontal scaling | [optional]
**resources** | [**\Upsun\Model\AutoscalerResources**](AutoscalerResources.md) | Lower/Upper bounds on cpu/memory for vertical scaling | [optional]
**scaleFactor** | [**\Upsun\Model\AutoscalerScalingFactor**](AutoscalerScalingFactor.md) | How many instances to add/remove on each scaling attempt | [optional]
**scaleCooldown** | [**\Upsun\Model\AutoscalerScalingCooldown**](AutoscalerScalingCooldown.md) | How long to wait before the next scaling attempt can be performed | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
