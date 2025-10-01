# # Environment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  |
**createdAt** | **\DateTime** |  |
**updatedAt** | **\DateTime** |  |
**name** | **string** |  |
**machineName** | **string** |  |
**title** | **string** |  |
**attributes** | **array<string,string>** |  |
**type** | **string** |  |
**parent** | **string** |  |
**defaultDomain** | **string** |  |
**hasDomains** | **bool** |  |
**cloneParentOnCreate** | **bool** |  |
**deploymentTarget** | **string** |  |
**isPr** | **bool** |  |
**hasRemote** | **bool** |  |
**status** | **string** |  |
**httpAccess** | [**\Upsun\Model\HttpAccessPermissions**](HttpAccessPermissions.md) |  |
**enableSmtp** | **bool** |  |
**restrictRobots** | **bool** |  |
**edgeHostname** | **string** |  |
**deploymentState** | [**\Upsun\Model\TheEnvironmentDeploymentState**](TheEnvironmentDeploymentState.md) |  |
**sizing** | [**\Upsun\Model\TheEnvironmentSizingConfiguration**](TheEnvironmentSizingConfiguration.md) |  |
**resourcesOverrides** | [**array<string,\Upsun\Model\ResourcesOverridesValue>**](ResourcesOverridesValue.md) |  |
**maxInstanceCount** | **int** |  |
**lastActiveAt** | **\DateTime** |  |
**lastBackupAt** | **\DateTime** |  |
**project** | **string** |  |
**isMain** | **bool** |  |
**isDirty** | **bool** |  |
**hasStagedActivities** | **bool** |  |
**canRollingDeploy** | **bool** |  |
**hasCode** | **bool** |  |
**headCommit** | **string** |  |
**mergeInfo** | [**\Upsun\Model\TheCommitDistanceInfoBetweenParentAndChildEnvironments**](TheCommitDistanceInfoBetweenParentAndChildEnvironments.md) |  |
**hasDeployment** | **bool** |  |
**supportsRestrictRobots** | **bool** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
