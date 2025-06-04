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
**http_access** | [**\OpenAPI\Client\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enable_smtp** | **bool** |  |
**restrict_robots** | **bool** |  |
**edge_hostname** | **string** |  |
**deployment_state** | [**\OpenAPI\Client\Model\TheEnvironmentDeploymentState**](TheEnvironmentDeploymentState.md) |  |
**resources_overrides** | [**array<string,\OpenAPI\Client\Model\ResourcesOverridesValue>**](ResourcesOverridesValue.md) |  |
**last_active_at** | **\DateTime** |  |
**last_backup_at** | **\DateTime** |  |
**project** | **string** |  |
**is_main** | **bool** |  |
**is_dirty** | **bool** |  |
**has_code** | **bool** |  |
**head_commit** | **string** |  |
**merge_info** | [**\OpenAPI\Client\Model\TheCommitDistanceInfoBetweenParentAndChildEnvironments**](TheCommitDistanceInfoBetweenParentAndChildEnvironments.md) |  |
**has_deployment** | **bool** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
