# # EnvironmentVariableCreateInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the variable |
**value** | **string** | Value of the variable |
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource | [optional]
**isJson** | **bool** | The variable is a JSON string | [optional]
**isSensitive** | **bool** | The variable is sensitive | [optional]
**visibleBuild** | **bool** | The variable is visible during build | [optional]
**visibleRuntime** | **bool** | The variable is visible at runtime | [optional]
**applicationScope** | **string[]** | Applications that have access to this variable | [optional]
**isEnabled** | **bool** | The variable is enabled on this environment | [optional]
**isInheritable** | **bool** | The variable is inheritable to child environments | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
