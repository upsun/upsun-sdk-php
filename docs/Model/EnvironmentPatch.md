# # EnvironmentPatch

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of the environment | [optional]
**title** | **string** | The title of the environment | [optional]
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource | [optional]
**type** | **string** | The type of environment (&#x60;production&#x60;, &#x60;staging&#x60; or &#x60;development&#x60;), if not provided, a default will be calculated | [optional]
**parent** | **string** | The name of the parent environment | [optional]
**cloneParentOnCreate** | **bool** | Clone data when creating that environment | [optional]
**httpAccess** | [**\Upsun\Model\HttpAccessPermissions2**](HttpAccessPermissions2.md) |  | [optional]
**enableSmtp** | **bool** | Whether to configure SMTP for this environment | [optional]
**restrictRobots** | **bool** | Whether to restrict robots for this environment | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
