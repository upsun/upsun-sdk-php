# # ResourcesOverridesValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**services** | [**array<string,\Upsun\Model\PreServiceResourcesOverridesValue>**](PreServiceResourcesOverridesValue.md) | Per-service resources overrides. |
**startsAt** | **\DateTime** | Date when the override will apply. When null, don&#39;t do an auto redeployment but still be effective to redeploys initiated otherwise. |
**endsAt** | **\DateTime** | Date when the override will be reverted. When null, the overrides will never go out of effect. |
**redeployedStart** | **bool** | Whether the starting redeploy activity has been fired for this override. |
**redeployedEnd** | **bool** | Whether the ending redeploy activity has been fired for this override. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
