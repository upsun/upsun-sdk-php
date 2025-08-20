# # CreateOrgSubscriptionRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**plan** | **string** | The project plan. | [optional]
**project_region** | **string** | The machine name of the region where the project is located. Cannot be changed after project creation. |
**project_title** | **string** | The name given to the project. Appears as the title in the UI. | [optional]
**options_url** | **string** | The URL of the project options file. | [optional]
**default_branch** | **string** | The default Git branch name for the project. | [optional]
**environments** | **int** | The maximum number of active environments on the project. | [optional]
**storage** | **int** | The total storage available to each environment, in MiB. Only multiples of 1024 are accepted as legal values. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
