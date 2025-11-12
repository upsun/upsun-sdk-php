# # Environment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of Environment |
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**name** | **string** | The name of the environment |
**machineName** | **string** | The machine name for the environment |
**title** | **string** | The title of the environment |
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource |
**type** | **string** | The type of environment (&#x60;production&#x60;, &#x60;staging&#x60; or &#x60;development&#x60;), if not provided, a default will be calculated |
**parent** | **string** | The name of the parent environment |
**defaultDomain** | **string** | The default domain |
**hasDomains** | **bool** | Whether the environment has domains |
**cloneParentOnCreate** | **bool** | Clone data when creating that environment |
**deploymentTarget** | **string** | Deployment target of the environment |
**isPr** | **bool** | Is this environment a pull request / merge request |
**hasRemote** | **bool** | Does this environment have a remote repository |
**status** | **string** | The status of the environment |
**httpAccess** | [**\Upsun\Model\HttpAccessPermissions1**](HttpAccessPermissions1.md) |  |
**enableSmtp** | **bool** | Whether to configure SMTP for this environment |
**restrictRobots** | **bool** | Whether to restrict robots for this environment |
**edgeHostname** | **string** | The hostname to use as the CNAME |
**deploymentState** | [**\Upsun\Model\DeploymentState**](DeploymentState.md) |  |
**sizing** | [**\Upsun\Model\Sizing**](Sizing.md) |  |
**resourcesOverrides** | [**array<string,\Upsun\Model\ResourcesOverridesValue>**](ResourcesOverridesValue.md) | Resources overrides |
**maxInstanceCount** | **int** | Max number of instances for this environment |
**lastActiveAt** | **\DateTime** | Last activity date |
**lastBackupAt** | **\DateTime** | Last backup date |
**project** | **string** | The project the environment belongs to |
**isMain** | **bool** | Is this environment the main environment |
**isDirty** | **bool** | Is there any pending activity on this environment |
**hasStagedActivities** | **bool** | Is there any staged activity on this environment |
**canRollingDeploy** | **bool** | If the environment has rolling deployments ready for use |
**supportsRollingDeployments** | **bool** | If the environment supports rolling deployments |
**hasCode** | **bool** | Does this environment have code |
**headCommit** | **string** | The SHA of the head commit for this environment |
**mergeInfo** | [**\Upsun\Model\MergeInfo**](MergeInfo.md) |  |
**hasDeployment** | **bool** | Whether this environment had a successful deployment |
**supportsRestrictRobots** | **bool** | Does this environment support configuring restrict_robots |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
