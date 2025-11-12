# # EnvironmentVariable

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of EnvironmentVariable |
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**name** | **string** | Name of the variable |
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource |
**isJson** | **bool** | The variable is a JSON string |
**isSensitive** | **bool** | The variable is sensitive |
**visibleBuild** | **bool** | The variable is visible during build |
**visibleRuntime** | **bool** | The variable is visible at runtime |
**applicationScope** | **string[]** | Applications that have access to this variable |
**project** | **string** | The name of the project |
**environment** | **string** | The name of the environment |
**inherited** | **bool** | The variable is inherited from a parent environment |
**isEnabled** | **bool** | The variable is enabled on this environment |
**isInheritable** | **bool** | The variable is inheritable to child environments |
**value** | **string** | Value of the variable | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
