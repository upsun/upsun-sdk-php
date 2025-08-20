# # Environment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**created_at** | **\DateTime** |  |
**updated_at** | **\DateTime** |  |
**name** | **string** |  |
**machine_name** | **string** |  |
**title** | **string** |  |
**attributes** | **array<string,string>** |  |
**type** | **string** |  |
**parent** | **string** |  |
**default_domain** | **string** |  |
**has_domains** | **bool** |  |
**clone_parent_on_create** | **bool** |  |
**deployment_target** | **string** |  |
**is_pr** | **bool** |  |
**has_remote** | **bool** |  |
**status** | **string** |  |
**http_access** | [**\Upsun\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enable_smtp** | **bool** |  |
**restrict_robots** | **bool** |  |
**edge_hostname** | **string** |  |
**deployment_state** | [**\Upsun\Model\TheEnvironmentDeploymentState**](TheEnvironmentDeploymentState.md) |  |
**resources_overrides** | [**array<string,\Upsun\Model\ResourcesOverridesValue>**](ResourcesOverridesValue.md) |  |
**max_instance_count** | **int** |  |
**last_active_at** | **\DateTime** |  |
**last_backup_at** | **\DateTime** |  |
**project** | **string** |  |
**is_main** | **bool** |  |
**is_dirty** | **bool** |  |
**has_code** | **bool** |  |
**head_commit** | **string** |  |
**merge_info** | [**\Upsun\Model\TheCommitDistanceInfoBetweenParentAndChildEnvironments**](TheCommitDistanceInfoBetweenParentAndChildEnvironments.md) |  |
**has_deployment** | **bool** |  |
**supports_restrict_robots** | **bool** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
