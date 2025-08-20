# # DeploymentTarget

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**name** | **string** |  |
**deploy_host** | **string** |  |
**deploy_port** | **int** |  |
**ssh_host** | **string** |  |
**hosts** | [**\Upsun\Model\TheHostsOfTheDeploymentTargetInner[]**](TheHostsOfTheDeploymentTargetInner.md) |  |
**auto_mounts** | **bool** |  |
**excluded_mounts** | **string[]** |  |
**enforced_mounts** | **object** |  |
**auto_crons** | **bool** |  |
**auto_nginx** | **bool** |  |
**maintenance_mode** | **bool** |  |
**guardrails_phase** | **int** |  |
**docroots** | [**array<string,\Upsun\Model\MappingOfClustersToEnterpriseApplicationsValue>**](MappingOfClustersToEnterpriseApplicationsValue.md) |  |
**site_urls** | **object** |  |
**ssh_hosts** | **string[]** |  |
**enterprise_environments_mapping** | **object** |  | [optional]
**use_dedicated_grid** | **bool** |  |
**storage_type** | **string** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
